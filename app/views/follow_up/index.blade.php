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
<style>
    .panel{
        margin-bottom: 10px;
    }
</style>
{{ Form::open(array("url"=>url("patient/follow_up/{$patient->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
<div class="col-md-12" style="padding-left: 0px">
    <div class="col-md-4">
        Hosptal Number {{ Form::text('hosp_no',$patient->hospital_id,array('class'=>'form-control col-sm-6','placeholder'=>'Hosptal Number','required'=>'required')) }}

    </div>
    <div class="col-md-4">
        Phone Number {{ Form::text("pattern"=>"\d+",'maxlength'=>'10','phone',$patient->phone,array('class'=>'form-control col-sm-6','placeholder'=>'Phone Number','required'=>'required')) }}
    </div>
    <div class="col-md-4">
        Facility<br>{{ Form::select('facility',Facility::all()->lists('facility_name','id'),$patient->facility_id,array('class'=>'form-control','required'=>'requiered')) }}

    </div>

</div>
<div class="col-md-12">
    <span class="help-block">**The pre filled values are values from last visit.</span>
    <div class="col-md-6" style="padding-left: 0px;padding-right: 5px">
        <h3 class="" style="margin-top: 0px">Demographic</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('follow_up.demograph')
            </div>
        </div>

    </div>
    <div class="col-md-6" style="padding-left: 5px;padding-right: 0px">
        <h3 class="" style="margin-top: 0px">Gynecology History</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('follow_up.gynocology')
            </div>
        </div>

    </div>

</div>
<div class="col-md-12">
    <h3 style="margin-top: 0px">Contraceptive History</h3>
    @include('follow_up.contraceptive')

</div>

<div class="col-md-12">
    <h3 style="margin-top: 0px">HIV</h3>
    @include('follow_up.hiv')

</div>

<div class="col-md-12">
    <h3 style="margin-top: 0px">VIA</h3>
    @include('follow_up.via')

</div>

<div class="col-md-12">
    <div class="col-md-6" style="padding-left: 0px;padding-right: 5px">
        <h3 class="" style="margin-top: 0px">Colposcopy</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('follow_up.colposcopy')
            </div>
        </div>

    </div>
    <div class="col-md-6" style="padding-left: 5px;padding-right: 0px">
        <h3 class="" style="margin-top: 0px">Pap Smear</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('follow_up.pap_smea')
            </div>
        </div>

    </div>

</div>

<div class="col-md-12">
    <h3 style="margin-top: 0px">Intervention</h3>
    @include('follow_up.intervention')

</div>
<div id="output"></div>
<div class='col-sm-12 form-group text-center'>
    <div class="col-sm-5"><input type="text" placeholder="Next Visit On" class="form-control" id="next_visit" name="next_visit"></div>
    <div class="col-sm-5">{{ Form::submit('Submit',array('class'=>'btn btn-primary','id'=>'submitqn')) }}</div>
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