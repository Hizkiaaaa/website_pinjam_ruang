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
                            data-bs-target="#tambahuser">
                            Tambah User
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-md  text-center">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th>NIP</th>
                                <th>No Telp</th>
                                <th rowspan="2">Telegram</th>
                                <th>Role</th>
                                <th rowspan="2">Status Aktif</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr style="border-top:hidden;">
                                <th>Nama User</th>
                                <th>Email User</th>
                                <th>OPD User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($user) > 0)
                            @foreach ($user as $u)
                            <tr class="align-bottom">
                                <td rowspan="2">{{ $loop->iteration }}</td>
                                <td>{{ $u->nip }}</td>
                                <td>{{ $u->no_hp }}</td>
                                <td rowspan="2">{{ $u->telegram_id }}</td>
                                <td>{{ $u->role->nama_role }}</td>
                                <td rowspan="2">{{ $u->is_active }}</td>
                                <td><button class="btn btn-primary px-4 mb-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#edituser{{ $u->id }}">
                                        Edit
                                    </button></td>
                            </tr>
                            <tr style="border-top:hidden;" class="align-top">
                                <td>{{ $u->nama }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->opd->nama_opd }}</td>
                                <td>
                                    <button class="btn btn-danger px-4 mb-4" type="button" data-bs-toggle="modal"
                                        data-bs-target="#hapususer{{ $u->id }}">
                                        Hapus
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
                    {!! $user->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahuser" tabindex="-1" aria-labelledby="tambahuserLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahuserLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/manajemen_user" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <label>Role</label>
                        <select type="text" name="role_id" id="role_id" class="form-control">
                            <option value="">-- Silahkan pilih role --</option>
                            @foreach($role as $r)
                            <option value="{{ $r->id }}">{{ $r->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <label>OPD</label>
                        <select type="text" name="opd_id" id="opd_id" class="form-control">
                            <option value="">-- Silahkan pilih OPD --</option>
                            @foreach($opd as $o)
                            <option value="{{ $o->id }}">{{ $o->nama_opd }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nomor Induk Pegawai (NIP)</label>
                        <input type="text" name="nip" id="nip" placeholder="Nomor Induk Pegawai (NIP)"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="tel" name="no_hp" id="no_hp" placeholder="Nomor Handphone" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="email" name="email" id="email" placeholder="Alamat Email" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label>ID Telegram</label>
                        <input type="text" name="telegram_id" id="telegram_id" placeholder="ID Telegram"
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
@foreach ($user as $u)
<div class="modal fade" id="edituser{{ $u->id }}" tabindex="-1" aria-labelledby="edituser{{ $u->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edituser{{ $u->id }}Label">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/manajemen_user/{{ $u->id }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group ">
                        <label>Role</label>
                        <select type="text" name="role_id" id="role_id" class="form-control">
                            <option value="">-- Silahkan pilih role --</option>
                            @foreach($role as $r)
                            <option value="{{ $r->id }}" {{ $u->role_id == $r->id ? 'selected' : '' }}>
                                {{ $r->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <label>OPD</label>
                        <select type="text" name="opd_id" id="opd_id" class="form-control">
                            <option value="">-- Silahkan pilih OPD --</option>
                            @foreach($opd as $o)
                            <option value="{{ $o->id }}" {{ $u->opd_id == $o->id ? 'selected' : '' }}>
                                {{ $o->nama_opd }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nomor Induk Pegawai (NIP)</label>
                        <input type="text" name="nip" id="nip" placeholder="Nomor Induk Pegawai (NIP)"
                            class="form-control" value="{{ $u->nip }}" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" class="form-control"
                            value="{{ $u->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="tel" name="no_hp" id="no_hp" placeholder="Nomor Handphone" class="form-control"
                            value="{{ $u->no_hp }}" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="email" name="email" id="email" placeholder="Alamat Email" class="form-control"
                            value="{{ $u->email }}" required>
                    </div>
                    <div class="form-group">
                        <label>ID Telegram</label>
                        <input type="text" name="telegram_id" id="telegram_id" placeholder="ID Telegram"
                            class="form-control" value="{{ $u->telegram_id }}" required>
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
@foreach ($user as $u)
<div class="modal fade" id="hapususer{{ $u->id }}" tabindex="-1" aria-labelledby="hapususer{{ $u->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapususer{{ $u->id }}Label">Hapus User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/manajemen_user/{{ $u->id }}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus user <b>{{ $u->nama }}</b>?</p>
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