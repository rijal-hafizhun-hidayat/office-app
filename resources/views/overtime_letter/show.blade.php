@extends('app')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="{{ route('overtime-letter.update', ['id' => $overtime_letter->id]) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Tanggal</label>
                                <input type="date" name="date" class="form-control"
                                    value="{{ $overtime_letter->date }}" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Jam mulai</label>
                                <input type="time" name="started_at" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($overtime_letter->started_at)->format('H:i') }}" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Jam mulai</label>
                                <input type="time" name="ended_at" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($overtime_letter->ended_at)->format('H:i') }}" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Pekerjaan</label>
                                <input type="text" name="job" class="form-control"
                                    value="{{ $overtime_letter->job }}" id="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Disetujui Oleh</label>
                                <select name="approved_by" class="form-select" aria-label="Default select example">
                                    <option selected disabled>Open this select menu</option>
                                    @foreach ($users as $user)
                                        @if ($user->roles[0]->name == 'manajer')
                                            <option @selected($overtime_letter->approved_by == $user->id) value="{{ $user->id }}">
                                                {{ $user->name }}</option>
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
