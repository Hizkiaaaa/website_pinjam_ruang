@extends('layout.app')
@section('heading')
<div class="page-heading">
    <h3>{{ $title }}</h3>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-xl-3">
        <div class="card">
            <div class="card-header">
                <h4>Filter</h4>
            </div>
            <div class="card-body">
                <button class="btn btn-primary w-100 mb-2">
                    Gedung
                </button>
                <button class="btn btn-outline-primary w-100 mb-2">
                    Gedung
                </button>
                <button class="btn btn-outline-primary w-100 mb-2">
                    Gedung
                </button>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-9">
        <div class="card">
            <div class="card-header">
                <h4>Sorted by : "Gedung"</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-content">
                                <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                    alt="singleminded">
                                <div class="card-body">
                                    <h5 class="card-title">Ruang A</h5>
                                    <h5 class="card-text">
                                        Gedung A
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-content">
                                <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                    alt="singleminded">
                                <div class="card-body">
                                    <h5 class="card-title">Ruang A</h5>
                                    <h5 class="card-text">
                                        Gedung A
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-content">
                                <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                    alt="singleminded">
                                <div class="card-body">
                                    <h5 class="card-title">Ruang A</h5>
                                    <h5 class="card-text">
                                        Gedung A
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection