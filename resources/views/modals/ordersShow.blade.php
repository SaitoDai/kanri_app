<div class="modal-back">
  <div class="modal-title">
    <div class="d-flex">
      <div class="ms-auto btn btn-outline-secondary me-5 mt-3 close-modal-btn">✖</div>
    </div>
    <div class="modal-content">
      <div class="d-flex justify-content-around align-items-center">
        <div class="card w-25">          
          <div class="card-title mt-3 ms-3">注文主</div>
          <hr>
          <div class="card-body mt-2 mb-3 d-flex flex-column justify-content-center">
            <p>{{ $order->buyer_name }}</p>
            <p>{{ $order->orderBuyer->postal }}</p>
            <p>{{ $order->orderBuyer->address }}</p>      
            <p>{{ $order->orderBuyer->phone }}</p>  
            <p>{{ $order->orderBuyer->email }}</p>      
          </div>
        </div>
          <div class="w-25 d-flex justify-content-center">
            <img class="right-arrow" src="{{ asset('storage/images/right_arrow.png') }}" />
          </div>
        <div class="card w-25">
          <div class="card-title mt-3 ms-3">納品先</div>
          <hr>
          <div class="card-body mt-2 mb-3 d-flex flex-column justify-content-center">
            <p>{{ $order->destination_name }}</p>
            <p>{{ $order->orderDestination->postal }}</p>
            <p>{{ $order->orderDestination->address }}</p>      
            <p>{{ $order->orderDestination->phone }}</p>  
            <p>{{ $order->orderDestination->email }}</p>      
          </div> 
        </div>
      </div>
    </div>
  </div>
<div>