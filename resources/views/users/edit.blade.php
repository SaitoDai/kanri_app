@extends('layouts.app')

@section('title', 'ユーザー編集')

@section('content')
  <form class="mt-5 w-50 mx-auto" action="{{ route('users.update', $user) }}" method="post">
    @csrf
    @method('patch')
    <div class="mb-2">
      <label class="form-label">名前</label><br>
      <input class="form-control" type="text" name="name" value="{{ $user->name }}" />
    </div>
    <div class="mb-2">
      <label class="form-label">メールアドレス</label><br>
      <input class="form-control" type="text" name="email" value="{{ $user->email }}" />
    </div>
    <div class="mb-2">
      <label class="form-label">パスワード</label><br>
      <input class="form-control" type="password" name="password" />
    </div>
    <div class="mb-2">
      <label class="form-label">パスワード(確認用)</label><br>
      <input class="form-control" type="password" name="password2" />
    </div>
    <div class="d-flex mt-2">
      <button class="btn btn-orange ms-auto" type="submit">更新</button>
    </div>
  </form>
@endsection