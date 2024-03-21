@extends('layouts.app')

@section('title')
  <p>{{ $item->name }}のオプション一覧</p>
@endsection

@section('content')
  <div class="mt-5 py-3">  
    <div class="w-75 mx-auto col mb-5">
      <div class="card h-100 mb-3">
        <div class="d-flex">
          <div class="ms-2 d-flex flex-column">
            <div class="mt-3">
              <label>商品名</label>
              <p><a href="{{ route('items.show', $item) }}"><u>>{{$item->name}}</u></a></p>
            </div>
            <div class="mt-3">
              <label>商品説明</label>
              <p>{{$item->description}}</p>
            </div>
            <div class="mt-3">
              <label>価格</label>
              <p>￥{{ number_format($item->price) }}</p>
            </div>
            <div class="mt-3">
              <label class="form-label">カテゴリー</label>
              <p><a href="#"><u>>{{$item->category->name}}</u></a></p>
            </div>
            <div class="mt-3">
              <label>備考</label>
              <p>{{$item->remark}}</p>
            </div>
          </div>
          <div class="ms-auto mt-2 me-2 mb-2">
            @if($item->image_path == NULL)
              <img class="max-500-img" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
            @else
              <img class="max-500-img" src="{{ asset('storage/') . '/' . $item->image_path }} " />
            @endif
          </div>
        </div>
      </div>
      <!-- ここまでアイテム -->
      <!-- ここからオプション -->
      <div>
        @if(!empty($item->itemDetails[0]))
          <table class="table">
            <tbody>
              <tr>
                <th><label>オプション名</label></th>
                <th><label>在庫数</label></th>
                <th></th>
              </tr>
              @foreach($item->itemDetails as $i)
                <tr>
                  <td>{{ $i->name }}</td>
                  <td>{{ ($i->quantity) }}</td>
                  <td class="td-btn"><button class="btn btn-orange" onclick="location.href='{{ route('itemDetails.edit', $i) }}'">編集</button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
        <div class="text-center">登録されているオプションはありません。</div>
        @endif
      </div>
      <div class="d-flex">
        <a class="ms-auto" href="{{ route('itemDetails.create', $item) }}"><u>>登録オプションを追加する</u></a>
      </div>
    </div>
  </div>
@endsection