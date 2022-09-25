@extends('layout.app')
@section('heading')
<div class="page-heading">
    <h3>{{ $title }}</h3>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <!-- Error -->
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{ session('error') }}
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header text-center">
                <h3>Detail Ruangan {{ $ruang->nomor_ruang }} </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <img src="{{ url('') }}/assets/images/samples/motorcycle.jpg" alt=""
                            class="img-fluid rounded shadow">
                    </div>
                    <div class="col-12 col-xl-8 mt-3">
                        <!-- table detail ruang -->
                        <table class="table table-borderless">
                            <tr>
                                <th>Nomor Ruang</th>
                                <td>:</td>
                                <td>{{ $ruang->nomor_ruang }}</td>
                            </tr>
                            <tr>
                                <th>Lantai</th>
                                <td>:</td>
                                <td>{{ $ruang->lantai->nomor_lantai }}</td>
                            </tr>
                            <tr>
                                <th>Gedung</th>
                                <td>:</td>
                                <td>{{ $ruang->gedung->nama_gedung }}</td>
                            </tr>
                            <tr>
                                <th>Kapasitas</th>
                                <td>:</td>
                                <td>{{ $ruang->kapasitas }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>:</td>
                                <td>{{ $ruang->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th>Status Aktif</td>
                                <td>:</td>
                                <td>
                                    @if ($ruang->is_active == 1)
                                    <span class="badge bg-success">Aktif</span>
                                    @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <!-- end table detail ruang -->
                    </div>
                </div>
                <!-- Make button to pinjam -->
                <div class="row">
                    @if(!Auth::check())
                    <div class="col-12 col-xl-12 text-center">
                        <a href="/login?from=detail_ruangan" class="btn btn-primary">Pinjam Ruangan</a>
                    </div>
                    @else
                    <button class="btn btn-primary px-4 mt-4  col-12 col-md-6 col-xl-3 mx-auto" type="button"
                        data-bs-toggle="modal" data-bs-target="#pinjamruang">
                        Pinjam Ruangan
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@if (!Auth::check())

@else
<div class="modal fade" id="pinjamruang" tabindex="-1" aria-labelledby="pinjamruangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pinjamruangLabel">Pinjam Ruangan {{ $ruang->nomor_ruang }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/detail_ruang/{{ $ruang->id }}" method="POST">
                    @csrf
                    <input type="hidden" name="ruang_id" value="{{ $ruang->id }}">
                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam">
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="jam_pinjam" class="form-label">Jam Pinjam</label>
                            <input type="time" class="form-control" id="jam_pinjam" name="jam_pinjam">
                        </div>
                        <div class="col">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="keperluan" class="form-label">Keperluan</label>
                        <textarea class="form-control" id="keperluan" name="keperluan" rows="3"
                            placeholder="Mauskkan keperluan peminjaman..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->nama }}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->no_hp }}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3"
                            placeholder="Masukkan catatan tambahan..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pinjam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
