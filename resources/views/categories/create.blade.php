@extends('layouts.app')

@section('title')
  カテゴリー追加
@endsection

@section('content')
<div class="mt-5">
  <form class="mt-5 w-50 mx-auto" action="{{ route('categories.store') }}" method="post">
    <p>カテゴリー追加</p>
    @csrf
    @method('post')
    <div class="mb-2">
      <label class="form-label">カテゴリー名</label><br>
      <input class="form-control" type="text" name="name" required />
    </div>
    <div class="d-flex mt-2">
      <button class="btn btn-orange ms-auto" type="submit">追加</button>
    </div>
  </form>
</div>
@endsection