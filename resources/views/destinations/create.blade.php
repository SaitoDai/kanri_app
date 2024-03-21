@extends('layouts.app')

@section('title')
  納品先登録
@endsection

@section('content')
  <form class="w-75 mx-auto" action="{{ route('destinations.store') }}" method="post">
    @csrf
    @method('post')
    <div class="mb-3">
      <label class="form-label">名前</label><br>
      <input class="form-control" type="text" name="name" required/>
    </div>
    <div class="mb-3">
      <label class="form-label">注文主</label><br>
      <div class="d-flex">
        <select class="w-15 form-select" name="buyer_id" required>
          @foreach($buyers as $buyer)           
            @if($buyer->id == $buyer_id )
              <option value="{{ $buyer->id }}" selected>{{ $buyer->name }}</option>
            @else
              <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
            @endif
          @endforeach
        </select>
        <button class="btn btn-orange" href="#" type="button">検索</button>
      </div>
    </div>
    <div class="mb-1">
      <label class="form-label">郵便番号(ハイフンなし)</label><br>
      <div class="d-flex">
        <input class="w-15 form-control" type="text" name="postal" required/>
        <button class="btn btn-orange address-btn" href="#" type="button">自動入力</button>
      </div>
    </div>
    <div class="mb-3">
      <select class="form-select mb-1 w-15" name="prefecture" required>
        @include('prefectures.prefectures')
      </select>
      <textarea class="form-control" name="address" placeholder="市区町村以下を入力"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">メールアドレス</label><br>
      <input class="form-control" type="email" name="email" required/>
    </div>
    <div class="mb-3">
      <label class="form-label">電話番号(ハイフンなし)</label><br>
      <input class="form-control" type="number" name="phone"/>
    </div>
    <div class="mb-3">
      <label class="form-label">備考</label><br>
      <input class="form-control" type="text" name="remark"/>
    </div>
    <div class="d-flex">
      <button class="btn btn-orange ms-auto" type="submit">登録</button>
    </div>
  </form>
  <script src="{{ asset('js/destinations.create.js') }}"></script>
@endsection