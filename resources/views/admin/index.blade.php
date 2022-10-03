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
                            data-bs-target="#tambahGedung">
                            Tambah Gedung
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-md text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Gedung</th>
                                <th>Alamat Gedung</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($gedung) > 0)
                            @foreach ($gedung as $g)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $g->nama_gedung }}</td>
                                <td>{{ $g->alamat_gedung }}</td>
                                <td>
                                    @if ($g->is_active == 1)
                                    <span class="badge bg-success">Aktif</span>
                                    @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary px-4 mb-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editgedung{{ $g->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger px-4 mb-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#hapusgedung{{ $g->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {!! $gedung->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahGedung" tabindex="-1" aria-labelledby="tambahGedungLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahGedungLabel">Tambah gedung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/olahgedung" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Gedung</label>
                        <input type="text" name="nama_gedung" id="nama_gedung" placeholder="Nama Gedung"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Gedung</label>
                        <input type="text" name="alamat_gedung" id="alamat_gedung" placeholder="Alamat Gedung"
                            class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Membuat Edit OPD --}}
@foreach ($gedung as $g)
<div class="modal fade" id="editgedung{{ $g->id }}" tabindex="-1" aria-labelledby="editgedung{{ $g->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editgedung{{ $g->id }}Label">Edit gedung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/olahgedung/{{ $g->id }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama gedung</label>
                        <input type="text" name="nama_gedung" id="nama_gedung" placeholder="Nama gedung"
                            class="form-control" value="{{ $g->nama_gedung }}" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Gedung</label>
                        <input type="text" name="alamat_gedung" id="alamat_gedung" placeholder="Alamat Gedung"
                            class="form-control" value="{{ $g->alamat_gedung }}" required>
                    </div>
                    <div class="form-group">
                        <label>Status Aktif</label>
                        <select name="is_active" id="is_active" class="form-control" required>
                            <option value="1" {{ $g->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $g->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
{{-- Membuat Hapus OPD --}}
@foreach ($gedung as $g)
<div class="modal fade" id="hapusgedung{{ $g->id }}" tabindex="-1" aria-labelledby="hapusgedung{{ $g->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusgedung{{ $g->id }}Label">Hapus gedung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/hapusgedung/{{ $g->id }}" method="post">
                @csrf
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus gedung {{ $g->nama_gedung }}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection