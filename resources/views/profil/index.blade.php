@extends('layout.app')
@section('heading')
<div class="page-heading">
    <h3>{{ $title }}</h3>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>NIP</th>
                            <td>:</td>
                            <td>{{ $user->nip }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>OPD</th>
                            <td>:</td>
                            <td>{{ $user->opd->nama_opd }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>:</td>
                            <td>{{ $user->role->nama_role }}</td>
                        </tr>
                        <tr>
                            <th>No Handphone</th>
                            <td>:</td>
                            <td>{{ $user->no_hp }}</td>
                        </tr>
                        <tr>
                            <th>ID Telegram</th>
                            <td>:</td>
                            <td>{{ $user->telegram_id }}</td>
                        </tr>
                        <tr>
                            <th>Join Date</th>
                            <td>:</td>
                            <td>
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                        </tr>

                    </tbody>
                </table>
                <button class="btn btn-primary px-4 mb-4" type="button" data-bs-toggle="modal"
                    data-bs-target="#editprofil">
                    Edit User
                </button>
            </div>
        </div>
    </div>
</div>
@endsection