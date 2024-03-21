<div class="modal-back">
  <div class="modal-title">
    <div class="d-flex">
      <div class="ms-auto btn btn-outline-secondary me-5 mt-3 close-modal-btn">✖</div>
    </div>
    <div class="modal-content d-flex align-items-center">
      <form class="d-flex mx-auto align-items-end flex-column position-absolute bottom-50" action="{{ route('carts.destroy', $cart) }}" method="post">
        @csrf
        @method('delete')
        <div class="d-flex mx-auto aspect-ratio--3x2">
          @if($cart->cartDetail->item->image_path == NULL)
            <img class="items-edit-img" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" />
          @else
            <img class="items-edit-img" src="{{ asset('storage/') . '/' . $cart->cartDetail->item->image_path }} " />
          @endif
        </div>    
        <p>{{ $cart->cartDetail->item->name }}（{{ $cart->cartDetail->itemDetail->name }}）を削除します。本当によろしいですか？</p>
        <button class="btn btn-danger ms-auto">削除</button>
      </form>
    </div>
  </div>
</div>