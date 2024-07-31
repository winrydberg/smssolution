@if($error)
    <div class="alert alert-danger d-flex align-items-center justify-content-center flex-column">
        <i class="fa fa-info-circle"></i>
        <p class="mt-2">{{$message}}</p>
    </div>
@endif