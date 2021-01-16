@if (session()->has('message-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message-success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(session()->has('message-warning'))
    <div class="alert alert-warning alert-danger fade show" role="alert">
        {{ session('message-warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(session()->has('message-warning'))
    <div class="alert alert-warning alert-danger fade show" role="alert">
        {{ session('message-warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(session()->has('message-danger'))
    <div class="alert alert-danger alert-warning fade show" role="alert">
        {{ session('message-danger') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
