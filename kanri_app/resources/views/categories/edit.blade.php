@extends('layouts.app')

@section('title')
  カテゴリー編集
@endsection

@section('content')
  <div class="mt-5 w-50 mx-auto">
    <div class="d-flex">
      <p>「{{ $category->name }}」のカテゴリー名を変更します。</p>
      <form class=" ms-auto" action="{{ route('categories.destroy', $category) }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger">✖</button>
      </form>
    </div>
    <form class="mt-3" action="{{ route('categories.update', $category) }}" method="post">
      @csrf
      @method('patch')
      <div class="mb-2">
        <label class="form-label">カテゴリー名</label><br>
        <input class="form-control" type="text" name="name" value="{{ $category->name }}" required />
      </div>
      <div class="d-flex mt-2">
        <button class="btn btn-orange ms-auto" type="submit">更新</button>
      </div>
    </form>
  </div>
@endsection