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

{{ Form::open(array("url"=>url('patient/add'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
<div class="col-md-12" style="padding-left: 5px">
    <div class="col-md-4">
        Hosptal Number {{ Form::text('hosp_no','',array('class'=>'form-control col-sm-6','placeholder'=>'Hosptal Number','required'=>'required')) }}

    </div>
    <div class="col-md-4">
        Phone Number {{ Form::text('phone','',array('class'=>'form-control col-sm-6','placeholder'=>'Phone Number','required'=>'required')) }}
    </div>
    <div class="col-md-4">
        Facility<br>{{ Form::select('facility',Facility::all()->lists('facility_name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}

    </div>

</div>

<div class="col-md-12">
    <div class="col-md-6" style="padding-left: 0px;padding-right: 5px">
        <h3 class="">Demographic</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('patient.demograph')
            </div>
        </div>

    </div>
    <div class="col-md-6" style="padding-left: 5px;padding-right: 0px">
        <h3 class="">Gynecology History</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('patient.gynocology')
            </div>
        </div>

    </div>

</div>
<div class="col-md-12">
    <h3>Contraceptive History</h3>
    @include('patient.contraceptive')

</div>

<div class="col-md-12">
    <h3>Cervical Screening</h3>
    @include('patient.cervical_screening')

</div>

<div class="col-md-12">
    <h3>HIV</h3>
    @include('patient.hiv')

</div>

<div class="col-md-12">
    <h3>VIA</h3>
    @include('patient.via')

</div>

<div class="col-md-12">
    <div class="col-md-6" style="padding-left: 0px;padding-right: 5px">
        <h3 class="">Colposcopy</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('patient.colposcopy')
            </div>
        </div>

    </div>
    <div class="col-md-6" style="padding-left: 5px;padding-right: 0px">
        <h3 class="">Pap Smear</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                @include('patient.pap_smea')
            </div>
        </div>

    </div>

</div>

<div class="col-md-12">
    <h3>Intervention</h3>
    @include('patient.intervention')

</div>
<div id="output"></div>
<div class='col-sm-12 form-group text-center'>
    {{ Form::submit('Register',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
    {{ Form::reset('Reset',array('class'=>'btn btn-warning','id'=>'submitqn')) }}
</div>
{{ Form::close() }}

<script>
    $(document).ready(function (){

        //initialize form wizard
        $('#rootwizard').bootstrapWizard({

            'tabClass': 'nav nav-tabs tabdrop',
            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').not('.tabdrop').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('#bar .progress-bar').css({width:$percent+'%'});

                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            },

            onNext: function(tab, navigation, index) {

                var form = $('.form' + index)

                form.parsley('validate');

                if(form.parsley('isValid')) {
                    tab.addClass('success');
                } else {
                    return false;
                }

            },

            onTabClick: function(tab, navigation, index) {

                var form = $('.form' + (index+1))

                form.parsley('validate');

                if(form.parsley('isValid')) {
                    tab.addClass('success');
                } else {
                    return false;
                }

            }

        });

        // Initialize tabDrop
        $('.tabdrop').tabdrop({text: '<i class="fa fa-th-list"></i>'});



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