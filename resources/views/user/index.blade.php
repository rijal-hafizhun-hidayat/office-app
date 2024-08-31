@extends('app')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-row-reverse">
                        <div>
                            <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Hak Akses</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <button class="btn btn-primary">{{ $role->name }}</button>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('user.show', ['id' => $user->id]) }}"
                                                    class="btn btn-warning">Show</a>
                                            </div>
                                            <div class="col">
                                                <a href="{{ route('user.change-password.index', ['id' => $user->id]) }}"
                                                    class="btn btn-secondary">Password</a>
                                            </div>
                                            <div class="col">
                                                <form action="{{ route('user.destroy', ['id' => $user->id]) }}" method="post">
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
