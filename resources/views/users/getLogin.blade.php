@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
  <form class="mt-5 login-form w-25 mx-auto" action="{{ route('users.login') }}" method="post">
    @csrf
    @method('post')
    <p class="mt-3 mb-5">ご利用にはログインが必要です。</p>
    <div class="mb-3">
      <label class="form-label">メールアドレス</label><br>
      <input class="form-control" type="text" name="email" required/>
    </div>
    <div class="mb-5">
      <label class="form-label">パスワード</label><br>
      <input class="form-control" type="password" name="password" required/>
    </div>
    <div class="right mb-2">
      <button class="btn btn-orange" type="submit">ログイン</button>
    </div>
    <div class="right mt-3">
      <a href="{{ route('users.reset') }}">パスワードを忘れた場合</a>
    </div>
    <div class="right mt-3">
      <a href="{{ route('users.apply') }}">ユーザー登録申請</a>
    </div>
  </form>
@endsection