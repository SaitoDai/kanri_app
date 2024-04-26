<div class="modal-back">
  <div class="modal-title">
    <div class="d-flex">
      <div class="ms-auto btn btn-outline-secondary me-5 mt-3 close-modal-btn">✖</div>
    </div>
    <div class="modal-content">
      <div class="d-flex mx-auto flex-column">
        @if($item->image_path == NULL)
          <div class="mx-auto">
            <img class="max-200-img" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" />
          </div>
          <div class="me-auto">No image</div>
          <input class="form-control-file" placeholder="{{ $item->image_path }}" type="file" name="image" />
        @else
          <div class="mx-auto">
            <img class="max-200-img" src="{{ asset('storage/') . '/' . $item->image_path }} " />
          </div>
          <div class="me-auto">{{ $item->image_path }}</div>
          <input class="form-control-file" placeholder="{{ $item->image_path }}" type="file" name="image" />
        @endif
      </div>
    </div>
  </div>
</div>
