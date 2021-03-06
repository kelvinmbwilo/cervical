<!DOCTYPE html>
<html>
<head>
    <title>Cervical Cancer Prevention Program</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />

    <link rel="icon" type="image/ico" href="{{ asset('assets/images/favicon.ico') }}" />
    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-checkbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap/bootstrap-dropdown-multilevel.css') }}">

    <link href="{{ asset('assets/css/minimal.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="solid-bg-5">
<!-- Wrap all page content here -->
<div id="wrap">
    <!-- Make page fluid -->
    <div class="row">
        <!-- Page content -->
        <div id="content" class="col-md-12 full-page login">


            <div class="inside-block" style="padding-top: 13%">
                <h4>Cervical Cancer Prevention Program</h4>
                <h2> CECAP</h2>
                @if(isset($error))
                <div class="alert alert-danger alert-dismissable" style="padding: 5px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{ $error }}!</strong>
                </div>
                @endif
                <form method="post" id="form-signin" class="form-signin" action="{{ url('login') }}">
                    <section>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" placeholder="Username">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-addon"><i class="fa fa-key"></i></div>
                        </div>
                    </section>
                    <section class="controls">
                        <div class="checkbox check-transparent">
                            <input name="keep" type="checkbox" value="cheked" id="remember" checked>
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="{{ url('password/remind/') }}">Forget password?</a>
                    </section>
                    <section class="log-in">
                        <button class="btn btn-greensea">Log In</button>
                    </section>
                </form>
            </div>


        </div>
        <!-- /Page content -->
    </div>
</div>
<!-- Wrap all page content end -->
</body>
</html>
      