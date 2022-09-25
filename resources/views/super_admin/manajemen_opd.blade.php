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
                            data-bs-target="#tambahOPD">
                            Tambah OPD
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-md text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama OPD</th>
                                <th>Akronim</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($opd) > 0)
                            @foreach ($opd as $o)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $o->nama_opd }}</td>
                                <td>{{ $o->akronim }}</td>
                                <td>{{ $o->is_active }}</td>
                                <td><button class="btn btn-primary px-4 mb-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editopd{{ $o->id }}">
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
                    {!! $opd->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahOPD" tabindex="-1" aria-labelledby="tambahOPDLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahOPDLabel">Tambah OPD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/manajemen_opd" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama OPD</label>
                        <input type="text" name="nama_opd" id="nama_opd" placeholder="Nama OPD" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Akronim</label>
                        <input type="text" name="akronim" id="akronim" placeholder="Akronim" class="form-control"
                            required>
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
@foreach ($opd as $o)
<div class="modal fade" id="editopd{{ $o->id }}" tabindex="-1" aria-labelledby="editopd{{ $o->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editopd{{ $o->id }}Label">Edit OPD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/manajemen_opd/{{ $o->id }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama OPD</label>
                        <input type="text" name="nama_opd" id="nama_opd" placeholder="Nama OPD" class="form-control"
                            value="{{ $o->nama_opd }}" required>
                    </div>
                    <div class="form-group">
                        <label>Akronim</label>
                        <input type="text" name="akronim" id="akronim" placeholder="Akronim" class="form-control"
                            value="{{ $o->akronim }}" required>
                    </div>
                    <div class="form-group">
                        <label>Status Aktif</label>
                        <select name="is_active" id="is_active" class="form-control" required>
                            <option value="1" {{ $o->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $o->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
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

@endsection