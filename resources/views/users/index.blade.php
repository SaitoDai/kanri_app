@extends('layouts.app')


@section('title')
  ユーザー
@endsection


@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-1 col-md-0"></div>
    <div class="col-lg-10 col-md-12 mb-5">
      <div class="mt-5">
        <table class="table mx-auto user-table">
          <tbody>
            <tr>
              <th>権限</th>
              <th>ユーザー名</th>
              <th>メールアドレス</th>
              <th>前回ログイン日時</th>
              <th>備考</th>
              <th>認証状態</th>
            </tr>
            @foreach($users as $user)
              @if($user->deleted_at == false)
                <tr>
                  <td>{{ $user->role->name }}</td>
                  <td><a href="{{ route('users.show', $user->id) }}"><u>>{{ $user->name }}</u></a></td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->logined_at }}</td>
                  <td>{{ $user->remark }}</td>
                  <td>
                    @if( $user->verified == false )
                      <form action="{{ route('users.verify', $user->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <button class="btn btn-orange">承認</button>
                      </form>
                    @else
                      承認済み
                    @endif
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  <div class="col-lg-1 col-md-0"></div>
</div>        
@endsection