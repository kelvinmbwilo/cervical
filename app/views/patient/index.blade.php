@extends('layout.master')

@section('title')
Patient Registration
@stop

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li>
    <a href="{{ url('patients') }}">patients</a>
</li>
<li class="active">Registration</li>

@stop

@section('contents')
<style>
    .panel{
        margin-bottom: 10px;
    }
</style>
@if(isset($msg))
<div class="alert alert-success fade in" role="alert">

    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
    <strong>SUCCESS!</strong> Patient Added Successful.
</div>
@endif
{{ Form::open(array("url"=>url('patient/add'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
<div class="col-md-12" style="padding-left: 5px">
    <div class="col-md-4">
        Hosptal Number {{ Form::text('hosp_no','',array('class'=>'form-control col-sm-6','placeholder'=>'Hosptal Number','required'=>'required')) }}

    </div>
    <div class="col-md-4">
        Phone Number {{ Form::text('phone','',array("pattern"=>"\d+",'maxlength'=>'10','class'=>'form-control col-sm-6','placeholder'=>'Phone Number(0717656637)','required'=>'required')) }}
    </div>
    <div class="col-md-4">
        Facility<br>{{ Form::select('facility',Facility::all()->lists('facility_name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}

    </div>

</div>

<div class="col-md-12">
    <div class="col-md-6" style="padding-left: 0px;padding-right: 5px">
        <h3 style="margin: 0px">Demographic</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('patient.demograph')
            </div>
        </div>

    </div>
    <div class="col-md-6" style="padding-left: 5px;padding-right: 0px">
        <h3 style="margin: 0px">Gynecology History</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('patient.gynocology')
            </div>
        </div>

    </div>

</div>
<div class="col-md-12">
    <h3 style="margin: 0px">Contraceptive History</h3>
    @include('patient.contraceptive')

</div>

<div class="col-md-12">
    <h3 style="margin: 0px">Cervical Screening</h3>
    @include('patient.cervical_screening')

</div>

<div class="col-md-12">
    <h3 style="margin: 0px">HIV</h3>
    @include('patient.hiv')

</div>

<div class="col-md-12">
    <h3 style="margin: 0px">VIA</h3>
    @include('patient.via')

</div>

<div class="col-md-12">
    <div class="col-md-6" style="padding-left: 0px;padding-right: 5px">
        <h3 style="margin: 0px">Colposcopy</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('patient.colposcopy')
            </div>
        </div>

    </div>
    <div class="col-md-6" style="padding-left: 5px;padding-right: 0px">
        <h3 style="margin: 0px">Pap Smear</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('patient.pap_smea')
            </div>
        </div>

    </div>

</div>

<div class="col-md-12">
    <h3 style="margin: 0px">Intervention</h3>
    @include('patient.intervention')

</div>
<div id="output"></div>
<div class='col-sm-12 form-group text-center'>
    <div class="col-sm-5"><input type="text" placeholder="Next Visit On" class="form-control" id="next_visit" name="next_visit"></div>
    <div class="col-sm-7">
    {{ Form::submit('Register',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
    {{ Form::reset('Reset',array('class'=>'btn btn-warning','id'=>'submitqn')) }}
    </div>
</div>
{{ Form::close() }}

<script>
    $(document).ready(function (){
        $("#next_visit").datepicker({
            changeMonth: true,
            changeYear: true,
            minDate:+1,
            dateFormat:"yy-mm-dd"
        });


//        $('#FileUploader').on('submit', function(e) {
//            e.preventDefault();
//            $("#output").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
//            $(this).ajaxSubmit({
//                target: '#output',
//                success:  afterSuccess
//            });
//
//        });

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