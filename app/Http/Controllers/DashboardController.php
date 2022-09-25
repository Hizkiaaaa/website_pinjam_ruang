<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;
use App\Models\Pinjaman;
// Auth
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $ruangan = Ruang::all();
        $sorts = "";
        if($request->has('sort')){
            try {
                $sort = $request->sort;
                if($sort != "ruang"){
                    $sort = $sort . '_id';
                } elseif($sort == "ruang"){
                    $sort = 'nomor_ruang';
                }
                $ruangan = Ruang::orderBy($sort,'ASC')->get();
                $sorts = $request->sort;
            } catch (\Throwable $th) {
                $ruangan = Ruang::all();
            }
        }

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'ruang' => $ruangan,
            'sort' => $sorts,
            'active' => 'dashboard'
        ]);
    }

    public function ruang(Request $request)
    {
        $ruangan = Ruang::all();
        $sorts = "";
        if($request->has('sort')){
            try {
                $sort = $request->sort;
                if($sort != "ruang"){
                    $sort = $sort . '_id';
                } elseif($sort == "ruang"){
                    $sort = 'nomor_ruang';
                }
                $ruangan = Ruang::orderBy($sort,'ASC')->get();
                $sorts = $request->sort;
            } catch (\Throwable $th) {
                $ruangan = Ruang::all();
            }
        }

        return view('dashboard.ruangan', [
            'title' => 'Ruangan',
            'ruang' => $ruangan,
            'sort' => $sorts,
            'active' => 'ruang'
        ]);
    }

    public function generateIdPinjaman() {
        $number = mt_rand(1000000000, 9999999999);

        if (Pinjaman::where('id_pinjaman', $number)->exists()) {
            return generateIdPinjaman();
        }
        return $number;
    }

    public function view_detail_ruang($id)
    {
        $ruang = Ruang::where('id', $id)->first();
        return view('dashboard.detail_ruang', [
            'title' => 'Detail Ruang',
            'ruang' => $ruang,
            'active' => 'olahgedung'
        ]);
    }

    public function pinjam_ruang($id, Request $request)
    {
        $ruang = Ruang::where('id', $id)->first();
        $user = Auth::user();
        // validate data
        $validateData = $request->validate([
            'tanggal_pinjam' => 'required',
            'jam_pinjam' => 'required',
            'jam_selesai' => 'required',
            'keperluan' => 'required',
        ]);

        if($validateData['tanggal_pinjam'] < date('Y-m-d')){
            return redirect()->back()->with('error', 'Tanggal pinjam tidak boleh kurang dari hari ini');
        }

        if($validateData['jam_pinjam'] <= date('H:i:s') && $validateData['tanggal_pinjam'] == date('Y-m-d')){
            return redirect()->back()->with('error', 'Jam pinjam tidak boleh kurang dari jam sekarang');
        }

        if($validateData['jam_pinjam'] >= $validateData['jam_selesai']){
            return redirect()->back()->with('error', 'Jam selesai tidak boleh kurang dari jam pinjam');
        }

        if($ruang->is_active == 0){
            return redirect()->back()->with('error', 'Ruang tidak tersedia');
        }

        $validateData['jumlah_peserta'] = $ruang->kapasitas;
        $validateData['tanggal_pinjam'] = date('Y-m-d', strtotime($validateData['tanggal_pinjam']));
        $validateData['jam_pinjam'] = date('H:i:s', strtotime($validateData['jam_pinjam']));
        $validateData['jam_selesai'] = date('H:i:s', strtotime($validateData['jam_selesai']));
        $validateData['catatan'] = $request->catatan;
        $validateData['user_id'] = $user->id;
        $validateData['ruang_id'] = $ruang->id;
        $validateData['status_pinjaman_id'] = 2;
        $validateData['id_pinjaman'] = $this->generateIdPinjaman();

        Pinjaman::create($validateData);
        $ruang->is_active = 0;
        $ruang->save();

        alert()->success('Berhasil', 'Berhasil meminjam ruangan');
        return back();
    }


}