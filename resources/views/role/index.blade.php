@extends('app')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-row-reverse">
                        <div>
                            <a href="{{ route('role.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('role.show', ['id' => $role->id]) }}"
                                                    class="btn btn-warning">Show</a>
                                            </div>
                                            <div class="col">
                                                <form action="{{ route('role.destroy', ['id' => $role->id]) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
