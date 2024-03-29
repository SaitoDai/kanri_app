@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-1 col-md-0"></div>
    <div class="col-lg-10 col-md-12">
      <div class="mt-5">
        <div class="d-flex align-items-baseline">
          <div>商品一覧</div>
          <div class="ms-auto">
            <input class="form-control search-box" type="text" placeholder="キーワードで絞る" />
          </div>
          <div class="ms-auto d-flex align-items-baseline">
            <label class="form-label text-nowrap">カテゴリー：</label>
            <select class="form-select">
              <option class="option" value="0">全て</option>
              @foreach($categories as $category)
                <option class="option" value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          @if(Auth::user()->role->id == 1)
            <div class="ms-auto">
              <a href="{{ route('items.create') }}"><u>>商品を登録する</u></a>
            </div>
          @endif
        </div>
        <!-- Section-->
        <section class="mt-3 text-center">
          <div class="d-flex align-items-baseline flex-wrap">
            @foreach($items as $item)
              <div class="w-25 item" data-value="{{ $item->category->id }}">
                <div class="row mx-2">
                  <div class="col mb-5">
                    <a href="{{ route('items.show', $item) }}">
                      <div class="card h-100">
                        <!-- Product image-->
                        <div class="aspect-ratio--3x2">
                          @if($item->image_path == NULL)
                            <img class="card-img-top h-100" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                          @else
                            <img class="card-img-top h-100" src="{{ asset('storage/') . '/' . $item->image_path }} " />
                          @endif
                        </div>
                        <!-- Product details-->
                        <div class="card-body p-4">
                          <div class="text-center">
                            <!-- Product name-->
                            <h5 class="mb-2 fw-bolder">{{ $item->name }}</h5>
                            <!-- Product price-->
                            <div>￥{{ number_format($item->price) }}</div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </section>
      </div>
    </div>
    <div class="col-lg-1 col-md-0"></div>
  </div>  
  <script src="{{ asset('js/items.index.js') }}"></script>
@endsection