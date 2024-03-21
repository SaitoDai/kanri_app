@extends('layouts.app')

@section('title', 'オプション編集')

@section('content')
  <form class="mt-5 w-50 mx-auto" action="{{ route('itemDetails.update', $item_detail->id) }}" method="post">
    @csrf
    @method('patch')
    <div>
      <label class="form-label">オプション名</label><br>
      <input class="form-control" type="text" name="name" value="{{ $item_detail->name }}" required/>
    </div>
    <div class="mb-3 mt-3">
      <label class="form-label">在庫数</label><br>
      <input class="form-control" type="number" name="quantity" value="{{ $item_detail->quantity }}" rewuired/>
    </div>
    <div class="d-flex">
      <button class="btn btn-orange ms-auto" type="submit">更新</button>
    </div>
  </form>
@endsection