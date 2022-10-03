<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CalendarController::class, 'index'])->name('calendar');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/detail_ruang/{id}', [DashboardController::class, 'view_detail_ruang'])->name('detail_ruang');
Route::post('/dashboard/detail_ruang/{id}', [DashboardController::class, 'pinjam_ruang'])->name('detail_ruang');

Route::get('/ruangan', [DashboardController::class, 'ruang'])->name('ruang');

Route::get('/tentangkami', [AboutUsController::class, 'index'])->name('about_us');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'verifikasi'])->name('login')->middleware('guest');

Route::get('/manajemen_user', [SuperAdminController::class, 'index'])->name('manajemen_user')->middleware('is_super_admin');
Route::post('/manajemen_user', [SuperAdminController::class, 'tambah_user'])->name('manajemen_user')->middleware('is_super_admin');
Route::post('/manajemen_user/{id}', [SuperAdminController::class, 'edit_user'])->name('manajemen_user')->middleware('is_super_admin');

Route::get('/manajemen_opd', [SuperAdminController::class, 'manajemen_opd'])->name('manajemen_opd')->middleware('is_super_admin');
Route::post('/manajemen_opd', [SuperAdminController::class, 'tambah_opd'])->name('manajemen_opd')->middleware('is_super_admin');
Route::post('/manajemen_opd/{id}', [SuperAdminController::class, 'edit_opd'])->name('manajemen_opd')->middleware('is_super_admin');

Route::get('/manajemen_role', [SuperAdminController::class, 'manajemen_role'])->name('manajemen_role')->middleware('is_super_admin');
Route::post('/manajemen_role', [SuperAdminController::class, 'tambah_role'])->name('manajemen_role')->middleware('is_super_admin');
Route::post('/manajemen_role/{id}', [SuperAdminController::class, 'edit_role'])->name('manajemen_role')->middleware('is_super_admin');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil')->middleware('auth');

Route::get('/ganti_password', [ProfilController::class, 'view_ganti_password'])->name('ganti_password')->middleware('auth');
Route::post('/ganti_password', [ProfilController::class, 'ganti_password'])->name('ganti_password')->middleware('auth');

Route::get('/olahgedung', [AdminController::class, 'index'])->name('gedung')->middleware('is_admin');
Route::post('/olahgedung', [AdminController::class, 'tambah_gedung'])->name('gedung')->middleware('is_admin');
Route::post('/olahgedung/{id}', [AdminController::class, 'edit_gedung'])->name('gedung')->middleware('is_admin');
Route::get('/hapusgedung/{id}', [AdminController::class, 'hapus_gedung'])->name('gedung')->middleware('is_admin');

Route::get('/olahruang', [AdminController::class, 'olah_ruang'])->name('ruangan')->middleware('is_admin');
Route::post('/olahruang', [AdminController::class, 'tambah_ruang'])->name('ruangan')->middleware('is_admin');
Route::post('/olahruang/{id}', [AdminController::class, 'edit_ruang'])->name('ruangan')->middleware('is_admin');
Route::post('/olahruangverifikasi', [AdminController::class, 'verifikasi_ruang'])->name('ruangan')->middleware('is_admin');
Route::post('/hapusruang/{id}', [AdminController::class, 'hapus_ruang'])->name('ruangan')->middleware('is_admin');

Route::get('/pinjaman_saya', [PinjamanController::class, 'index'])->name('pinjaman_saya')->middleware('auth');
Route::get('/pinjaman_arsip', [PinjamanController::class, 'pinjaman_arsip'])->name('pinjaman_arsip')->middleware('is_admin');
Route::post('/pinjaman_arsip', [PinjamanController::class, 'verifikasi_selesai'])->name('pinjaman_arsip')->middleware('is_admin');

// Pinjaman masuk
Route::get('/pinjaman_masuk', [PinjamanController::class, 'pinjaman_masuk'])->name('pinjaman_masuk')->middleware('is_admin');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');