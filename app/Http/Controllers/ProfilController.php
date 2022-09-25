<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// Auth
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profil.index', [
            'title' => 'Profil',
            'user' => $user,
            'active' => 'profil'
        ]);
    }

    // tampil form ganti password
    public function view_ganti_password()
    {
        $user = Auth::user();
        return view('profil.ganti_password', [
            'title' => 'Ganti Password',
            'user' => $user,
            'active' => 'profil'
        ]);
    }

    // ganti password
    public function ganti_password(Request $request)
    {
        $user = Auth::user();
        $validateData = $request->validate([
            'password' => 'required',
            'password_baru' => 'required|min:4',
            'password_baru_confirmation' => 'required|min:4|same:password_baru',
        ]);

        if (password_verify($request->password, $user->password)) {
            $user->password = bcrypt($request->password_baru);
            $user->save();
            alert()->success('Berhasil', 'Password berhasil diubah');
            return back();
        } else {
            alert()->error('Gagal', 'Password lama salah');
            return back();
        }
    }


}