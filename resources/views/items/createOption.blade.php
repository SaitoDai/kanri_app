@extends('layouts.app')

@section('title', 'オプション登録')

@section('content')
<div class="mt-5 mx-auto w-50">
  <p>{{ $item->name }}のオプションを登録します。</p>
  <form action="{{ route('itemDetails.store', $item) }}" method="post">
    @csrf
    @method('post')
    <div class="mb-3">
      <label class="form-label">オプション名</label><br>
      <input class="form-control" type="text" name="name" required/>
    </div>
    <div class="mb-3">
      <label class="form-label">在庫数</label><br>
      <input class="form-control" type="number" name="quantity" rewuired/>
    </div>
    <div>
      <button class="btn btn-orange" type="submit">登録</button>
    </div>
  </form>
</div>
@endsection