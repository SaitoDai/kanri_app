@extends('layouts.app')

@section('title')
  注文主登録
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-1 col-md-0"></div>
    <div class="col-lg-10 col-md-12 mt-5 mb-5">
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
    <div class="col-lg-1 col-md-0"></div>
  </div>
</div>           
@endsection