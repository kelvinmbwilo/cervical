@extends("layout.master")


@section('title')
Facilities Management
@stop


@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Facilities</li>

@stop

@section('contents')
<div class="row">

    <div id="listfacility">
        @include('facilities.list')
    </div>
</div>
@stop