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
                <!-- Tampil Error -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Form ganti Password -->
                <form action="{{ route('ganti_password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="password">Password Lama</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                    </div>
                    <div class="form-group">
                        <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="password_baru_confirmation"
                            name="password_baru_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
            </div>
        </div>
    </div>
</div>
@endsection