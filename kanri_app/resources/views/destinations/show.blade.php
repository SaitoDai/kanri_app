@extends('layouts.app')


@section('title', '納品先詳細')


@section('content')
  <div class="mt-5 w-50 mx-auto d-flex">
    <div>
      <div>
        <label class="form-label">名前</label><br>
        <p>{{ $destination->name }}</p>
      </div>
      <div>
        <label class="form-label">住所</label><br>
        <p>
          {{ $destination->prefecture }}
          {{ $destination->address }}
        </p>
      </div>
      <div>
        <label class="form-label">メールアドレス</label><br>
        <p>{{ $destination->email }}</p>
      </div>
      <div>
        <label class="form-label">電話番号</label><br>
        <p>{{ $destination->phone }}</p>
      </div>
      <div>
        <label class="form-label">注文主</label><br>
        <p><a href="{{ route('buyers.show', $destination->buyer) }}"><u>>{{ $destination->buyer->name }}</u></a></p>
      </div>
      <div>
        <label>最終更新者</label><br>
        <p>{{ $destination->user->name }} （{{ $destination->updated_at }}）</p>
      </div>
    </div>
    <div class="ms-auto me-5">
      <button class="btn btn-orange" onclick="location.href='{{ route('destinations.edit', $destination)}} '">編集</button>
    </div>
  </div>
@endsection