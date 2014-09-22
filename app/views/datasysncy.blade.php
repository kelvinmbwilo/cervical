@extends("layout.master")


@section('title')
Sending Data To Server
@stop


@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">data Synchronisation</li>

@stop

@section('contents')
<div class="row">

  <h3>This feature allows you to send data to the central Database</h3>
    <h4>You have {{ count(Visit::where('server_status','not')->get()) }} visit(s) to send</h4>
    <div class="alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4>There is no Internet connection</h4>
        <p>Please try to connect before you start to transfer data</p>

    </div>
    <div class="alert alert-success fade in" role="alert">
<!--        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>-->
        <h4>There is Internet connection</h4>
        <p>You can begin the transfer of data by clicking the "start transfer" button</p>
        <p>
            <button id="uploadbuton" type="button" class="btn btn-success">Start Transfer</button>
        </p>
    </div>
    <div id="output"></div>
    <div id="waiting"></div>
    <div class="progress">
        <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="10" aria-valuemin="100" aria-valuemax="100" style="width: 100%">
            <span class="sr-only">100% Complete</span>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(function(){
            setInterval(function(){
                var online = navigator.onLine;
                if(online){
                    $(".alert-danger").hide();
                    $(".alert-success").show('slow')
                }else{
                    $(".alert-success").hide();
                    $(".alert-danger").show('slow')
                }
            },1000)
        })

            $("#uploadbuton").click(function(){
                $("#waiting").html("<i class='fa fa-spin fa-spinner'></i> Transfering.....")
                $.ajax({
                    method: 'GET',
                    url: '<?php echo url('synchronize') ?>',
                    success: function(data) {
                        if(data == "<h4 class=text-danger>All Visits has been transferred</h4>"){
                            $("#output").append(data);
                            $("#waiting").html("");
                        }else{
                            $("#output").append(data)
                            $("#uploadbuton").trigger('click');
                        }

                    },
                    error: function() {
                        $("#waiting").html("Failed Try Again");
                    }
                });
            })



    })
</script>
@stop