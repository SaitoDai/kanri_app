@extends('layouts.app')

@section('title')
ユーザー情報入力
@endsection

@section('content')
  <div class="mt-5">
    <form class="mt-5 w-50 mx-auto" action="{{ route('users.store') }}" method="post">
      <p>ユーザー情報入力</p>
      @csrf
      @method('post')
      <div class="mb-3">
        <label class="form-label">名前</label><br>
        <input class="form-control" type="text" name="name" required />
      </div>
      <div class="mb-3">
        <label class="form-label">メールアドレス</label>
        <p>{{ request()->query('email') }}</p>
        <input type="hidden" name="email" value="{{ request()->query('email') }}" />
      </div>
      <div class="mb-3">
        <label class="form-label">パスワード</label><br>
        <input class="form-control" type="password" name="password" required />
      </div>
      <div class="mb-3">
        <label class="form-label">パスワード(確認用)</label><br>
        <input class="form-control" type="password" name="password2" required />
      </div>
      <div class="d-flex mt-2">
        <button class="btn btn-orange ms-auto" type="submit">送信</button>
      </div>
    </form>
  </div>
@endsection