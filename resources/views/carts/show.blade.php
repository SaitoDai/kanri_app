@extends('layouts.app')


@section('title')
  決済手続き
@endsection


@section('content')
<div class="container">
  <div class="row mt-5">
    @if($buyer->carts->count() === 0) {{-- カート内に商品がない場合 --}}
      <p>カート内は空です。</p>
      <div class="d-flex flex-column ">
        @if($buyer->destinations->count() != 0) {{-- 納品先登録がある場合 --}}
          <div class="ms-auto d-flex align-items-baseline">     
            <label class="form-label text-nowrap">納品先：</label>  
            <select class="form-select" name="destination_id">
              @foreach($buyer->destinations as $destination)
                  <option class="option" value="{{ $destination->id }}">{{$destination->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="ms-auto d-flex align-items-baseline mt-2">
            <input type="text" class="form-control search-box" placeholder="キーワードで絞り込み" />
          </div>
        @else {{-- 納品先登録がない場合 --}}
          <a class="ms-auto" href="{{ route('destinations.create', $buyer_id) }}"><u>>納品先を登録してください。</u></a>
        @endif
      </div>
      <div class="d-flex">
        <input type="hidden" name="buyer_id" value="{{ $buyer_id }}" />
        <button class="btn btn-outline-secondary mt-3 ms-auto">決済</button>
      </div>
    @else {{-- カート内に商品がある場合 --}}
      <p>{{ $buyer_name }}の決済を実行します。<p>
        <form action="{{ route('carts.payment') }}" method='post'>
          @csrf
          @method('post')
          <table class="table">
            <tbody>
              <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>個数</th>
                <th>小計</th>
                <th>処理ユーザー</th>
                <th>注文主</th>
                <th>更新日時</th>
              </tr>
              @foreach($carts as $cart)
                <tr>
                  <td><a href='{{ route('items.show', $cart->cartDetail->item_id) }}'><u>>{{$cart->cartDetail->item->name}}（{{$cart->cartDetail->itemDetail->name}}）</u></a></td>
                  <input type="hidden" name="item_id" value="{{ $cart->cartDetail->item_id }}" />
                  <input type="hidden" name="item_detail_id" value="{{ $cart->cartDetail->item_detail_id }}" />
                  <td>￥{{ number_format($cart->cartDetail->price) }}</td>
                  <input type="hidden" name="price" value="{{ $cart->cartDetail->price }}" />
                  <td>{{ $cart->cartDetail->quantity }}</td>
                  <input type="hidden" name="quantity" value="{{ $cart->cartDetail->quantity }}" />
                  <td>￥{{ number_format($cart->cartDetail->price * $cart->cartDetail->quantity) }}</td>
                  <td>{{ $cart->user->name }}</td>
                  <td><a href="{{ route('buyers.show', $cart->buyer->id) }}"><u>>{{ $cart->buyer->name }}</u></a></td>
                  <td>{{ $cart->cartDetail->updated_at }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex">
            <div class="ms-auto">消費税：￥{{ number_format($tax) }}</div>
          </div>
          <div class="d-flex">
            <div class="ms-auto">総額：￥{{ number_format($total + $tax) }}</div>
            <input type="hidden" name="total+tax" value="{{ $total + $tax }}" />
          </div>
          <div class="d-flex mt-3 flex-column">
            @if($buyer->destinations->count() != 0) {{-- 納品先登録がある場合 --}}
              <div class="ms-auto d-flex align-items-baseline">     
                <label class="form-label text-nowrap">納品先：</label>  
                <select class="form-select" name="destination_id">
                  @foreach($buyer->destinations as $destination)
                    <option class="option" value="{{ $destination->id }}">{{$destination->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="ms-auto d-flex align-items-baseline mt-2">
                <input type="text" class="form-control search-box" placeholder="キーワードで絞り込み" />
              </div>
            @else {{-- カート内に商品がある場合 --}}
              <a class="ms-auto" href="{{ route('destinations.create', $buyer_id) }}"><u>>納品先を登録してください。</u></a>
            @endif
          </div>
          <div class="d-flex h-auto">
            @if($buyer->destinations->count() != 0)
              <input type="hidden" name="buyer_id" value="{{ $buyer_id }}" />
              <a class="btn btn-orange mt-3 ms-auto modal-btn">決済</a>
              @include('modals.cartsShow')
            @else
              <a class="btn btn-outline-secondary mt-3 ms-auto">決済</a>
            @endif
          </div>
        </form>
    @endif
  </div>
</div>
<script src="{{ asset('js/carts.show.js') }}"></script>
@endsection