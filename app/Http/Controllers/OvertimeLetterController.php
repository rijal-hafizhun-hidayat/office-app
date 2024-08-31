<?php

namespace App\Http\Controllers;

use App\Models\OvertimeLetter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OvertimeLetterController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->roles[0]->name != 'manajer') {
            $overtimeLetter = OvertimeLetter::with('user')->where('user_id', Auth::id())->get();
        } else {
            $overtimeLetter = OvertimeLetter::with('user')->where('approved_by', Auth::id())->get();
        }

        return view('overtime_letter.index', [
            'overtime_letters' => $overtimeLetter,
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('overtime_letter.create', [
            'users' => User::with('roles')->get()
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $payload = $request->validate([
            'date' => 'required|date',
            'started_at' => 'required|date_format:H:i',
            'ended_at' => 'required|date_format:H:i',
            'job' => 'required|string',
            'approved_by' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();
            OvertimeLetter::create([
                'date' => $payload['date'],
                'started_at' => $payload['started_at'],
                'ended_at' => $payload['ended_at'],
                'user_id' => Auth::id(),
                'job' => $payload['job'],
                'approved_by' => $payload['approved_by'],
                'is_approved' => false
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('overtime-letter.index')->withSuccess('simpan data berhasil');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            OvertimeLetter::destroy($id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('overtime-letter.index')->withSuccess('hapus data berhasil');
    }

    public function show($id)
    {
        return view('overtime_letter.show', [
            'users' => User::with('roles')->get(),
            'overtime_letter' => OvertimeLetter::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'date' => 'required|date',
            'started_at' => 'required|date_format:H:i',
            'ended_at' => 'required|date_format:H:i',
            'job' => 'required|string',
            'approved_by' => 'required|numeric'
        ]);

        $overtimeLetter = OvertimeLetter::find($id);

        try {
            DB::beginTransaction();
            $overtimeLetter->update([
                'date' => $payload['date'],
                'started_at' => $payload['started_at'],
                'ended_at' => $payload['ended_at'],
                'user_id' => Auth::id(),
                'job' => $payload['job'],
                'approved_by' => $payload['approved_by']
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('overtime-letter.index')->withSuccess('simpan data berhasil');
    }

    public function approvOvertimeLetter($id)
    {
        $overtimeLetter = OvertimeLetter::find($id);

        try {
            DB::beginTransaction();
            $overtimeLetter->update([
                'is_approved' => true
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('overtime-letter.index')->withSuccess('pengajuan surat lembur berhasil konfirmasi');
    }
}
