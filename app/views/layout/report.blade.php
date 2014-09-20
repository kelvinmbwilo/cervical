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





<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top navbar-transparent-black mm-fixed-top" role="navigation" id="navbar">

<div class="row">
    <div class="col-md-2 visible-lg visible-md hidden-sm hidden-xs" >
        <img src="{{ asset('nembo.gif') }}" style="height: 50px; width: 50px">
    </div>
    <div class="col-md-8">
        <h4 class="text-center">UNITED REPUBLIC OF TANZANIA - MINISTRY OF HEALTH AND SOCIAL WELFARE</h4>
        <h4 class="text-center"style="margin-bottom: 0px;margin-top: 5px"><small style="color: #000000">
                MBEYA REFERRAL HOSPITAL CERVICAL CANCER PREVENTION PROGRAM (CECAP)</small></h4>
    </div>
    <div class="col-md-2 visible-lg visible-md hidden-sm hidden-xs">
        <img src="{{ asset('tz_flag.jpg') }}" style="height: 50px; width: 50px" class="pull-right">
    </div>
</div>

<!-- Branding -->
<div class="navbar-header col-md-2">
    <a class="navbar-brand" href="index.html">
        <strong>CECAP</strong>
    </a>
    <div class="sidebar-collapse">
        <a href="#">
            <i class="fa fa-bars" style="color: rgba(0, 0, 0, 0.6);"></i>
        </a>
    </div>
</div>
<!-- Branding end -->


<!-- .nav-collapse -->
<div class="navbar-collapse">

<!-- Page refresh -->
<ul class="nav navbar-nav refresh">
    <li class="divided">
        <a href="#" class="page-refresh"><i class="fa fa-refresh" style="color: rgba(0, 0, 0, 0.6);"></i></a>
    </li>
</ul>
<!-- /Page refresh -->

<!-- Quick Actions -->
<ul class="nav navbar-nav quick-actions">


    <!--<li class="dropdown divided">-->
    <!---->
    <!--    <a class="dropdown-toggle button" data-toggle="dropdown" href="#">-->
    <!--        <i class="fa fa-bell"></i>-->
    <!--        <span class="label label-transparent-black">3</span>-->
    <!--    </a>-->
    <!---->
    <!--    <ul class="dropdown-menu wide arrow nopadding bordered">-->
    <!--        <li><h1>You have <strong>3</strong> new notifications</h1></li>-->
    <!---->
    <!--        <li>-->
    <!--            <a href="#">-->
    <!--                <span class="label label-green"><i class="fa fa-user"></i></span>-->
    <!--                New user registered.-->
    <!--                <span class="small">18 mins</span>-->
    <!--            </a>-->
    <!--        </li>-->
    <!---->
    <!--        <li>-->
    <!--            <a href="#">-->
    <!--                <span class="label label-red"><i class="fa fa-power-off"></i></span>-->
    <!--                Server down.-->
    <!--                <span class="small">27 mins</span>-->
    <!--            </a>-->
    <!--        </li>-->
    <!---->
    <!--       -->
    <!---->
    <!--    </ul>-->
    <!---->
    <!--</li>-->

    <li class="dropdown divided user" id="current-user">
        <div class="profile-photo">
            <!--        <img src="{{ asset('assets/images/user.jpg') }}" style="height: 45px" />-->
        </div>
        <a class="dropdown-toggle options" data-toggle="dropdown" href="#">
            <b>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </b> <i class="fa fa-caret-down"></i>
        </a>

        <ul class="dropdown-menu arrow settings">

            <li>

                <h3>Backgrounds:</h3>
                <ul id="color-schemes">
                    <li><a href="#" class="bg-1"></a></li>
                    <li><a href="#" class="bg-2"></a></li>
                    <li><a href="#" class="bg-3"></a></li>
                    <li><a href="#" class="bg-4"></a></li>
                    <li><a href="#" class="bg-5"></a></li>
                    <li><a href="#" class="bg-6"></a></li>
                    <li class="title">Solid Backgrounds:</li>
                    <li><a href="#" class="solid-bg-1"></a></li>
                    <li><a href="#" class="solid-bg-2"></a></li>
                    <li><a href="#" class="solid-bg-3"></a></li>
                    <li><a href="#" class="solid-bg-4"></a></li>
                    <li><a href="#" class="solid-bg-5"></a></li>
                    <li><a href="#" class="solid-bg-6"></a></li>
                </ul>
            </li>
    </li>


    <li class="divider"></li>

    <li>
        <a href="{{ url('user/profile') }}"><i class="fa fa-user"></i> Profile</a>
    </li>



    <li class="divider"></li>

    <li>
        <a href="{{ url('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
    </li>
</ul>
</li>

</ul>
<!-- /Quick Actions -->



<!-- Sidebar -->
<ul class="nav navbar-nav side-nav" id="sidebar">

    <li class="collapsed-content">
        <ul>
            <li class="search"><!-- Collapsed search pasting here at 768px --></li>
        </ul>
    </li>

    <li class="navigation" id="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="#navigation">Navigation <i class="fa fa-angle-up"></i></a>

        <ul class="menu">

            <li>
                <a href="{{ url('home') }}">
                    <i class="fa fa-tachometer"></i> Dashboard
                </a>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user-md"></i> Patients <b class="fa fa-plus dropdown-plus"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ url('patient/register') }}">
                            <i class="fa fa-caret-right"></i> New Registration
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('patients') }}">
                            <i class="fa fa-caret-right"></i> Follow Up
                        </a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bar-chart"></i> Reports <b class="fa fa-plus dropdown-plus"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('reports') }}"><i class="fa fa-caret-right"></i> General Report</a></li>
                    <li><a href="{{ url('recordsreports') }}"><i class="fa fa-caret-right"></i> Records Report</a></li>
                    <li><a href="{{ url('reports/contraceptive') }}"><i class="fa fa-caret-right"></i> Contraceptive History</a></li>
                    <li><a href="{{ url('reports/hiv_status') }}"><i class="fa fa-caret-right"></i> HIV Status</a></li>
                    <li><a href="{{ url('reports/colposcopy') }}"><i class="fa fa-caret-right"></i> Colposcopy</a></li>
                    <li><a href="{{ url('reports/pap_smear') }}"><i class="fa fa-caret-right"></i> Pap Smear</a></li>
                    <li><a href="{{ url('reports/via') }}"><i class="fa fa-caret-right"></i> VIA</a></li>
                    <li><a href="#"><i class="fa fa-caret-right"></i> View Saved Reports</a></li>
                </ul>
            </li>

            @if(Auth::user()->role == "admin")
            <li>
                <a href="{{ url('facilities') }}">
                    <i class="fa fa-building"></i> Facilities
                </a>
            </li>
            <li>
                <a href="{{ url('users') }}">
                    <i class="fa fa-user"></i> Users
                </a>
            </li>
            @endif



        </ul>

    </li>

    <li class="summary" id="order-summary">
        <a href="#" class="sidebar-toggle underline" data-toggle="#order-summary">Patient Summary <i class="fa fa-angle-up"></i></a>

        <div class="media">

            <div class="media-body">
                Registered Patients
                <h3 class="media-heading">{{ Patient::all()->count() }}</h3>
            </div>
        </div>

        <div class="media">

            <div class="media-body">
                Total Visits
                <h3 class="media-heading">{{ Visit::all()->count() }} </h3>
            </div>
        </div>

    </li>


</ul>
<!-- Sidebar end -->





</div>
<!--/.nav-collapse -->





</div>
<!-- Fixed navbar end -->






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

    })

</script>
</body>
</html>
@endif