<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'users' => User::with('roles')->get()
        ]);
    }

    public function create()
    {
        return view('user.create', [
            'roles' => Role::all()
        ]);
    }

    public function show($id)
    {
        // $user = User::with('roles')->find($id);
        // foreach($user->roles as $role){
        //     dump($role->name);
        // }
        // die;
        return view('user.show', [
            'user' => User::with('roles')->find($id),
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'role_id' => 'required|numeric',
            'password' => 'required|string'
        ]);

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $payload['name'],
                'email' => $payload['email'],
                'password' => Hash::make($payload['password'])
            ]);
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $payload['role_id']
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('user.index')->withSuccess('simpan data berhasil');
    }

    public function changePassword($id)
    {
        return view('user.change-password', [
            'id' => $id
        ]);
    }

    public function updatePassword(Request $request, $id)
    {
        $payload = $request->validate([
            'password' => 'required|string'
        ]);

        $user = User::find($id);

        try {
            DB::beginTransaction();
            $user->update([
                'password' => Hash::make($payload['password'])
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('user.index')->withSuccess('ubah data password berhasil');
    }

    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'role_id' => 'required|numeric'
        ]);

        $user = User::with('roles')->find($id);
        $currentUserActiveRoleId = $user->roles[0]->id;


        $userRole = UserRole::where('user_id', $id)->where('role_id', $currentUserActiveRoleId)->first();


        if (!$userRole) {
            return redirect()->back()->withErrors('user role not found');
        }

        try {
            DB::beginTransaction();
            $user->update([
                'name' => $payload['name'],
                'email' => $payload['email'],
            ]);
            $userRole->delete();
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $payload['role_id']
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('user.index')->withSuccess('ubah data berhasil');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            User::destroy($id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('user.index')->withSuccess('hapus data berhasil');
    }
}
