<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>RDLPK</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of FDHL " name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" /><!-- already added -->
    <!-- added -->

    <link href="{{ asset('/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    @yield('css')
    <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <link href="{{ asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components"
        type="text/css" />
    <link href="{{ asset('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components"
        type="text/css" />
    <link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/apps/css/gallary.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('assets/layouts/layout4/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- added -->
    <link href="{{ asset('assets/layouts/layout4/css/themes/default.min.css') }}" rel="stylesheet" type="text/css"
        id="style_color" /> <!-- added -->
    <link href="{{ asset('assets/layouts/layout4/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>

    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('assets/pages/css/index.css') }}">

    <link href=" {{ asset('assets/pages/css/login-3.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" />
</head>
<!-- END HEAD -->

<body class="login">
    <!-- BEGIN PHP CODE -->
    <!-- ENDS PHP CODE -->
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="/admin/home">
            <img src="{{ asset('images/logo.jpg') }}" style="height:100px" alt="Logo" /> </a>
    </div>
    <!-- END LOGO -->

    <!-- BEGIN LOGIN -->

    <div class="content">
        <!-- Custom php code begins here -->
        @include('inc.messages')
        <!--Custom php code ends here -->
        <!-- BEGIN LOGIN FORM -->
        <form class="form-horizontal" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <h3 class="form-title">Admin account</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Please Enter Email and Password </span>
            </div>
            <div>
                <h1>
                </h1>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

                <label for="email" class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input id="email" type="email" class="form-control placeholder-no-fix" placeholder="Enter Email"
                        name="email" value="{{ old('email') }}" required autofocus>
                </div>

                @if ($errors->has('email'))
                <div class="alert alert-danger display-hide">
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                </div>
                @endif
            </div>
            <!-- email modifications end here -->

            <!-- Password Modifications start here -->
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input id="password" type="password" class="form-control placeholder-no-fix" autocomplete="off"
                        placeholder="Enter Password" name="password" required>
                </div>

                @if ($errors->has('password'))
                <div class="alert alert-danger display-hide">
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                </div>
                @endif
            </div>

            <div class="form-actions">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    <span></span>
                </label>
                <button type="submit" id="loginbutton" class="btn btn-md green table-group-action-submit pull-right">
                    Login
                </button>
            </div>
        </form>
    </div>
    <!-- END LOGIN FORM -->

    <!-- END LOGIN -->
    <!--[if lt IE 9]>

<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <!-- added-->
    <script src="{{ asset('/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <!--added -->
    <script src="{{ asset('/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!--added -->
    <script src="{{ asset('/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <!--added -->
    <script src="{{ asset('/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
    <!-- added -->
    <script src="{{ asset('/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <!--added but will be imported ffrom the css folder -->
    <script src="{{ asset('/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js ') }}"
        type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- added this as well  -->
    <script src="{{ asset('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
    <!-- added but same like above this will be added from css folder  -->
    <script src="{{ asset('/assets/global/plugins/select2/js/select2.full.min.js ') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->

    <script src="{{ asset('/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('/assets/pages/scripts/login.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
    $(document).ready(function() {
        $('#clickmewow').click(function() {
            $('#radio1003').attr('checked', 'checked');
        });
    })
    </script>
    <script>
    $("#password").keypress(function(event) {
        if (event.keyCode === 13) {
            $("#loginbutton").click();
        }
    });
    </script>
</body>

</html>