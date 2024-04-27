@extends('layouts.app')

@section('title', '注文主一覧')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-1 col-md-0"></div>
    <div class="col-lg-10 col-md-12 mb-5">
      <section>
        <div class="mt-5 d-flex align-items-center w-25 mx-auto">
          <input class="form-control search-box" type="text"  placeholder="ここに入力して検索"/>
        </div>
        <p>注文主一覧</p>
        @if(isset($buyers))
          <table class="table">
            <tbody>
              <tr>
                <th></th>
                <th>名前</th>
                <th>備考</th>
                <th>購入回数</th>
                <th class="w-15">前回購入日時</th>
              </tr>
              @foreach($buyers as $buyer)
                @if($buyer->deleted_at == false)
                  <tr data-buyer="buyer">
                    <td><button class="btn btn-orange" onclick="location.href='{{ route('buyers.show', $buyer) }}'">詳細</button></td>
                    <td>{{$buyer->name}}</td>
                    <td>{{$buyer->remark}}</td>
                    <td>{{$buyer->count}}</td>
                    <td>{{$buyer->updated_at}}</td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        @else
          <p>登録済みの注文主はありません。</p>
        @endif
        <div class="d-flex">
          <a class="ms-auto" href="{{ route('buyers.create') }}"><u>+注文主を追加する</u></a>
        </div>
      </section>
    <div class="col-lg-1 col-md-0"></div>
  </div>
</div>           
<script src="{{ asset('js/buyers.index.js') }}"
@endsection