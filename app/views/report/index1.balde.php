@extends("layout.master")


@section('title')
Saved Reports
@stop


@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Saved Reports</li>

@stop

@section('contents')
<div class="row">
    Display Chart<br>
    <span class="col-sm-9">
        {{ Form::select('chat',Report::all()->lists("name","id"),$report,array('class'=>'form-control','required'=>'requiered')) }}
    </span>
</div>
@stop