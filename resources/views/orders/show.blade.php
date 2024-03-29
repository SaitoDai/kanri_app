@extends('layouts.app')


@section('title')
  {{ $order->order_number }}の注文詳細
@endsection


@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-1 col-md-0"></div>
    <div class="col-lg-10 col-md-12">
      <div class="mt-5">
        @if(empty($order))
          <p>注文はありません。</p>
        @else
          <label>処理ユーザー</label>
          <p>{{ $order->user->name }}</p>
          <table class="mb-3 table w-50">
            <tbody>
              <tr>
                <th>注文主</th>
                <th>納品先</th>
                <th>処理日時</th>
              </tr>
              <tr>
                <td><a class="modal-btn"><u>{{ $order->buyer_name }}</u></a></td>
                <td><a class="modal-btn"><u>{{ $order->destination_name }}</u></a></td>
                <td class="ms-auto">{{ $order->created_at }}</td>
              </tr>
            </tbody>
          </table>
          <table class="table">
            <tbody>
              <tr>
                <th>商品名</th>
                <th>単価</th>
                <th>個数</th>
                <th>小計</th>
              </tr>
              @foreach($order_details as $order_detail)
                <tr>
                  <td>{{ $order_detail->item_name }}（{{ $order_detail->item_detail_name }}）</td>
                  <td><div class="text-right">￥{{ number_format($order_detail->price) }}</div></td>
                  <td>{{ $order_detail->quantity }}</td>
                  <td><div class="text-right">￥{{ number_format($order_detail->price * $order_detail->quantity) }}</div></td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @include('modals.ordersShow')
          <div class="me-5">
            <div class="mt-3 d-flex">
              <div class="d-flex ms-auto align-items-center">
                <label class=>消費税&ensp;</label>
                <div>￥{{number_format($order->total / 11) }}</div>
              </div>
            </div>
            <div class="mt-2 d-flex">
              <div class="d-flex ms-auto align-items-center">
                <label>総額&ensp;</label>
                <div>￥{{ number_format($order->total) }}</div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="col-lg-1 col-md-0"></div>
  </div>        
  <script src="{{ asset('js/orders.show.js') }}"></script>
@endsection