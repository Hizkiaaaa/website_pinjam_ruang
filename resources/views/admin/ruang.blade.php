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
                    <div class="justify-content-between">
                        <button class="btn btn-primary px-4 mb-4" type="button" data-bs-toggle="modal"
                            data-bs-target="#tambahRuang">
                            Tambah Ruang
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-md text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lantai</th>
                                <th>Nama Gedung</th>
                                <th>Nomor Ruang</th>
                                <th>Deskripsi</th>
                                <th>Kapasitas</th>
                                <th>Foto</th>
                                <th>Surat</th>
                                <th>Status Aktif</th>
                                <th>Verifikator</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($ruang) > 0)
                            @foreach ($ruang as $r)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $r->lantai->nomor_lantai }}</td>
                                <td>{{ $r->gedung->nama_gedung }}</td>
                                <td>{{ $r->nomor_ruang }}</td>
                                <td>{{ $r->deskripsi }}</td>
                                <td>{{ $r->kapasitas }}</td>
                                <td>
                                    @if ($r->foto)
                                    <img src="{{ asset('storage/'.$r->foto) }}" alt="" width="100px">
                                    @else
                                    <img src="{{ asset('storage/foto_ruangan/default.png') }}" alt="" width="100px">
                                    @endif
                                </td>
                                <td><a href="{{ asset('storage/'.$r->surat) }}" target="_blank">Lihat Surat</a></td>
                                <td>{{ $r->is_active }}</td>
                                <td>
                                    @if($r->verifikator_id)
                                    {{ $r->verifikator_id }}
                                    @else
                                    Belum diverifikasi <br>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#verifikasiRuang{{ $r->id }}">
                                        Verifikasi
                                    </button>
                                    @endif
                                </td>
                                <td><button class="btn btn-primary px-4 mb-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editRuang{{ $r->id }}">
                                        Edit
                                    </button></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {!! $ruang->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Membuat form tambah ruang --}}
<div class="modal fade" id="tambahRuang" tabindex="-1" aria-labelledby="tambahRuangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahRuangLabel">Tambah Ruang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/olahruang" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="lantai_id">Lantai</label>
                        <select class="form-select" name="lantai_id" id="lantai_id" required>
                            <option value="">Pilih Lantai</option>
                            @foreach ($lantai as $l)
                            <option value="{{ $l->id }}">{{ $l->nomor_lantai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gedung_id">Gedung</label>
                        <select class="form-select" name="gedung_id" id="gedung_id" required>
                            <option value="">Pilih Gedung</option>
                            @foreach ($gedung as $g)
                            <option value="{{ $g->id }}">{{ $g->nama_gedung }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_ruang">Nomor Ruang</label>
                        <input type="text" class="form-control" id="nomor_ruang" name="nomor_ruang" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kapasitas">Kapasitas</label>
                        <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
                    </div>
                    <div class="form-group">
                        <label for="surat">Surat</label>
                        <input type="file" class="form-control" id="surat" name="surat" required>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Status Aktif</label>
                        <select class="form-select" name="is_active" id="is_active" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Membuat form edit ruang --}}
@foreach ($ruang as $r)
<div class="modal fade" id="editRuang{{ $r->id }}" tabindex="-1" aria-labelledby="editRuangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRuangLabel">Edit Ruang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/olaheditruang" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="lantai_id">Lantai</label>
                        <select class="form-select" name="lantai_id" id="lantai_id" required>
                            <option value="">Pilih Lantai</option>
                            @foreach ($lantai as $l)
                            <option value="{{ $l->id }}" {{ $r->lantai_id == $l->id ? 'selected' : '' }}>
                                {{ $l->nomor_lantai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gedung_id">Gedung</label>
                        <select class="form-select" name="gedung_id" id="gedung_id" required>
                            <option value="">Pilih Gedung</option>
                            @foreach ($gedung as $g)
                            <option value="{{ $g->id }}" {{ $r->gedung_id == $g->id ? 'selected' : '' }}>
                                {{ $g->nama_gedung }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_ruang">Nomor Ruang</label>
                        <input type="text" class="form-control" id="nomor_ruang" name="nomor_ruang"
                            value="{{ $r->nomor_ruang }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $r->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="kapasitas">Kapasitas</label>
                        <input type="number" class="form-control" id="kapasitas" name="kapasitas"
                            value="{{ $r->kapasitas }}" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="form-group">
                        <label for="surat">Surat</label>
                        <input type="file" class="form-control" id="surat" name="surat">
                    </div>
                    <div class="form-group">
                        <label for="is_active">Status Aktif</label>
                        <select class="form-select" name="is_active" id="is_active" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif" {{ $r->is_active == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ $r->is_active == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                Aktif</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- Form Verifikasi ruang -->
@foreach ($ruang as $r)
<div class="modal fade" id="verifikasiRuang{{ $r->id }}" tabindex="-1" aria-labelledby="verifikasiRuangLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifikasiRuangLabel">Verifikasi Ruang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/olahruang" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <form action="/pinjaman_arsip" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nomor_ruang">Nomor Ruang</label>
                            <input type="text" class="form-control" id="nomor_ruang" name="nomor_ruang"
                                value="{{ $r->nomor_ruang }}" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="tipe"
                                value="verifikasi">Selesai</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach



@endsection