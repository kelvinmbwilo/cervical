@extends('layout.master')

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Patients</li>

@stop

@section('contents')
<?php
$dash  = Dashboard::first();
$title = $dash->title;
$welcome_note = $dash->welcome_note;
$report = $dash->report;
?>
<h2 class="text-center text-success">Dashboard Settings</h2>
<div class="col-xs-12" style="padding: 15px">

        Title<br>
        <span class="col-sm-9"><input type="text" class="form-control" name="name" value="{{ $title }}"></span>
        <a href="#s" type="button" id="addtext" class="btn btn-info">Change</a>

<!--    <div class="col-sm-4">-->
<!--        Logo-->
<!--        <input type="file" name="logo">-->
<!--        <button type="button" id="addlogo" class="btn btn-info pull-right">Change</button>-->
<!---->
<!--    </div>-->
</div>

<div class="col-xs-12" style="padding: 15px">
    Welcome Note<br>
    <span class="col-sm-9"><textarea rows="10" class="form-control" name="welcome">{{ $welcome_note }}</textarea></span>
    <button type="button" id="addwelcome" class="btn btn-info">Change</button>
</div>

<div class="col-xs-12" style="padding: 15px">
    Display Chart<br>
    <span class="col-sm-9">
        {{ Form::select('chat',Report::all()->lists("name","id"),$report,array('class'=>'form-control','required'=>'requiered')) }}
    </span>
    <a href="#s" type="button" id="addchat" class="btn btn-info">Change</a>
</div>
<script>
    $(document).ready(function(){
        $("#addtext").click(function(){
            if($("input[name=name]").val() == ""){
                $("input[name=name]").attr("placeholder","Write Something First").focus();
            }else{
                $(this).html("<i class='fa fa-spin fa-spinner'></i> Saving... ")
                $.post("<?php echo url("dashboard/title") ?>",{name:$("input[name=name]").val()},function(){
                    $("#addtext").html("<i class='fa fa-check'></i> Saved");
                    setTimeout(function() {
                        $("#addtext").html("Change");
                    }, 2000);
                });
            }
        });

        //changing welcome note
        $("#addwelcome").click(function(){
            if($("textarea[name=welcome]").val() == ""){
                $("textarea[name=welcome]").attr("placeholder","Write Something First").focus();
            }else{
                $(this).html("<i class='fa fa-spin fa-spinner'></i> Saving... ")
                $.post("<?php echo url("dashboard/welcome_note") ?>",{name:$("textarea[name=welcome]").val()},function(){
                    $("#addwelcome").html("<i class='fa fa-check'></i> Saved");
                    setTimeout(function() {
                        $("#addwelcome").html("Change");
                    }, 2000);
                });
            }
        })

        //changing welcome note
        $("#addchat").click(function(){
            if($("select[name=caht]").val() == ""){
                $("select[name=chat]").attr("placeholder","Write Something First").focus();
            }else{
                $(this).html("<i class='fa fa-spin fa-spinner'></i> Saving... ")
                $.post("<?php echo url("dashboard/chat") ?>",{name:$("select[name=chat]").val()},function(){
                    $("#addchat").html("<i class='fa fa-check'></i> Saved");
                    setTimeout(function() {
                        $("#addchat").html("Change");
                    }, 2000);
                });
            }
        })
    })
</script>
@stop