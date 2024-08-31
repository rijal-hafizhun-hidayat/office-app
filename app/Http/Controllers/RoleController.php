<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index', [
            'roles' => Role::all()
        ]);
    }

    public function create()
    {
        return view('role.create');
    }

    public function show($id)
    {
        return view('role.show', [
            'role' => Role::find($id)
        ]);
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'name' => 'required|string'
        ]);

        try {
            DB::beginTransaction();
            Role::create([
                'name' => $payload['name']
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('role.index')->withSuccess('simpan role berhasil');
    }

    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'name' => 'required|string'
        ]);

        $role = Role::find($id);
        try {
            DB::beginTransaction();
            $role->update([
                'name' => $payload['name']
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('role.index')->withSuccess('ubah role berhasil');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Role::destroy($id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('role.index')->withSuccess('hapus data berhasil');
    }
}
