@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-2 col-md-1"></div>
    <div class="col-lg-8 col-md-10">
      <form class="mt-5 login-form mx-auto" action="{{ route('users.login') }}" method="post">
        @csrf
        @method('post')
        <p class="mt-3 mb-5">ご利用にはログインが必要です。</p>
        <div class="mt-2 mb-5 text-center">
          <a href="{{ route('users.readme') }}"><u>>はじめにお読みください</u></a>
        </div>
        <div class="container test_info">
          <div class="row mx-auto justify-content-center">
            <div class="col-4">
              <div class="text-center">&emsp;＜テスト用アカウント＞</div>
              <div class="d-inline-block">
                &emsp;メールアドレス：test@example.com<br>
                &emsp;パスワード：password
              </div>
            </div>
          </div>
        </div>
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
    </div>
    <div class="col-lg-2 col-md-1"></div>
  </div>
</div>
@endsection