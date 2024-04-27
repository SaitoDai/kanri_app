@extends('layouts.app')


@section('title', '注文主詳細')


@section('content')
  <div class="w-50 mx-auto mt-5 mb-5 d-flex">
    <div class="w-50 ms-5 ps-5">
      <div class="mb-3">
        <label class="form-label">名前</label><br>
        <p>{{ $buyer->name }}</p>
      </div>
      <div class="mb-3">
        <label class="form-label">住所</label><br>
        <div>〒{{ $buyer->postal }}</div>
        <div>{{ $buyer->prefecture }}{{ $buyer->address }}</div>
      </div>
      <div class="mb-3">
        <label class="form-label">メールアドレス</label><br>
        <p>{{ $buyer->email }}</p>
      </div>
      <div class="mb-3">
        <label class="form-label">電話番号</label><br>
        <p>{{ $buyer->phone }}</p>
      </div>
      <div class="mb-3">
        <label class="form-label">登録ユーザー</label><br>
        <p>{{ $buyer->created_by }} （{{ $buyer->created_at }}）</p>
      </div>
      @if($buyer->updated_by != NULL)
        <div class="mb-3">
          <label class="form-label">前回更新ユーザー</label><br>
          <p>{{ $buyer->updated_by }} （{{ $buyer->updated_at }}）</p>
        </div>
      @endif
    </div>
    <div class="ms-auto me-5">
      <button class="btn btn-orange" onclick="location.href='{{ route('buyers.edit', $buyer)}} '">編集</button>
    </div>
  </div>
  <div class="container mt-5 mx-auto mb-5">
    <div class="row justify-content-center">
      <div class="col-8">
        <p>{{ $buyer->name }}の納品先一覧</p>
        @if(!empty($buyer->destinations[0]))
          <table class="table">
            <tbody>
              <tr>
                <th></th>
                <th>名前</th>
                <th class="col-5">備考</th>
                <th class="w-15">前回更新日時</th>
              </tr>
              @foreach($buyer->destinations as $destination)
                <tr>
                  <td><button class="btn btn-orange" onclick="location.href='{{ route('destinations.show', $destination->id) }}'">詳細</button></td>
                  <td>{{ $destination->name }}</td>
                  <td>{{ $destination->remark }}</td>
                  <td>{{ $destination->updated_at }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
      </div>
    </div>
    <div class="text-center py-3 w-100 bg-body-secondary rounded"><b>登録済みの納品先はありません。</b></div>
    @endif
    <div class="d-flex">
      <div class="ms-auto">
        <a class="under-line" href="{{ route('destinations.create', $buyer) }}"><u>+納品先を追加する</u></a>
      </div>
    </div>
  </div>
@endsection