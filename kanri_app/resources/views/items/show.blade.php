@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
  <div class="mt-5 w-75 mx-auto py-3">  
    <div class="d-flex">
      <a class="ms-auto" href="{{ route('items.indexOption', $item) }}"><u>>登録オプション一覧</u></a>
    </div>
    <div class="col mb-5">
      <form class="card h-100 w-100" action="{{ route('carts.store') }}" method="post">
        @csrf
        @method('post')
        <div class="ms-2 d-flex">
          <div class="d-flex flex-column">
            <div class="mt-3">
              <a href="{{ route('items.categorizedIndex', $item->category_id) }}">>{{$item->category->name}}</a>
            </div>
            <div class="mt-3">
              <label class="form-label">商品名</label>
              <p>{{$item->name}}</p>
              <input type="hidden" name="item_id" value="{{ $item->id }}" />
            </div>
            <div class="mt-3">
              <label class="form-label">商品説明</label>
              <p>{{$item->description}}</p>
            </div>
            <div class="mt-3">
              <label>価格</label>
              <p>￥{{ number_format($item->price) }}</p>
              <input type="hidden" name="price" value="{{ $item->price }}" />
            </div>
            <div class="mt-3">
              <label>備考</label>
              <p>{{$item->remark}}</p>
            </div>
            @if(!empty($item->itemDetails[0]))
              <div class="mt-3">
                <label class="form-label">購入数&ensp;/&ensp;在庫数</label>
                <div class="d-flex align-items-center">
                  <input class="form-control" type="number" name="quantity" value="" min="1" required/>
                  <div class="text-nowrap quantity-input">&ensp;/&ensp;{{ $item->itemDetails[0]->quantity }}</div>
                </div>
              </div>
              <div class="mt-3 mb-3">
                <label class="form-label">オプション</label>
                <select class="form-select" name="item_detail_id">
                  @foreach($item->itemDetails as $i)
                    <option class="option" value="{{ $i->id }}">{{ $i->name }}</option>
                  @endforeach
                </select>
              </div>
            @else
              <div class="mt-3 me-3">
                <a href='{{ route('itemDetails.create', $item) }}'><u>>在庫を設定してください。</u></a>
              </div>
            @endif
          </div>
          <div class="d-flex w-auto ms-auto flex-column">
            <div class="d-flex mt-3 me-2 mb-3">
              <div>
                @if($item->image_path == NULL)
                  <img class="img w-auto" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" />
                @else
                  <img class="img w-auto" src="{{ asset('storage/') . '/' . $item->image_path }} " />
                @endif
              </div>    
            </div>   
            <div class="d-flex ms-auto mt-auto me-2 mb-2">
              <div class="mt-auto">
                <div class="d-flex ms-auto align-items-baseline justify-content-end">
                  <label class="form-label text-nowrap">注文主：</label>
                  <select class="form-select" name="buyer_id">
                    @foreach($buyers as $buyer)
                      @if($buyer->deleted_at == false)
                        <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="d-flex mb-2 mt-2">
                  @if(Auth::user()->role->id == 1)
                    <div class="mt-auto ms-auto">
                      <a class="btn btn-orange" href='{{ route('items.edit', $item) }}'>編集</a>
                      @if($item->itemDetails->count() != 0)
                        <button class="btn ms-4 btn-orange">カートに入れる</button>
                      @else
                        <div class="btn ms-4 btn-outline-secondary">カートに入れる</div>
                      @endif
                    </div>
                  @else
                    <div class="mt-auto ms-auto">
                      @if($item->itemDetails->count() != 0)
                        <button class="btn ms-4 btn-orange">カートに入れる</button>
                      @else
                        <div class="btn ms-4 btn-outline-secondary">カートに入れる</div>
                      @endif
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="{{ asset('js/items.show.js') }}"></script>
@endsection