@extends('layouts.app')


@section('title')
  注文一覧
@endsection


@section('content')
<div class="container-xxl">
  <div class="row">
    <div class="col-lg-1 col-md-0"></div>
    <div class="col-lg-10 col-md-12">
      <div class="mt-5">
        @if($orders->count() == 0)
          <p>注文履歴はありません。</p>
        @else
          <table class="table">
            <tbody>
              <tr>
                <th></th>
                <th>処理ユーザー</th>
                <th class="w-15">決済日時</th>
                <th>購入個数</th>
                <th>注文番号</th>
                <th>注文主</th>
                <th>納品先</th>
                <th class="w-5">税込総額</th>
              </tr>
              @foreach($orders->unique('created_at') as $order)
                <tr>
                  <td><button class="btn btn-orange" onclick="location.href='{{ route('orders.show', $order) }}'">詳細</td>
                  <td>{{ $order->user->name }}</td>
                  <td>{{ $order->created_at }}</td>
                  <td class="text-end pe-5">{{ $orders->where('created_at', $order->created_at)->count() }}</td>
                  <td class="text-end">{{ $order->order_number }}&emsp;&emsp;&emsp;</td>
                  <td>{{ $order->buyer_name }}</td>
                  <td>{{ $order->destination_name }}</td>
                  <td class="text-end">￥{{ number_format($order->total) }}&emsp;&emsp;&emsp;</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
    </div>
    <div class="col-lg-1 col-md-0"></div>
  </div>
</div>    
@endsection