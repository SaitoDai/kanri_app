@extends('layouts.app')

@section('title')
  注文主登録
@endsection

@section('content')
  <p>新しく注文主を登録します。</p>
  <form action="{{ route('buyers.store') }}" method="post">
    @csrf
    @method('post')
    <div class="mb-3">
      <label class="form-label">名前</label><br>
      <input class="form-control" type="text" name="name" required/>
    </div>
    <div class="mb-1">
      <label class="form-label">郵便番号(ハイフンなし)</label><br>
      <div class="d-flex">
        <input class="w-25 form-control" type="text" name="postal" required/>
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
      <input class="form-control" type="text" name="email" required/>
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
  <script src="{{ asset('js/buyers.create.js') }}"></script>
@endsection