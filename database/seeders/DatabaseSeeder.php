<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Opd;
use App\Models\Lantai;
use App\Models\Fasilitas;
use App\Models\FasilitasDetail;
use App\Models\Gedung;
use App\Models\Ruang;
use App\Models\StatusPinjaman;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'nama_role' => 'User',
        ]);

        Role::create([
            'nama_role' => 'Admin',
        ]);

        Role::create([
            'nama_role' => 'Pemilik Ruangan',
        ]);

        Role::create([
            'nama_role' => 'Verifikator',
        ]);

        Role::create([
            'nama_role' => 'Super Admin',
        ]);

        Gedung::create([
            'nama_gedung' => 'Gedung Kalitaman',
            'alamat_gedung' => 'Letjend., Jl. Sukowati No.51, Kalicacing, Sidomukti, Salatiga City, Central Java 50724',
            'is_active' => 1,
        ]);

        Gedung::create([
            'nama_gedung' => 'Gedung Kalitaman',
            'alamat_gedung' => 'Letjend., Jl. Sukowati No.51, Kalicacing, Sidomukti, Salatiga City, Central Java 50724',
            'is_active' => 1,
        ]);

        Gedung::create([
            'nama_gedung' => 'Gedung Kalitaman',
            'alamat_gedung' => 'Letjend., Jl. Sukowati No.51, Kalicacing, Sidomukti, Salatiga City, Central Java 50724',
            'is_active' => 1,
        ]);

        Opd::create([
            'nama_opd' => 'Badan Kepegawaian Dinas Komunikasi dan Informatika',
            'akronim' => 'bkpsdm',
            'is_active' => '1',
        ]);

        Lantai::create([
            'nomor_lantai' => 1,
            'is_active' => 1,
        ]);

        Lantai::create([
            'nomor_lantai' => 2,
            'is_active' => 1,
        ]);

        Lantai::create([
            'nomor_lantai' => 3,
            'is_active' => 1,
        ]);

        Lantai::create([
            'nomor_lantai' => 4,
            'is_active' => 1,
        ]);

        Lantai::create([
            'nomor_lantai' => 5,
            'is_active' => 1,
        ]);

        Lantai::create([
            'nomor_lantai' => 6,
            'is_active' => 1,
        ]);

        Lantai::create([
            'nomor_lantai' => 7,
            'is_active' => 1,
        ]);

        Lantai::create([
            'nomor_lantai' => 8,
            'is_active' => 1,
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'AC',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'LCD',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Proyektor',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Kipas Angin',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Meja',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Kursi',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Lemari',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Kursi Tamu',
        ]);

        Ruang::create([
            'lantai_id' => 1,
            'gedung_id' => 1,
            'user_id' => 1,
            'nomor_ruang' => 1,
            'deskripsi' => 'AC, Proyektor , Meja , Kursi , tempat nyaman dan bersih',
            'kapasitas' => 20,
            'foto' => null,
            'surat' => 1,
            'is_active' => 1,
        ]);

        Ruang::create([
            'lantai_id' => 1,
            'gedung_id' => 1,
            'user_id' => 1,
            'nomor_ruang' => 2,
            'deskripsi' => 'AC, Proyektor , Meja , Kursi , tempat nyaman dan bersih',
            'kapasitas' => 20,
            'foto' => null,
            'surat' => 1,
            'is_active' => 1,
        ]);

        Ruang::create([
            'lantai_id' => 1,
            'gedung_id' => 1,
            'user_id' => 1,
            'nomor_ruang' => 3,
            'deskripsi' => 'AC, Proyektor , Meja , Kursi , tempat nyaman dan bersih',
            'kapasitas' => 10,
            'foto' => null,
            'surat' => 1,
            'is_active' => 1,
        ]);

        FasilitasDetail::create([
            'fasilitas_id' => 1,
            'ruang_id' => 1,
        ]);

        FasilitasDetail::create([
            'fasilitas_id' => 2,
            'ruang_id' => 1,
        ]);

        FasilitasDetail::create([
            'fasilitas_id' => 3,
            'ruang_id' => 1,
        ]);

        FasilitasDetail::create([
            'fasilitas_id' => 4,
            'ruang_id' => 1,
        ]);

        FasilitasDetail::create([
            'fasilitas_id' => 1,
            'ruang_id' => 2,
        ]);

        FasilitasDetail::create([
            'fasilitas_id' => 2,
            'ruang_id' => 2,
        ]);

        FasilitasDetail::create([
            'fasilitas_id' => 3,
            'ruang_id' => 2,
        ]);

        FasilitasDetail::create([
            'fasilitas_id' => 4,
            'ruang_id' => 2,
        ]);

        User::create([
            'role_id' => 1,
            'opd_id' => 1,
            'nip' => '123456',
            'nama' => 'User Hizkia',
            'no_hp' => '081234567890',
            'email' => 'user@gmail.com',
            'telegram_id' => '1234567890',
            'password' => bcrypt('12345678'),
            'is_active' => 1,
        ]);

        User::create([
            'role_id' => 4,
            'opd_id' => 1,
            'nip' => '1234567',
            'nama' => 'Verifikator Hizkia',
            'no_hp' => '08123456789',
            'email' => 'verifikator@gmail.com',
            'telegram_id' => '123456789',
            'password' => bcrypt('12345678'),
            'is_active' => 1,
        ]);

        StatusPinjaman::create([
            'tipe_status' => 'danger',
            'nama_status' => 'Gagal / Dibatalkan',
        ]);

        StatusPinjaman::create([
            'tipe_status' => 'warning',
            'nama_status' => 'Menunggu Verifikasi',
        ]);

        StatusPinjaman::create([
            'tipe_status' => 'primary',
            'nama_status' => 'Dalam Proses',
        ]);

        StatusPinjaman::create([
            'tipe_status' => 'success',
            'nama_status' => 'Selesai',
        ]);

    }
}