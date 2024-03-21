<div class="modal-back">
  <div class="modal-title">
    <div class="d-flex">
      <div class="ms-auto btn btn-outline-secondary me-5 mt-3 close-modal-btn">✖</div>
    </div>
    <div class="modal-content d-flex align-items-center">
      <form class="d-flex mx-auto align-items-end flex-column position-absolute bottom-50" action="{{ route('buyers.softDelete', $buyer) }}" method="post">
        @csrf
        @method('delete')  
        <p>注文主「{{ $buyer->name }}」を削除します。本当によろしいですか？</p>
        <button class="btn btn-danger ms-auto">削除</button>
      </form>
    </div>
  </div>
</div>