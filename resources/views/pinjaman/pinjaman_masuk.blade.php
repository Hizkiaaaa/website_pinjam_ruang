@extends('layout.app')
@section('heading')
<div class="page-heading">
    <h3>{{ $title }}</h3>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row d-flex">
                </div>
                <div class="table-responsive">
                    <table class="table table-md  text-center">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">ID Pinjaman</th>
                                <th rowspan="2">Nama Peminjam</th>
                                <th rowspan="2">Keperluan</th>
                                <th rowspan="2">Tanggal Peminjaman</th>
                                <th colspan="2">Waktu Peminjaman</th>
                                <th rowspan="2">Jumlah Peserta</th>
                                <th rowspan="2">Catatan</th>
                                <th rowspan="2">Status</th>
                                <th rowspan="2">Aksi</th>

                            </tr>
                            <tr style="border-top:hidden;">
                                <th>Mulai</th>
                                <th>Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($pinjaman) > 0)
                            @foreach ($pinjaman as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->id_pinjaman }}</td>
                                <td>{{ $p->user->nama }}</td>
                                <td>{{ $p->keperluan }}</td>
                                <!-- Format Tanggal -->
                                <td nowrap>{{ date('d M Y', strtotime($p->tanggal_pinjam)) }}</td>
                                <td>{{ $p->jam_pinjam }}</td>
                                <td>{{ $p->jam_selesai }}</td>
                                <td>{{ $p->jumlah_peserta }}</td>
                                <td>{{ $p->catatan }}</td>
                                <td><span
                                        class="badge rounded-pill bg-{{ $p->status_pinjaman->tipe_status }}">{{ $p->status_pinjaman->nama_status }}</span>
                                </td>
                                <td>
                                    @if ($p->status_pinjaman_id == 2)
                                    <button class="btn btn-primary px-4 mb-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#verifikasipinjam{{ $p->id }}">
                                        Verifikasi
                                    </button>
                                    @elseif($p->status_pinjaman_id == 3)
                                    <button class="btn btn-success px-4 mb-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#selesaipinjam{{ $p->id }}">
                                        Selesai
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="2">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($pinjaman as $p)
<!-- Modal Verifikasi Pinjaman -->
<div class="modal fade" id="verifikasipinjam{{ $p->id }}" tabindex="-1" aria-labelledby="verifikasipinjam{{ $p->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifikasipinjam{{ $p->id }}">Verifikasi Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/pinjaman_arsip" method="POST">
                    @csrf
                    <!-- Anda yakin ingin melakukan verifikasi -->
                    <div class="mb-3">
                        <label for="id_pinjaman" class="form-label">ID Pinjaman</label>
                        <input type="text" class="form-control" id="id_pinjaman" name="id_pinjaman"
                            value="{{ $p->id_pinjaman }}" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="tipe" value="verifikasi">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Selesai Pinjaman -->
<div class="modal fade" id="selesaipinjam{{ $p->id }}" tabindex="-1" aria-labelledby="selesaipinjam{{ $p->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selesaipinjam{{ $p->id }}">selesai Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/pinjaman_arsip" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_pinjaman" class="form-label">ID Pinjaman</label>
                        <input type="text" class="form-control" id="id_pinjaman" name="id_pinjaman"
                            value="{{ $p->id_pinjaman }}" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="tipe" value="selesai">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection