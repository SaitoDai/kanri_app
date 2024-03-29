@extends('layouts.app')

@section('title')
  注文主編集
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-1 col-md-0"></div>
    <div class="col-lg-10 col-md-12">
      @include('modals.buyersEdit')
      <form class="w-50 mx-auto mt-5" action="{{ route('buyers.update', $buyer) }}" method="post">
        <div class="d-flex align-items-baseline">
          <p>注文主情報を編集します。</p>
          @if(Auth::user()->role->id == 1)
            <div class="btn btn-danger ms-auto modal-btn">✖</div>
          @endif
        </div>
        @csrf
        @method('patch')
        <div class="mb-3">
          <label class="form-label">名前</label><br>
          <input class="form-control" type="text" name="name" value="{{ $buyer->name }}" required/>
        </div>
        <div class="mb-1">
          <label class="form-label">郵便番号(ハイフンなし)</label><br>
          <div class="d-flex">
            <input class="w-25 form-control" type="text" name="postal" value="{{ $buyer->postal }}" required/>
          </div>
        </div>
        <div class="mb-3">
          <select class="form-select mb-1 w-15" name="prefecture" required>
            @include('prefectures.prefectures')
          </select>
          <textarea class="form-control" name="address">{{ $buyer->address }}</textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">メールアドレス</label><br>
          <input class="form-control" type="text" name="email" value="{{ $buyer->email }}" required/>
        </div>
        <div class="mb-3">
          <label class="form-label">電話番号(ハイフンなし)</label><br>
          <input class="form-control" type="number" name="phone" value="{{ $buyer->phone }}" required/>
        </div>
        <div class="mb-3">
          <label class="form-label">備考</label><br>
          <input class="form-control" type="text" name="remark" value="{{ $buyer->remark }}"/>
        </div>
        <div class="d-flex">
          <button class="btn btn-orange ms-auto" type="submit">更新</button>
        </div>
      </form>
    <div class="col-lg-1 col-md-0"></div>
  </div>
</div>         
<script src="{{ asset('js/buyers.edit.js') }}"></script>
@endsection