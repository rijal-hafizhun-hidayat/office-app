@extends('app')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p>selamat datang, {{ $user->name }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
