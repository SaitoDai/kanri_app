<div class="modal-back">
  <div class="modal-title">
    <div class="d-flex">
      <div class="ms-auto btn btn-outline-secondary me-5 mt-3 close-modal-btn">✖</div>
    </div>
    <div class="modal-content align-items-center mx-auto">
      <div class="d-flex flex-column position-absolute bottom-50">
        <p>決済を実行します。本当によろしいですか？</p>
        <button class="btn btn-orange ms-auto" hreff="{{ route('carts.payment') }}">実行</button>
      </div>
    </div>
  </div>
</div>