@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-12 col-xl-4 mx-auto">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
        </div>
        @endif
        @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
        </div>
        @endif
        <div class="card">
            <div class="card-body">

                <h1 class="auth-title">Log in.</h1>
                <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
                <form action="/login" method="post">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" class="form-control form-control-xl" placeholder="Email" name="email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope fs-4"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password"
                            name="password">
                        <div class="form-control-icon ">
                            <i class="bi bi-shield-lock fs-4"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label " for="flexCheckDefault">
                            Keep me logged in
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                </form>
                <div class="text-center mt-5 text-lg fs-6">
                    <p class="t">Don't have an account? <a href="auth-register.html" class="font-bold">Sign
                            up</a>.</p>
                    <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection