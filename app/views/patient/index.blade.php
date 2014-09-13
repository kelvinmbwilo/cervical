@extends('layout.master')

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

<!-- tile -->
<section id="rootwizard" class="tabbable transparent tile">



    <!-- tile header -->
    <div class="tile-header transparent">
        <h1><strong>Form</strong> Wizard</h1>
        <div class="controls">
            <a href="form-wizard.html#" class="minimize"><i class="fa fa-chevron-down"></i></a>
            <a href="form-wizard.html#" class="refresh"><i class="fa fa-refresh"></i></a>
            <a href="form-wizard.html#" class="remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <!-- /tile header -->

    <!-- tile widget -->
    <div class="tile-widget nopadding color transparent-black rounded-top-corners">
        <ul>
            <li><a href="form-wizard.html#tab1" data-toggle="tab">User Data</a></li>
            <li><a href="form-wizard.html#tab2" data-toggle="tab">Contact</a></li>
            <li><a href="form-wizard.html#tab3" data-toggle="tab">EULA</a></li>
        </ul>
    </div>
    <!-- /tile widget -->

    <!-- tile body -->
    <div class="tile-body">

        <div id="bar" class="progress progress-striped active">
            <div class="progress-bar progress-bar-cyan animate-progress-bar"></div>
        </div>

        <div class="tab-content">

            <div class="tab-pane" id="tab1">
                <form class="form-horizontal form1" role="form" parsley-validate>

                    <div class="form-group">
                        <label for="fullname" class="col-sm-2 control-label">Full Name *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fullname" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password *</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passwordconfirm" class="col-sm-2 control-label">Password Confirm *</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="passwordconfirm" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1" parsley-equalto="#password">
                        </div>
                    </div>

                </form>
            </div>

            <div class="tab-pane" id="tab2">

                <form class="form-horizontal form2" role="form" parsley-validate id="contact">

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email *</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-type="email" parsley-validation-minlength="1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="website" class="col-sm-2 control-label">Website</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="website" parsley-trigger="change" parsley-minlength="4" parsley-type="url" parsley-validation-minlength="1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phonenum" class="col-sm-2 control-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phonenum" parsley-trigger="change" parsley-type="phone" parsley-validation-minlength="0" placeholder="1234567891">
                        </div>
                    </div>

                </form>

            </div>

            <div class="tab-pane" id="tab3">

                <form class="form-horizontal form3" role="form" parsley-validate id="eula">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="checkbox">
                                <input type="checkbox" value="1" id="opt01" parsley-trigger="change" parsley-required="true" name="eula">
                                <label for="opt01">EULA acceptation *</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" value="1" id="opt02" name="newsletter">
                                <label for="opt02">Receive newsletter</label>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>
    <!-- /tile body -->

    <!-- tile footer -->
    <div class="tile-footer border-top color white rounded-bottom-corners nopadding">
        <ul class="pager pager-full wizard">
            <li class="previous"><a href="javascript:;"><i class="fa fa-arrow-left fa-lg"></i></a></li>
            <li class="next"><a href="javascript:;"><i class="fa fa-arrow-right fa-lg"></i></a></li>
            <li class="next finish" style="display:none;"><a href="javascript:;"><i class="fa fa-check fa-lg"></i></a></li>
        </ul>
    </div>
    <!-- /tile footer -->




</section>
<!-- /tile -->

Hosptal Number {{ Form::text('hosp_no','',array('class'=>'form-control col-sm-6','placeholder'=>'Hosptal Number','required'=>'required')) }}

<div class="row">
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
<div class="row">
    <h3>Contraceptive History</h3>
    @include('patient.contraceptive')

</div>

<div class="row">
    <h3>Cervical Screening</h3>
    @include('patient.cervical_screening')

</div>

<div class="row">
    <h3>HIV</h3>
    @include('patient.hiv')

</div>

<div class="row">
    <h3>VIA</h3>
    @include('patient.via')

</div>

<div class="row">
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

<div class="row">
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