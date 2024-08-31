@extends('app')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="{{ route('overtime-letter.store') }}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Tanggal</label>
                                <input type="date" name="date" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Jam mulai</label>
                                <input type="time" name="started_at" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Jam mulai</label>
                                <input type="time" name="ended_at" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Pekerjaan</label>
                                <input type="text" name="job" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Disetujui Oleh</label>
                                <select name="approved_by" class="form-select" aria-label="Default select example">
                                    <option selected disabled>Open this select menu</option>
                                    @foreach ($users as $user)
                                        @if ($user->roles[0]->name == 'manajer')
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
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
