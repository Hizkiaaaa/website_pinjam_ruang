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

                <a class="btn @if($sort == 'gedung') btn-primary @else btn-outline-primary @endif w-100 mb-2"
                    href="?sort=gedung">
                    Gedung
                </a>
                <a class="btn @if($sort == 'lantai') btn-primary @else btn-outline-primary @endif w-100 mb-2"
                    href="?sort=lantai">
                    Lantai
                </a>
                <a class="btn @if($sort == 'ruang') btn-primary @else btn-outline-primary @endif  w-100 mb-2"
                    href="?sort=ruang">
                    Ruangan
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-9">
        <div class="card">
            <div class="card-header">
                @if ($sort != "")
                <h4>Sorted by : "{{ $sort }}"</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($ruang as $item)
                    <div class="col-xl-4 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-content">
                                @if ($item->foto != null)

                                <img src="{{ asset('storage/'.$item->foto) }}" class="card-img-top img-fluid"
                                    alt="singleminded">
                                @else
                                <img src="{{ url('') }}/assets/images/samples/architecture1.jpg"
                                    class="card-img-top img-fluid" alt="singleminded">
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">Ruang {{ $item->nomor_ruang }}</h5>
                                    <p class="card-text">
                                        Lantai : {{ $item->lantai->nomor_lantai }} <br>
                                        {{ $item->gedung->nama_gedung }}
                                    </p>
                                    <b>Deskripsi : </b>
                                    <p class="card-text">
                                        {{$item->deskripsi}}
                                    </p>
                                </div>
                                <a href="{{ url('dashboard/detail_ruang') }}/{{ $item->id }}"
                                    class="btn btn-primary w-100">Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
