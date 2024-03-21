@extends('layouts.app')

@section('title')
  カテゴリー一覧
@endsection

@section('content')
  <div class="mt-5">
    <table class="table w-50 mx-auto category-table">
      <tbody>
        <tr>
          <th>カテゴリー名</th>
          <th></th>
        </tr>
        @foreach($categories as $category)
          <tr>
            <td>{{ $category->name }}</td>
            <td><a class="btn btn-orange" href="{{ route('categories.edit', $category) }}">編集</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection