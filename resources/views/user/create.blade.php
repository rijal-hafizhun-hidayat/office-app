@extends('app')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Role</label>
                                <select name="role_id" class="form-select" aria-label="Default select example">
                                    <option selected disabled>Open this select menu</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
