@extends('layouts.app')

@section('title', 'ユーザープロフィール')

@section('content')
  <div class="mt-5 mx-auto w-25">
    @if($user->verified == false)
      <div class="d-flex">
        <form class="ms-auto" action="{{ route('users.hardDelete', $user) }}" method="post">
          @csrf
          @method('delete')
          <button class="btn btn-danger">拒否</button>
        </form>
      </div>
    @else
      <div class="d-flex">
        <form class="ms-auto" action="{{ route('users.softDelete', $user) }}" method="post">
          @csrf
          @method('delete')
          <button class="btn btn-danger">削除</button>
        </form>
      </div>
    @endif
    <div>
      <label class="form-label">名前</label>
      <div class="form-lavel">{{ $user->name }}</div>
    </div><br>
    <div>
      <label class="form-label">メールアドレス</label>
      <div class="form-lavel">{{ $user->email }}</div>
    </div><br>
    <div class="d-flex flex-column">
      <label class="form-label">最終ログイン日</label>
      @if($user->verified == false)
        <div class="d-flex align-items-baseline">
          <div>--</div>
          <form class="ms-auto" action="{{ route('users.verify', $user) }}" method="post">
            @csrf
            @method('patch')
            <button class="btn btn-orange">承認</button>
          </form>
        </div>
      @else
        @if($user->logined_at == null)
          <div class="form-lavel">--</div>
        @else
          <div class="form-lavel">{{ $user->logined_at }}</div>
        @endif
      @endif
    </div><br>
    @if(Auth::id() == $user->id)
      <div class="d-flex">
        <a class="ms-auto" type="submit" onclick="location.href='{{ route('users.edit', $user) }}'"><u>>プロフィールを編集する</u></a>
      </div>
    @endif
  </div>
@endsection