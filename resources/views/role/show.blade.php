@extends('app')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="{{ route('role.update', ['id' => $role->id]) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Nama Role</label>
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control"
                                    id="">
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
