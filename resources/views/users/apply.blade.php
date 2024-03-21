@extends('layouts.app')

@section('title')
  ユーザー登録申請
@endsection

@section('content')
  <div class="mt-5">
    <form class="mt-5 w-50 mx-auto" action="{{ route('users.sendMail') }}" method="post">
      <p>ユーザー登録申請</p>
      @csrf
      @method('post')
      <div class="mb-2 mt-5">
        <label class="form-label">メールアドレス</label><br>
        <input class="form-control" type="text" name="email" placeholder="email@example.com" required />
      </div>
      <div class="d-flex mt-2">
        <button class="btn btn-orange ms-auto" type="submit">申請</button>
      </div>
    </form>
  </div>
@endsection