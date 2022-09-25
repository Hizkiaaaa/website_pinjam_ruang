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
<!-- Selesai Pinjam -->
@foreach ($pinjaman as $p)
<div class="modal fade" id="selesaipinjam{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Selesai Pinjam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/pinjam_arsip" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_pinjaman">ID Pinjaman</label>
                        <input type="text" class="form-control" id="id_pinjaman" name="id_pinjaman"
                            value="{{ $p->id_pinjaman }}" readonly disabled>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status">
                            <option selected>Pilih Status</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
