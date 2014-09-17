@extends('layout.master')

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li>
    <a href="{{ url('reports') }}">Reports</a>
</li>
<li class="active">Colposcopy</li>

@stop

@section('contents')
<h4>Report Generation</h4>
{{ Form::open(array("url"=>url("reports/process/"),"class"=>"form-horizontal","id"=>'formms')) }}
<div class='form-group' style="margin-bottom: 10px">

    <div class='col-sm-3'>
        Region<br>{{ Form::select('region',array('all'=>'all')+Region::all()->lists('region','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-3'>
        District<br><span id="district-area">{{ Form::select('district',array('all'=>'all')+District::lists('district','id'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
    </div>
    <div class='col-sm-2'>
        Marital Status<br>{{ Form::select('marital',array('all'=>"All","Married"=>"Married","Cohabit"=>"Cohabit","Single-never married"=>"Single-never married","Widowed"=>"Widowed","Separated/Divorced"=>"Separated/Divorced"),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-2'>
        From:{{ Form::text('from','',array('class'=>'form-control','placeholder'=>'Start Date','required'=>'required','id'=>'from')) }}
    </div>
    <div class='col-sm-2'>
        To:{{ Form::text('to','',array('class'=>'form-control','placeholder'=>'End Date','required'=>'required','id'=>'to')) }}
    </div>
</div>

<div class='form-group'>
    <div class='col-sm-2'>
        Show<br>{{ Form::select('show',array("VIA Counseling Status"=>"Counseling Status","VIA Test Status"=>"VIA Test Status","Test Results"=>"Test Results","Reason"=>"No Test Reason"),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-2'>
        Vertical(Y-axis)<br>{{ Form::select('vertical',array("Patients"=>"Patients","Visits"=>"Visits"),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-4'>
        Horizontal<br>{{ Form::select('horizontal',array("Year"=>"Year","Years"=>"Years","Age Range"=>"Age Range"),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>

    <div class='col-sm-4 year'>
        Year <br>{{ Form::select('year',array_combine(range(date('Y'),1970), range(date('Y'),1970)),date('Y'),array('class'=>'form-control')) }}
    </div>
    <div class='col-sm-4 age'>
        Age Range <br>{{ Form::select('age',array_combine(range(3,10), range(3,10)),'',array('class'=>'form-control')) }}
    </div>
    <div class='col-sm-4 years'>
        <div class='col-sm-6'>
            Start <br>{{ Form::select('start',array_combine(range(date('Y'),1970), range(date('Y'),1970)),date('Y')-7,array('class'=>'form-control')) }}
        </div>
        <div class='col-sm-6'>
            End<br>{{ Form::select('end',array_combine(range(date('Y'),1970), range(date('Y'),1970)),date('Y'),array('class'=>'form-control')) }}
        </div>
    </div>
</div>


{{ Form::close() }}
<div class="col-xs-12" style="margin-top: 25px">
    <div class="col-md-2 btn btn-primary" id="table">Table</div>
    <div class="col-md-1"></div>
    <div class="col-md-2 btn btn-primary" id="bar">Bar</div>
    <div class="col-md-1"></div>
    <div class="col-md-2 btn btn-primary" id="line">Line</div>
    <div class="col-md-1"></div>
    <div class="col-md-2 btn btn-primary" id="pie">Pie</div>
</div>
<div id="chartarea" class="col-xs-12" style="margin-top: 25px">

</div>
<script>
    $(document).ready(function (){
        var year = $('.year').html();
        var years = $('.years').html();
        var age = $('.age').html();
        $(".years,.age").html("")
        $( "#from" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#to" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#from" ).datepicker( "option", "maxDate", selectedDate );
                if($("#from").val() != ""){
                    $("select[name=horizontal]").val("Age Range");
                    $('.year').html("");
                    $(".years").html("");
                    $('.age').html(age);
                }
            }
        });

        $("select[name=region]").change(function(){
            $("#district-area").html("<i class='fa fa-spinner fa-spin'></i> Wait... ")
            $.post("<?php echo url('patient/region_check1') ?>/"+$(this).val(),function(dat){
                $("#district-area").html(dat);
            })
        })


        $("select[name=horizontal]").change(function(){
            if($(this).val() == "Year"){
                $('.year').html(year);
                $(".years,.age").html("")
                $( "#from,#to").val("").datepicker( "refresh" );
            }else if($(this).val() == "Years"){
                $('.year,.age').html("");
                $(".years").html(years);
                $( "#from,#to").val("").datepicker( "refresh" );
            }else if($(this).val() == "Age Range"){
                $('.year,.years').html("");
                $('.age').html(age);
            }
        });

        //managing chats buttons
        $("#table").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/via/table') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });
        $("#table").trigger("click");

        $("#pie").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/via/pie') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        $("#bar").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/via/bar') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        $("#line").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/via/line') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });
    });

    function afterSuccess(){

    }

</script>
@stop
