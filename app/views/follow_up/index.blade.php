@extends('layout.master')

@section('title')
 Patient Followup
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
<h3><i class="fa fa-user-md"></i> Patient Follow Up<span class="pull-right">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</span> </h3>
{{ Form::open(array("url"=>url("patient/follow_up/{$patient->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
Hosptal Number {{ Form::text('hosp_no', $patient->hospital_id ,array('class'=>'form-control col-sm-6','placeholder'=>'Hosptal Number','required'=>'required')) }}
<div class="row">
    <span class="help-block">**The pre filled values are values from last visit.</span>
    <div class="col-md-6" style="padding-left: 0px;padding-right: 5px">
        <h3 class="">Demographic</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('follow_up.demograph')
            </div>
        </div>

    </div>
    <div class="col-md-6" style="padding-left: 5px;padding-right: 0px">
        <h3 class="">Gynecology History</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('follow_up.gynocology')
            </div>
        </div>

    </div>

</div>
<div class="row">
    <h3>Contraceptive History</h3>
    @include('follow_up.contraceptive')

</div>

<div class="row">
    <h3>HIV</h3>
    @include('follow_up.hiv')

</div>

<div class="row">
    <h3>VIA</h3>
    @include('follow_up.via')

</div>

<div class="row">
    <div class="col-md-6" style="padding-left: 0px;padding-right: 5px">
        <h3 class="">Colposcopy</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('follow_up.colposcopy')
            </div>
        </div>

    </div>
    <div class="col-md-6" style="padding-left: 5px;padding-right: 0px">
        <h3 class="">Pap Smear</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('follow_up.pap_smea')
            </div>
        </div>

    </div>

</div>

<div class="row">
    <h3>Intervention</h3>
    @include('follow_up.intervention')

</div>
<div id="output"></div>
<div class='col-sm-12 form-group text-center'>
    {{ Form::submit('Submit',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
</div>
{{ Form::close() }}

<script>
    $(document).ready(function (){
        $('#FileUploader').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
<!--            $('#FileUploader').resetForm();-->
<!--            setTimeout(function() {-->
<!--                $("#output").html("");-->
<!--            }, 3000);-->
<!--            $("#listuser").load("--><?php //echo url("user/list/fgdf") ?><!--")-->
        }
    });
</script>
@stop