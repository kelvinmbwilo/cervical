
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top navbar-transparent-black mm-fixed-top" role="navigation" id="navbar">

<div class="row">
    <div class="col-md-2 visible-lg visible-md hidden-sm hidden-xs" >
        <img src="{{ asset('nembo.gif') }}" style="height: 50px; width: 50px">
    </div>
    <div class="col-md-8">
        <h4 class="text-center visible-lg hidden-md hidden-sm">UNITED REPUBLIC OF TANZANIA - MINISTRY OF HEALTH AND SOCIAL WELFARE</h4>
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
    <ul class="nav navbar-nav refresh hidden-sm hidden-md hidden-xs">
        <li class="divided">
            <a href="#" class="page-refresh"><i class="fa fa-refresh" style="color: rgba(0, 0, 0, 0.6);"></i></a>
        </li>
    </ul>
    <!-- /Page refresh -->


    <!-- Quick Actions -->
    <ul class="nav navbar-nav quick-actions">


        <li class="dropdown divided">

            @include('layout.notification')

    </ul>

    </li>

    <li class="dropdown divided user" id="current-user">
        <div class="profile-photo">
            <!--        <img src="{{ asset('assets/images/user.jpg') }}" style="height: 45px" />-->
        </div>
        <a class="dropdown-toggle options" data-toggle="dropdown" href="#">
            <i class="fa fa-user-md"></i> <b>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </b> <i class="fa fa-caret-down"></i>
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
                        <li><a href="{{ url('report/saved') }}"><i class="fa fa-caret-right"></i> View Saved Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('reminders') }}">
                        <i class="fa fa-envelope"></i> Reminders
                    </a>
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
                <li>
                    <a href="{{ url('sysnc') }}">
                        <i class="fa fa-recycle"></i> Data Synchronise
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

