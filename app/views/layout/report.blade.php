<!DOCTYPE html>
@if(Auth::guest())
{{Redirect::to("/")}}
@else
<html>
<head>
    <title>Cervical Cancer Prevention Program</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />

    <link rel="icon" type="image/ico" href="{{ asset('assets/images/favicon.ico') }}" />
    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/animate/animate.css') }}">
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('assets/js/vendor/mmenu/css/jquery.mmenu.all.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/videobackground/css/jquery.videobackground.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-checkbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap/bootstrap-dropdown-multilevel.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/js/vendor/chosen/css/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/chosen/css/chosen-bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/js/vendor/datatables/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/datatables/css/ColVis.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/datatables/css/TableTools.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/tabdrop/css/tabdrop.css') }}">
    <link rel="stylesheet" href="{{ asset('jqueryui/css/cupertino/jquery-ui-1.10.4.custom.min.css') }}">

    <link href="{{ asset('assets/css/minimal.css') }}" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.form.js') }}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('html5shiv.js')}}"></script>
    <script src="{{ asset('respond.min.js')}}"></script>
    <![endif]-->
</head>
<body class="solid-bg-5"  style="margin-top: 50px;margin-bottom: 80px">

<!-- Preloader -->
<div class="mask"><div id="loader"></div></div>
<!--/Preloader -->

<!-- Wrap all page content here -->
<div id="wrap">




<!-- Make page fluid -->
<div class="row">

@include('layout.top')

<!-- Page content -->
<div id="content" class="col-md-12">

    <!-- content main container -->
    <div class="main">




        <!-- row -->
        <div class="row">

            <!-- col 12 -->
            <div class="col-md-12" style="padding-bottom: 50px">
                @yield('contents')
            </div>
            <!-- /col 12 -->
        </div>
        <!-- /row -->

    </div>
    <!-- /content container -->



</div>
<!-- Page content end -->







</div>
<!-- Make page fluid-->




</div>
<!-- Wrap all page content end -->


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('assets/js/vendor/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap/bootstrap-dropdown-multilevel.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/vendor/mmenu/js/jquery.mmenu.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/vendor/sparkline/jquery.sparkline.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/vendor/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/vendor/animate-numbers/jquery.animateNumbers.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/vendor/videobackground/jquery.videobackground.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/vendor/blockui/jquery.blockUI.js') }}"></script>

<!--data tables-->
<script src="{{ asset('assets/js/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables/ColReorderWithResize.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables/colvis/dataTables.colVis.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables/tabletools/ZeroClipboard.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables/tabletools/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables/dataTables.bootstrap.js') }}"></script>

<!--form wizard-->
<script src="{{ asset('assets/js/vendor/tabdrop/bootstrap-tabdrop.min.js') }}""></script>
<script src="{{ asset('assets/js/vendor/chosen/chosen.jquery.min.js') }}""></script>
<script src="{{ asset('assets/js/vendor/parsley/parsley.min.js') }}""></script>
<script src="{{ asset('assets/js/vendor/wizard/jquery.bootstrap.wizard.min.js') }}""></script>
<script src="{{ asset('assets/js/minimal.min.js') }}"></script>
<script src="{{ asset('jqueryui/js/jquery-ui-1.10.4.custom.js') }}"></script>
{{ HTML::script("Highcharts/js/highcharts.js") }}
{{ HTML::script("Highcharts/js/modules/exporting.js") }}
{{ HTML::script("Highcharts/js/themes/gray.js") }}

    <script>
    $(function(){
        setInterval(function(){
            $.post("<?php echo asset('sendsms.php') ?>",function(data){
            });
        }, 301000)
    })
</script>
</body>
</html>
@endif