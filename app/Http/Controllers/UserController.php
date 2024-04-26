<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;
use URL;
use App\Mail\SendMail;
use App\Mail\SendResetMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
			$users = User::all();
			return view('users.index', compact('users'));
	}


	public function apply()
	{
			return view('users.apply');
	}


	public function reset(){
		return view('users.reset');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
			if($request->input('password') == $request->input('password2')){
					$user = new User();
					$user->name = $request->input('name');
					$user->email = $request->input('email');
					$user->password = Hash::make($request->input('password'));
					$user->role_id = 2;
					$user->verified = false;
					$user->save();
					return redirect()->route('users.getLogin')->with('flash_message', 'ユーザー情報の入力が完了しました。管理者による認証が済むまでお待ちください。');
			} else {
					return redirect()->route('users.create')->with('flash_message', '入力に誤りがあります。');
			}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
			return view('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{   
			return view('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
			if($request->input('password') == $request->input('password2')){
					$user->name = $request->input('name');
					$user->email = $request->input('email');
					$user->password = Hash::make($request->input('password'));
					$user->update();
					return redirect()->route('users.show', $user)->with('flash_message', '成功');
			} else {
					return redirect()->route('users.show', $user)->with('flash_message', '失敗');
			}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function hardDelete(User $user)
	{
			$user->delete();
			return redirect()->route('users.index')->with('flash_message', $user->name . 'を削除しました。');
	}


	public function softDelete(User $user)
	{
			$user->deleted_at = now();
			$user->update();
			return redirect()->route('users.index')->with('flash_message', $user->name . 'を削除しました。');
	}



	public function login(Request $request) {
		$request->validate([
			'email' => 'email',
			'password' => 'required'
		]); 
			if(Auth::attempt($request->only('email', 'password')) && User::where('email', $request->input('email'))->first()->deleted_at == null) //only()により['email' => 'xxx', 'password' => 'xxx']となる
			{	
				if(Auth::user()->verified != true){
					Auth::logout();
					return redirect()->back()->with('flash_message', 'ユーザー認証が済んでいないメールアドレスです。管理者に問い合わせてください。');
				} else {
					$user = Auth::user();
					$user->logined_at = date('Y/n/j H:i:s');
					$user->update();
					return redirect()->route('items.index')->with('flash_message', '「' . $user->name . '」としてログイン成功');
				}
			} else {
					return redirect()->back()->with('flash_message', 'メールアドレスまたはパスワードに誤りがあります。');
			}
	}


	public function logout(User $user) {
			Auth::logout();
			return redirect()->route('users.getLogin')->with('flash_message', 'ログアウトしました。');
	}



	//ここからユーザー認証系
	public function sendMail(Request $request){ //時間付トークンメールを送る
		$email = $request->input('email');
		if(User::where('email', $email)->exists()){
			return redirect()->route('users.apply')->with('flash_message', 'このメールアドレスは使えません。他のメールアドレスを入力してください。');
		} else {
			Mail::to($email)->send(new SendMail($email));
			return redirect()->route('users.apply')
			->with('flash_message', '入力したアドレス宛にメールを送りました。ご確認ください。');
		}
	}


	//PWリセットメール送信
	public function sendResetMail(Request $request, User $user){
		$email = $request->input('email');
		$user = User::where('email', $email)->first();
		if($user != NULL){
			Mail::to($email)->send(new SendResetMail($email, $user));
			return redirect()->route('users.reset')->with('flash_message', 'パスワードリセットメールを送信しました。');
		} else {
			return redirect()->back()->with('flash_message', '「' . $email . '」は登録されていないか、仮登録状態です。');
		}
	}

	//PWリセット画面へ
	public function pwEdit(){
		return view('users.pwEdit');
	}

	//PWをupdate
	public function pwUpdate(Request $request, User $user){
		if($request->input('password') == $request->input('password2')){
			$user->password = Hash::make($request->input('password'));
			$user->update();
			return redirect()->route('users.getLogin')->with('flash_message', 'パスワードをリセットしました。');
		} else {
			return redirect()->back()->with('flash_message', '入力に誤りがあります。');
		}
	}

	
	//認証
	public function verify(User $user){ //管理者用
		$user->verified = true;
		$user->update();
		return redirect()->route('users.index')->with('flash_message', $user->name . 'を承認しました。');
	}
}
