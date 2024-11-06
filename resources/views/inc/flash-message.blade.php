@if($message=Session::get('success'))
<div class="alert alert-soft-success d-flex align-items-center">
    <span class="fas fa-check-circle text-success fs-3 me-3"></span>
    <p class="mb-0 flex-1">{{ $message }}</p> 
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>

</div>

@endif



@if($message=Session::get('error'))
<div class="alert alert-outline-danger d-flex align-items-center">
    <span class="fas fa-times-circle text-danger fs-3 me-3"></span>
    <p class="mb-0 flex-1"> {{ $message }}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>

</div>

@endif


<!-- <div class="alert alert-soft-success d-flex align-items-center" role="alert">
    <span class="fas fa-check-circle text-success fs-3 me-3"></span>
    <p class="mb-0 flex-1"></p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <div class="alert alert-outline-danger d-flex align-items-center" role="alert">
    <span class="fas fa-times-circle text-danger fs-3 me-3"></span>
    <p class="mb-0 flex-1">A simple danger alert—check it out!</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>  -->
  