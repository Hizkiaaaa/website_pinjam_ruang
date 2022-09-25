<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Opd;

class SuperAdminController extends Controller
{
    public function index()
    {
        $user = User::sortable()->paginate(5);
        $role = Role::all();
        $opd = Opd::all();

        return view('super_admin.index', [
            'title' => 'Manajemen User',
            'user' => $user,
            'role' => $role,
            'opd' => $opd,
            'active' => 'manajemen_user'
        ]);
    }

    public function manajemen_opd()
    {
        $opd = Opd::sortable()->paginate(5);
        return view('super_admin.manajemen_opd', [
            'title' => 'Manajemen OPD',
            'opd' => $opd,
            'active' => 'manajemen_opd'
        ]);
    }

    public function manajemen_role()
    {
        $role = Role::sortable()->paginate(5);
        return view('super_admin.manajemen_role', [
            'title' => 'Manajemen Role',
            'role' => $role,
            'active' => 'manajemen_role'
        ]);
    }

    public function tambah_user(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            alert()->error('Gagal', 'Email sudah terdaftar');
            return redirect()->back();
        }
        $validateData = $request->validate([
            'role_id' => 'required',
            'opd_id' => 'required',
            'nama' => 'required',
            'nip' => 'required|min:10|unique:users',
            'no_hp' => 'required|min:10|max:13|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'telegram_id' => 'min:1',
        ]);
        $validateData['is_active'] = 1;

        $user = User::create([
            'role_id' => $validateData['role_id'],
            'opd_id' => $validateData['opd_id'],
            'nama' => $validateData['nama'],
            'nip' => $validateData['nip'],
            'no_hp' => $validateData['no_hp'],
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password']),
            'telegram_id' => $validateData['telegram_id'],
            'is_active' => $validateData['is_active']
        ]);

        alert()->success('Data User berhasil ditambahkan', 'Tambah User success!');
        return back();
    }

    public function tambah_opd(Request $request)
    {

        $validateData = $request->validate([
            'nama_opd' => 'required',
            'akronim' => 'required',
        ]);
        $opd_found = Opd::where('nama_opd', $request->nama_opd)->where('akronim', $request->akronim)->first();
        if ($opd_found) {
            alert()->error('Gagal', 'OPD sudah terdaftar');
            return redirect()->back();
        }
        $validateData['is_active'] = 1;

        $opd = Opd::create([
            'nama_opd' => $validateData['nama_opd'],
            'akronim' => $validateData['akronim'],
            'is_active' => $validateData['is_active']
        ]);

        alert()->success('Data OPD berhasil ditambahkan', 'Tambah OPD success!');
        return back();
    }

    public function tambah_role(Request $request)
    {
        $role_found = Role::where('nama_role', $request->nama_role)->first();
        if ($role_found) {
            alert()->error('Nama Role sudah ada', 'Tambah Role failed!');
            return back();
        }
        $validateData = $request->validate([
            'nama_role' => 'required',
        ]);

        $role = Role::create([
            'nama_role' => $validateData['nama_role'],
        ]);

        alert()->success('Data Role berhasil ditambahkan', 'Tambah Role success!');
        return back();
    }

    public function edit_user(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if(empty($user)){
            alert()->error('Data User tidak ditemukan', 'Edit User failed!');
            return back();
        }

        $validateData = $request->validate([
            'role_id' => 'required',
            'opd_id' => 'required',
            'nama' => 'required',
            'nip' => 'required|min:10',
            'no_hp' => 'required|min:10|max:13',
            'email' => 'required|email',
            'telegram_id' => 'min:1',
            'is_active' => 'required',
        ]);

        $user->role_id = $validateData['role_id'];
        $user->opd_id = $validateData['opd_id'];
        $user->nama = $validateData['nama'];
        $user->nip = $validateData['nip'];
        $user->no_hp = $validateData['no_hp'];
        $user->email = $validateData['email'];
        $user->telegram_id = $validateData['telegram_id'];
        $user->is_active = $validateData['is_active'];
        $user->save();

        alert()->success('Data User berhasil diubah', 'Edit User success!');
        return back();

    }

    public function edit_opd(Request $request)
    {
        $opd = Opd::where('id', $request->id)->first();
        if(empty($opd)){
            alert()->error('Data OPD tidak ditemukan', 'Edit OPD failed!');
            return back();
        }

        $validateData = $request->validate([
            'nama_opd' => 'required',
            'akronim' => 'required',
            'is_active' => 'required',
        ]);

        $opd->nama_opd = $validateData['nama_opd'];
        $opd->akronim = $validateData['akronim'];
        $opd->is_active = $validateData['is_active'];
        $opd->save();

        alert()->success('Data OPD berhasil diubah', 'Edit OPD success!');
        return back();
    }

    public function edit_role(Request $request)
    {
        $role = Role::where('id', $request->id)->first();
        if(empty($role)){
            alert()->error('Data Role tidak ditemukan', 'Edit Role failed!');
            return back();
        }

        $validateData = $request->validate([
            'nama_role' => 'required',
        ]);

        $role->nama_role = $validateData['nama_role'];
        $role->save();

        alert()->success('Data Role berhasil diubah', 'Edit Role success!');
        return back();

    }
}
