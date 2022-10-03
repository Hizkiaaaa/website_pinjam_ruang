@extends('layout.app')
@section('heading')
<div class="page-heading">
    <h3>{{ $title }}</h3>
</div>
@endsection
@section('content')
<style>
#calendar {
    max-width: 1100px;
    margin: 0 auto;
}
</style>
<div class="col-12">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div id="calendar">{!! $calendar->calendar() !!}</div>

                {!! $calendar->script() !!}
            </div>
        </div>
    </div>
</div>
@endsection