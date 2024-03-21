<div class="modal-back">
  <div class="modal-title">
    <div class="d-flex">
      <div class="ms-auto btn btn-outline-secondary me-5 mt-3 close-modal-btn">✖</div>
    </div>
    <div class="modal-content d-flex align-items-center">
      <form class="d-flex mx-auto align-items-end flex-column position-absolute bottom-50" action="{{ route('destinations.destroy', $destination) }}" method="post">
        @csrf
        @method('delete')  
        <p>納品先「{{ $destination->name }}」を削除します。本当によろしいですか？</p>
        <button class="btn btn-danger ms-auto">削除</button>
        <input type="hidden" name="buyer_id" value="{{ $destination->buyer->id }}" />
      </form>
    </div>
  </div>
</div>