<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\User;
use App\Models\Ruang;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PinjamanController extends Controller
{
    public function pinjaman_arsip()
    {
        $pinjaman = Pinjaman::all();
        return view('pinjaman.index', [
            'title' => 'Pinjaman Arsip',
            'pinjaman' => $pinjaman,
            'active' => 'pinjaman-arsip'
        ]);
    }

    public function index()
    {
        $pinjaman = Pinjaman::where('user_id', Auth::user()->id)->get();
        return view('pinjaman.pinjaman_saya', [
            'title' => 'Pinjaman Saya',
            'pinjaman' => $pinjaman,
            'active' => 'pinjaman-saya'
        ]);
    }

    // verifikasi dan selesai
    public function verifikasi_selesai(Request $request)
    {
        $pinjaman = Pinjaman::where('id_pinjaman', $request->id_pinjaman)->first();
        // Jika pinjaman tidak ditemukan
        if (!$pinjaman) {
            Alert::error('Gagal', 'Pinjaman tidak ditemukan');
            return redirect()->back();
        }

        if($request->tipe == 'verifikasi'){
            $pinjaman->status_pinjaman_id = 3;
            $pinjaman->save();
            Alert::success('Berhasil', 'Pinjaman berhasil diverifikasi');
            return redirect()->back();
        } else if($request->tipe == 'selesai'){
            $pinjaman->status_pinjaman_id = 4;
            $pinjaman->save();

            // Ubah Status Ruangan
            $ruang = Ruang::where('id', $pinjaman->ruang_id)->first();
            $ruang->is_active = 1;
            $ruang->save();

            Alert::success('Berhasil', 'Pinjaman berhasil diselesaikan');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Pinjaman gagal dilakukan');
            return redirect()->back();
        }
    }

    public function pinjaman_masuk()
    {
        $pinjaman = Pinjaman::where('status_pinjaman_id','!=', 4)->get();
        return view('pinjaman.pinjaman_masuk', [
            'title' => 'Pinjaman Masuk',
            'pinjaman' => $pinjaman,
            'active' => 'pinjaman-masuk'
        ]);
    }




}
