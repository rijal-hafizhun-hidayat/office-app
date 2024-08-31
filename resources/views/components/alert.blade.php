@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">

                {{ $error }}
            </div>
        </div>
    @endforeach
@endif
@if (session('status'))
    <div class="alert alert-info alert-dismissible show fade">
        <div class="alert-body">

            {{ session('status') }}
        </div>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">

            {{ session('success') }}
        </div>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">

            {{ session('error') }}
        </div>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible show fade">
        <div class="alert-body">

            {{ session('warning') }}
        </div>
    </div>
@endif
