@extends("layout.master")

@section('title')
{{ Auth::user()->firstname}} {{ Auth::user()->lastname}} profile
@stop
@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">User Profile</li>

@stop

@section('contents')

<div class="panel panel-default">
    <div class="panel-body">
        {{ Form::open(array("url"=>url("user/edit/{$user->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
        <h3 class="text-center text-muted">Update Your Information</h3>
        <div class='form-group'>

            <div class='col-sm-6'>
                First Name <br>  {{ Form::text('firstname',$user->firstname,array('class'=>'form-control','placeholder'=>'First Name','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Middle Name<br> {{ Form::text('middlename',$user->middlename,array('class'=>'form-control','placeholder'=>'Middle Name')) }}
            </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-6'>
                Last Name <br> {{ Form::text('lastname',$user->lastname,array('class'=>'form-control','placeholder'=>'Last Name','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Email <br> {{ Form::text('email',$user->email,array('class'=>'form-control','placeholder'=>'Email','required'=>'required')) }}
            </div>
        </div>

        <div class='form-group'>

            <div class='col-sm-6 col-sm-offset-3'>
                Phone Number<br>{{ Form::text('phone',$user->phone,array('class'=>'form-control','placeholder'=>'Phone Number','required'=>'required')) }}
            </div>


        </div>
        <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Submit',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
        </div>
        <div id="output"></div>
        {{ Form::close() }}
    </div>
</div>
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
            setTimeout(function() {
                $("#modalDialog").modal("hide");
            }, 3000);
            $("#listuser").load("<?php echo url("user/list") ?>")
        }
    });
</script>



@stop