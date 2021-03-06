@extends('layout.report')
@section('title')
Reports
@stop

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>

<li class="active">Reports</li>

@stop

@section('contents')
<h4>Specific Indicators</h4>
{{ Form::open(array("url"=>url("reports/download"),"class"=>"form-horizontal","id"=>'formms')) }}
<div class='form-group' style="margin-bottom: 5px">

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
        From:{{ Form::text('from','',array('class'=>'form-control','placeholder'=>'Start Date','id'=>'from')) }}
    </div>
    <div class='col-sm-2'>
        To:{{ Form::text('to','',array('class'=>'form-control','placeholder'=>'End Date','id'=>'to')) }}
    </div>
</div>
<div class='form-group'>
    <div class='col-sm-2'>
        <?php
$arrayy = array(
    "General" => "General",
    "Marital Status" => "Marital Status",
    "Contraceptive Type" => "Contraceptive Type",
    "Contraceptive History" => "Contraceptive History",
    "HIV Status" => "HIV Status",
    "CD4 Count" => "CD4 Count",
    "Decline Reason" => "Decline Reason",
    "Colposcopy Findings" => "Colposcopy Findings",
    "Colposcopy Status" => "Colposcopy Status",
    "HIV Test  Results" => "HIV Test  Results",
    "Pap Smear Findings" => "Pap Smear Findings",
    "Pap Smear Status"   => "Pap Smear Status",
    "Menarche"   => "Menarche",
    "Parity"   => "Parity",
    "Via Counseling"   => "Via Counseling",
    "Via Tests"   => "Via Tests",
    "Via Test Result"   => "Via Test Result",
    "Via No Test Reason"   => "Via No Test Reason",
    "Number of sexual partners"   => "Number of sexual partners",
    "Age At first Marriage"   => "Age At first Marriage",
    "Total Number of Pregnancy"   => "Total Number of Pregnancy",
    "Age At Sexual Debut"   => "Age At Sexual Debut",
);
?>
        Show<br>{{ Form::select('show',$arrayy,'',array('class'=>'form-control','required'=>'requiered')) }}
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
        Age Range <br>{{ Form::select('age',array_combine(range(3,10), range(3,10)),'5',array('class'=>'form-control')) }}
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

<div class="col-xs-12" style="margin-top: 5px">
    <div style="margin: 10px;margin-left: 0px" class="col-md-1 btn btn-default btn-sm" id="records"><img src="{{ asset('table.png') }}" style="height: 20px;width: 20px" /> Records</div>
    <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="table"><img src="{{ asset('table.png') }}" style="height: 20px;width: 20px" /> Table</div>
    <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="bar"><img src="{{ asset('bar.png') }}" style="height: 20px;width: 20px" /> Bar</div>
    <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="line"><img src="{{ asset('line.png') }}" style="height: 20px;width: 20px" /> Line</div>
    <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="column"><img src="{{ asset('column.png') }}" style="height: 20px;width: 20px" /> Column</div>
    <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="combined"><img src="{{ asset('combined.jpg') }}" style="height: 20px;width: 20px" /> Combined</div>
    <button name="records" style="margin: 10px" type="submit" class="col-md-1 btn btn-default btn-sm"><img src="{{ asset('cvs.jpg') }}" style="height: 20px;width: 20px" /> Records</button>
    <button name='reports' style="margin: 10px" type="submit" class="col-md-1 btn btn-default btn-sm"><img src="{{ asset('cvs.jpg') }}" style="height: 20px;width: 20px" /> Reports</button>
    <button type="button" class="btn btn-info btn-sm pull-right" style="margin: 5px" id="savechat">Save Report</button>
    {{ Form::close() }}
</div>
<div id="chartarea" class="col-xs-12" style="margin-top: 10px">
<script>
    $(document).ready(function (){
         //minimizing the size of input fields
        $("select,input").addClass('input-sm')
        //hidding and showing advance filters
        $(".advancefilters").hide();
        $("#toggleadv").click(function(){
            $(".advancefilters").toggle("slow");
        })

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
                url:"<?php echo url('report/general/table') ?>",
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
                url:"<?php echo url('report/general/pie') ?>",
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
                url:"<?php echo url('report/general/bar') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        $("#combined").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/general/combined') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        $("#records").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/general/records') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        $("#excel").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('reports/download') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        $("#column").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/general/column') ?>",
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
                url:"<?php echo url('report/general/line') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        //saving a chart
        $("#savechat").click(function(){
            var id = $(this).attr("id");
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<h4 class="modal-title" id="myModalLabel">Save Report Variables</h4>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+='Name Of Report<input type="text" name="report"  required="" class="form-control">';
            modal+='<div id="outpp" ></div>';
            modal+= ' </div>';
            modal+= '<div class="modal-footer">';
            modal+= '<button type="button" class="btn btn-primary" id="submitreport">Save</button> ';
            modal+= '</div>';
            modal+= '</div>';
            modal+= '</div>';

            $("body").append(modal);
            $("#myModal").modal("show");
            $("#submitreport").click(function(){
                if($("input[name=report]").val() == ""){
                    $("input[name=report]").attr("placeholder","Write Name First").focus();
                }else{
                    $("#outpp").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Saving Report...</span><h3>");
                    $("#formms").ajaxSubmit({
                        url:"<?php echo url('report/save') ?>",
                        target: '#outpp',
                        data: {name:$("input[name=report]").val()},
                        success:  function(){
                            $("#outpp").html("<h3><i class='fa fa-check text-success'></i><span>Report Saved</span><h3>");
                            setTimeout(function() {
                                $("#myModal").modal("hide");
                            }, 2000);
                        }
                    });
                }
            })
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })
        });
    });

    function afterSuccess(){

    }

</script>
@stop