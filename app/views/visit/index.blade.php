@extends('layout.master')

@section('title')
Visit History
@stop

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li>
    <a href="{{ url('patients') }}">patients</a>
</li>

<li>
    <a href="{{ url("patients/{$patient->id}") }}">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</a>
</li>
<li class="active">Follow Up</li>

@stop

@section('contents')
@if(isset($msg))
<div class="alert alert-success fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
    <strong>SUCCESS!</strong> Patient Followup Added Successful.
</div>
@endif
<span class="lead">Visits History For: {{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</span>
<div class="panel-group" id="accordion">
<?php $i=1 ?>
@foreach($patient->visit as $visit)

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $visit->id }}">
                    Visit #{{ $i++ }} <span class="pull-right">{{ date('j M, Y',strtotime($visit->visit_date)) }}</span>
                </a>
            </h4>
        </div>
        <div id="collapse{{ $visit->id }}" class="panel-collapse collapse">
            <div class="panel-body">
                @include('visit.info')
            </div>
        </div>
    </div>
@endforeach

</div>
@stop