@extends('layouts.app')

@section('title', '商品編集')

@section('content')
  <form class="mt-5 d-flex w-50 mx-auto" action="{{ route('items.destroy', $item) }}" method="post">
    <p>商品を編集します。</p>
    @csrf
    @method('delete')
    <button class="btn btn-danger ms-auto">✖</button>
  </form>
  <form class="mt-3 w-50 mx-auto" action="{{ route('items.update', $item) }}" method="post" enctype="multipart/form-data">
    @include('modals.itemsEdit')
    <div>
      @csrf
      @method('patch')
      <div class="mt-3">
        <label class="form-lavel">商品名</label><br>
        <input class="form-control" type="text" name="name" value="{{ $item->name }}" required/>
      </div>
      <div class="mt-3">
        <label class="form-lavel">商品説明</label><br>
        <input class="form-control" type="text" name="description" value="{{ $item->description }}" required/>
      </div>
      <div class="mt-3">
        <label class="form-lavel">価格</label><br>
        <input class="form-control" type="number" name="price" value="{{ $item->price }}" required/>
      </div>
      <div class="mt-3">
        <label class="form-lavel">カテゴリー</label>
        <div class="d-flex align-items-baseline">
          <select class="form-select w-15" name="category_id" required>
            @foreach($categories as $category)
              @if($item->category_id == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
              @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endif
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
        @if($item->image_path == NULL)
          <label>商品イメージ</label>
          <img class="modal-btn items-edit-img" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" /><br>
        @else
          <label>商品イメージ</label>
          <img class="modal-btn items-edit-img" src="{{ asset('storage/') . '/' . $item->image_path }} " /><br>
        @endif
      </div>    
      <div class="mt-1">
        <label class="form-lavel">備考</label><br>
        <input class="form-control" type="text" name="remark" value="{{ $item->remark }}"/>
      </div>
      <div class="d-flex mt-3">
        <button class="btn btn-orange ms-auto" type="submit">更新</button>
      </div>
    </div>
  </form>
  <script src="{{ asset('js/items.edit.js') }}"></script>
@endsection