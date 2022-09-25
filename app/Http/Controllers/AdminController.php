<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;
use App\Models\Ruang;
use App\Models\Lantai;

class AdminController extends Controller
{
    public function index()
    {
        $gedung = Gedung::sortable()->paginate(5);
        return view('admin.index', [
            'title' => 'Gedung',
            'gedung' => $gedung,
            'active' => 'olahgedung'
        ]);
    }

    public function tambah_gedung(Request $request)
    {
        // cek gedung
        $cek_gedung = Gedung::where('nama_gedung', $request->nama_gedung)->first();
        if ($cek_gedung) {
            return redirect()->back()->with('error', 'Gedung sudah ada');
        }

        $validateData = $request->validate([
            'nama_gedung' => 'required',
            'alamat_gedung' => 'required',
        ]);
        $validateData['is_active'] = 1;
        Gedung::create($validateData);
        alert()->success('Berhasil', 'Gedung berhasil ditambahkan');
        return back();
    }

    public function edit_gedung(Request $request)
    {
        $validateData = $request->validate([
            'nama_gedung' => 'required',
            'alamat_gedung' => 'required',
            'is_active' => 'required',
        ]);
        Gedung::where('id', $request->id)->update($validateData);
        alert()->success('Berhasil', 'Gedung berhasil diubah');
        return back();
    }

    public function olah_ruang()
    {
        $ruangan = Ruang::sortable()->paginate(5);
        $lantai = Lantai::all();
        $gedung = Gedung::all();
        return view('admin.ruang', [
            'title' => 'Ruangan',
            'ruang' => $ruangan,
            'lantai' => $lantai,
            'gedung' => $gedung,
            'active' => 'ruangan'
        ]);
    }

    public function tambah_ruang(Request $request)
    {
        $user = auth()->user();
        // cek ruang dan gedung dan lantai
        $ruang = Ruang::where('nomor_ruang', $request->nomor_ruang)->where('gedung_id', $request->gedung_id)->where('lantai_id', $request->lantai_id)->first();
        if ($ruang) {
            alert()->error('Gagal', 'Ruang sudah ada');
            return back();
        }

        // upload surat
        $surat = $request->file('surat')->store('surat_ruangan');

        $validateData = $request->validate([
            'nomor_ruang' => 'required',
            'gedung_id' => 'required',
            'lantai_id' => 'required',
            'deskripsi' => 'required',
            'surat' => 'required',
            'foto' => 'image|file|max:5000',
            'kapasitas' => 'required',
        ]);

        if($request->file('foto')){
            $validateData['foto'] = $request->file('foto')->store('foto_ruangan');
        }
        $validateData['user_id'] = $user->id;
        $validateData['surat'] = $surat;
        $validateData['is_active'] = 1;
        Ruang::create($validateData);
        alert()->success('Berhasil', 'Ruang berhasil ditambahkan');
        return back();
    }

    // verifikasi
    public function verifikasi_ruang(Request $request)
    {
        $validateData = $request->validate([
            'is_active' => 'required',
        ]);
        $validateData['user_id'] = auth()->user();
        $ruang = Ruang::where('id', $request->id)->first();
        //update ruang
        $ruang->update($validateData);
        alert()->success('Berhasil', 'Ruang berhasil diverifikasi');
        return back();
    }




}
