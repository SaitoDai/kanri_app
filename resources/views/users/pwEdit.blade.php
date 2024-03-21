@extends('layouts.app')

@section('title')
  パスワード編集
@endsection

@section('content')
  <div class="mt-5">
    <form class="mt-5 w-50 mx-auto" action="{{ route('users.pwUpdate', request()->query('id')) }}" method="post">
      <p>パスワード編集</p>
      @csrf
      @method('patch')
      <div class="mb-2 mt-5">
        <label class="form-label">パスワード</label><br>
        <input class="form-control" type="password" name="password" required />
      </div>
      <div class="mb-2 mt-5">
        <label class="form-label">パスワード（確認用）</label><br>
        <input class="form-control" type="password" name="password2" required />
      </div>
      <div class="d-flex mt-2">
        <button class="btn btn-orange ms-auto" type="submit">変更</button>
      </div>
    </form>
  </div>
@endsection