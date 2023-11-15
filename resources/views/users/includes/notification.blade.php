<div class="container">
    @if ($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
@endif
</div>
