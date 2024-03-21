@extends('layouts.app')

@section('title')
  パスワードリセット
@endsection

@section('content')
  <div class="mt-5">
    <form class="mt-5 w-50 mx-auto" action="{{ route('users.sendResetMail') }}" method="post">
      <p>パスワードリセット</p>
      @csrf
      @method('post')
      <div class="mb-2 mt-5">
        <label class="form-label">メールアドレス</label><br>
        <input class="form-control" type="text" name="email" placeholder="email@example.com" required />
      </div>
      <div class="d-flex mt-2">
        <button class="btn btn-orange ms-auto" type="submit">送信</button>
      </div>
    </form>
  </div>
@endsection