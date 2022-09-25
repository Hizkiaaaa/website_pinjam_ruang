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
                            data-bs-target="#tambahrole">
                            Tambah Role
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-md  text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($role) > 0)
                            @foreach ($role as $r)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $r->nama_role }}</td>
                                <td><button class="btn btn-primary px-4 mb-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editrole{{ $r->id }}">
                                        Edit
                                    </button></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="2">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {!! $role->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahrole" tabindex="-1" aria-labelledby="tambahroleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahroleLabel">Tambah Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/manajemen_role" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Role</label>
                        <input type="text" name="nama_role" id="nama_role" placeholder="Nama Role" class="form-control"
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
@foreach ($role as $r)
<div class="modal fade" id="editrole{{ $r->id }}" tabindex="-1" aria-labelledby="editroleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editroleLabel">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/manajemen_role/{{ $r->id }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Role</label>
                        <input type="text" name="nama_role" id="nama_role" placeholder="Nama Role" class="form-control"
                            value="{{ $r->nama_role }}" required>
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