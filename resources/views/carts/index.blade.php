@extends('layouts.app')

@section('title', 'カート内商品一覧')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <section>
        <p class="mt-5">カート内商品一覧</p>
        @if($carts->count() != 0)
        <div class="d-flex">
          <div class="ms-auto">
            <a href="{{ route('carts.edit') }}"><u>>カート内を編集する</u></a>
          </div>
        </div>
        <form action="{{ route('carts.show') }}" method="get" onsubmit="return false;">
          @csrf
          @method('get')
            <table class="table cart-table">
              <tbody>
                <tr>
                  <th>商品名</th>
                  <th class="ps-2">価格</th>
                  <th>個数</th>
                  <th>小計</th>
                  <th>処理ユーザー</th>
                  <th>注文主</th>
                  <th>更新日時</th>
                </tr>
                @foreach($carts as $cart)
                  <tr>
                    <td><a href='{{ route('items.show', $cart->cartDetail->item_id) }}'><u>>{{$cart->cartDetail->item->name}}（{{$cart->cartDetail->itemDetail->name}}）</u></a></td>
                    <td class="text-end pe-3">￥{{ number_format($cart->cartDetail->price) }}</td>
                    <td class="text-end pe-3">{{ $cart->cartDetail->quantity }}</td>
                    <td class="text-end pe-3">￥{{ number_format($cart->cartDetail->price * $cart->cartDetail->quantity) }}</td>
                    <td>{{ $cart->user->name }}</td>
                    @if($cart->buyer->deleted_at == false)
                      <td class="buyer_id" data-value="{{ $cart->buyer_id }}"><a href="{{ route('buyers.show', $cart->buyer->id) }}"><u>>{{ $cart->buyer->name }}</u></a></td>
                    @else
                      <td class="buyer_id" data-value="{{ $cart->buyer_id }}">{{ $cart->buyer->name }}</td>
                    @endif
                    <td class="text-end pe-3">{{ $cart->created_at }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="d-flex flex-column">
            @if($buyers->count() != 0)
            <div class="ms-auto d-flex align-items-baseline">     
              <label class="form-label text-nowrap">注文主：</label>  
              <select class="form-select" name="buyer_id">
                <option class="option" value="0">全て</option>
                @foreach($buyers as $buyer)
                  @if($buyer->deleted_at == false)
                    <option class="option" value="{{ $buyer->id }}">{{$buyer->name}}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="ms-auto d-flex align-items-baseline mt-2">     
              <input type="text" class="form-control search-box" placeholder="キーワードで絞り込み"/>
            </div>
            <script src="{{ asset('js/carts.index.js') }}"></script>
            @else
              <a class="d-block" href="{{ route('buyers.create') }}"><u>>注文主を登録してください。</u></a>
            @endif
          </div>
          <div class="d-flex">
            <input type="button" class="btn btn-orange mt-3 ms-auto" value="レジへ" onClick="submit()">
          </div>
        </form>
        @else
          <p>カート内は空です。</p>
        @endif
      </section>
    <div class="col-lg-1 col-md-0"></div>
  </div>
</div>     
@endsection