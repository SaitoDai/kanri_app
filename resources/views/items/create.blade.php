@extends('layouts.app')

@section('title', '商品登録')

@section('content')
  <div class="mt-5 w-50 mx-auto">
    <p>新しく商品を登録します。</p>
    <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('post')
      <div class="mt-3">
        <label class="form-label">商品名</label><br>
        <input class="form-control" type="text" name="name" required/>
      </div>
      <div class="mt-3">
        <label class="form-label">商品説明</label><br>
        <input class="form-control" type="text" name="description" required/>
      </div>
      <div class="mt-3">
        <label class="form-label">価格</label><br>
        <input class="form-control" type="number" name="price" required/>
      </div>
      <div class="w-50 mt-3">
        <label class="form-label">カテゴリー</label><br>
        <div class="d-flex align-items-baseline">
          <select class="form-select" name="category_id" required>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
          @if(Auth::user() != NULL && Auth::user()->role->id == 1)
            <div class="ms-3">
              <a class="text-nowrap" href="{{ route('categories.create') }}"><u>>カテゴリーを追加する</u></a>
            </div>
          @endif
        </div>
      </div>
      <div class="mt-3 d-flex flex-column">
        @include('modals.itemsCreate')
        <label>商品イメージ</label>
        <img class="modal-btn items-edit-img" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" /><br>
      </div>
      <div class="mt-3">
        <label class="form-label">備考</label><br>
        <input class="form-control" type="text" name="remark"/>
      </div>
      <div class="d-flex mt-3">
        <button class="btn btn-orange ms-auto" type="submit">登録</button>
      </div>
    </form>
  </div>
  <script src="{{ asset('js/items.create.js') }}"></script>
@endsection