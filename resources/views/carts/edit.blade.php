@extends('layouts.app')

@section('title', 'カート内編集')

@section('content')
<section>
  <p class="mt-5">カート内編集</p>
  @if($carts->count() !== 0)
    <table class="table cart-table">
      <tbody>
        <tr>
          <th></th>
          <th>商品名</th>
          <th class="ps-3">価格</th>
          <th class="w-15">個数</th>
          <th>小計</th>
          <th>処理ユーザー</th>
          <th>注文主</th>
          <th>更新日時</th>
          <th></th>
        </tr>
        @foreach($carts as $cart)
          <tr>
            <form action="{{ route('carts.update', $cart->cartDetail) }}" method="post">
              @csrf
              @method('patch')
              <td><button class="btn btn-orange">更新</button></td>
              <td><a href='{{ route('items.show', $cart->cartDetail->item_id) }}'><u>>{{$cart->cartDetail->item->name}}（{{$cart->cartDetail->itemDetail->name}}）</u></a></td>
              <td class="price text-end pe-3" value="{{ $cart->cartDetail->price }}">￥{{ number_format($cart->cartDetail->price) }}</td>
              <td><input class="input-quantity form-control text-end" type="number" name="quantity" value="{{ $cart->cartDetail->quantity }}" /></td>
              <td class="subtotal text-end subtotal" value="{{ $cart->cartDetail->price * $cart->cartDetail->quantity }}">￥{{ number_format($cart->cartDetail->price * $cart->cartDetail->quantity) }}</td>
              <td>{{ $cart->user->name }}</td>
              @if($cart->buyer->deleted_at == false)
                <td class="buyer_id" data-value="{{ $cart->buyer_id }}"><a href="{{ route('buyers.show', $cart->buyer->id) }}"><u>>{{ $cart->buyer->name }}</u></a></td>
              @else
                <td class="buyer_id" data-value="{{ $cart->buyer_id }}">{{ $cart->buyer->name }}</td>
              @endif
              <td class="text-center">{{ $cart->cartDetail->updated_at }}</td>
            </form>
            <td>
              <button class="btn btn-danger modal-btn">✖</button>
              @include('modals.cartsEdit')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="d-flex flex-column">
      <div class="ms-auto d-flex align-items-baseline">     
        <label class="form-label text-nowrap">注文主で絞る：</label>  
        <select class="form-select" name="buyer_id">
          <option disabled selected>-</option>
          @foreach($buyers as $buyer)
            <option class="option" value="{{ $buyer->id }}">{{$buyer->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="ms-auto d-flex align-items-baseline mt-2">     
        <input type="text" class="form-control search-box" placeholder="キーワードで絞り込み"/>
      </div>
    </div>
  @else
    <p>カート内は空です。</p>
  @endif
</section>
<script src="{{ asset('js/carts.edit.js') }}"></script>
@endsection