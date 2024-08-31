@extends('app')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-row-reverse">
                        <div>
                            <a href="{{ route('overtime-letter.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam mulai</th>
                                <th scope="col">Jam selesai</th>
                                <th scope="col">Durasi jam</th>
                                <th scope="col">Pekerjaan</th>
                                @if ($user->roles[0]->name == 'manajer')
                                    <th scope="col">Penerima Tugas</th>
                                @endif
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($overtime_letters as $overtime_letter)
                                @php
                                    $startedAt = \Carbon\Carbon::parse($overtime_letter->started_at);
                                    $endedAt = \Carbon\Carbon::parse($overtime_letter->ended_at);

                                    $diffHour = $startedAt->diffInhours($endedAt);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($overtime_letter->date)->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($overtime_letter->started_at)->translatedFormat('H:i') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($overtime_letter->ended_at)->translatedFormat('H:i') }}
                                    </td>
                                    <td>{{ $diffHour }} Jam</td>
                                    <td>{{ $overtime_letter->job }}</td>
                                    @if ($user->roles[0]->name == 'manajer')
                                        <td>{{ $overtime_letter->user->name }}</td>
                                    @endif
                                    <td>
                                        @if ($overtime_letter->is_approved == true)
                                            <button type="button" class="btn btn-success">ACC</button>
                                        @else
                                            <button type="button" class="btn btn-danger">Belum ACC</button>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('overtime-letter.show', ['id' => $overtime_letter->id]) }}"
                                                    class="btn btn-warning">Show</a>
                                            </div>
                                            <div class="col">
                                                <form
                                                    action="{{ route('overtime-letter.destroy', ['id' => $overtime_letter->id]) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                            @if ($user->roles[0]->name == 'manajer')
                                                <div class="col">
                                                    <form
                                                        action="{{ route('overtime-letter.approved.index', ['id' => $overtime_letter->id]) }}"
                                                        method="post">
                                                        @method('patch')
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                    </form>
                                                </div>
                                            @endif
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
