<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if($request->from == 'detail_ruangan'){
            alert()->info('Akses di tolak', 'Silahkan login terlebih dahulu sebelum meminjam ruangan');
        }
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login',
        ]);
    }

    public function verifikasi(Request $request){
        $user = User::where('email',$request->email)->first();
        if(empty($user)){
            return back()->with('loginError','Login failed!');
        }
        if($user->is_active != 1){
            return back()->with('loginError','Login failed! Account hasn\'t been activated');
        }
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->role_id == 1){
                return redirect('/');
            } else if(Auth::user()->role_id == 2){
                return redirect('/');
            } else if(Auth::user()->role_id == 3){
                return redirect('/');
            } else if(Auth::user()->role_id == 4){
                return redirect('/');
            } else if(Auth::user()->role_id == 5){
                return redirect('/');
            }
        }
        return back()->with('loginError','Login failed!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}