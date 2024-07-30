<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>RDLPK</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page RDLPK" name="description" />
    <meta content="RDLPK" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" /><!-- already added -->
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components"
        type="text/css" />
    <link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/apps/css/gallary.css') }}" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('assets/layouts/layout4/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- added -->
    <link href="{{ asset('assets/layouts/layout4/css/themes/default.min.css') }}" rel="stylesheet" type="text/css"
        id="style_color" /> <!-- added -->
    <link href="{{ asset('assets/layouts/layout4/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{asset('/images/logo.jpg')}}" />
    <link rel="stylesheet" href="{{ asset('assets/pages/css/index.css') }}">
</head>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">

    <div id="contents">
        <!--loader contents starts here -->
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{('/user/home')}}" class="nav-link nav-toggle">
                        <img src="{{ asset('images/logo.jpg') }}" alt="logo" class="dashboardlogo" /> </a>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
                    data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->

                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->

                <!-- BEGIN HEADER SEARCH BOX -->
                <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->

                <!-- END HEADER SEARCH BOX -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu pull-right">
                    <ul class="nav navbar-nav  pull-right">

                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown"
                                data-close-others="true">
                                <span class="username">

                                    User &nbsp;<i class="fa fa-caret-down"> </i> </span>
                                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                <img alt="" class="img-circle" src="uploads/admin.png" /> </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li class="divider"> </li>


                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                        <i class="icon-key"></i> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <!--    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                               <span class="sr-only">Toggle Quick Sidebar</span>
                               <i class="icon-logout"></i>
                           </li> -->
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item start ">
                        <a href="{{('/user/home')}}" class="nav-link nav-toggle">
                            <i class="icon-home"></i>
                            <span class="title">Dashboard</span>

                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('/user/widgets')}}" class="nav-link nav-toggle">
                            <i class="icon-puzzle"></i>
                            <span class="title">Widgets</span>
                        </a>
                    </li>

                    <li class="nav-item  ">
                        <a href="{{url('/user/pages')}}" class="nav-link nav-toggle">
                            <i class="icon-layers"></i>
                            <span class="title">Pages</span>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="{{('#')}}" class="nav-link nav-toggle">
                            <i class="icon-docs"></i>
                            <span class="title">Files</span>
                        </a>
                    </li>

                    <!-- Here we are adding a extra projects section -->
                    <!-- Projects section starts here -->
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-folder"></i>
                            <span class="title">Projects</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="{{url('#')}}" class="nav-link ">
                                    <span class="title">Add New</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('#')}}" class="nav-link ">
                                    <span class="title">Manage Projects</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Projects section ends here  -->



                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-globe"></i>
                            <span class="title">News</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="{{url('#')}}" class="nav-link ">
                                    <span class="title">Add New</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="{{url('#')}}" class="nav-link ">
                                    <span class="title">Manage News</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-calendar"></i>
                            <span class="title">Events</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="{{url('#')}}" class="nav-link ">
                                    <span class="title">Add New</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="{{url('#')}}" class="nav-link ">
                                    <span class="title">Manage Events</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- offices sidebar code ends here -->
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-camera"></i>
                            <span class="title">Videos</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="{{url('#')}}" class="nav-link ">
                                    <span class="title">Add New</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="{{url('#')}}" class="nav-link ">
                                    <span class="title">Manage Videos</span>
                                </a>
                            </li>
                        </ul>
                    </li>



                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->

                    <!-- END PAGE TITLE -->
                    <!-- BEGIN PAGE TOOLBAR -->
                    <div class="page-toolbar">
                        <!-- BEGIN THEME PANEL -->

                        <!-- END THEME PANEL -->
                    </div>
                    <!-- END PAGE TOOLBAR -->
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BREADCRUMB -->
                <!--  <ul class="page-breadcrumb breadcrumb">
                 <li>
                     <a href="home.php">Home</a>
                     <i class="fa fa-circle"></i>
                 </li>
             </ul>  -->
                <!-- END PAGE BREADCRUMB -->
                <!-- BEGIN PAGE BASE CONTENT -->
                <main class="py-4">
                    @yield('content')
                </main>
                <!-- END PAGE BASE CONTENT -->
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->

        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->

    <!-- END FOOTER -->

    </div>
    </div>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script> <!-- added -->
    <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- added -->
    <script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script> <!-- added -->
    <script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script> <!-- added -->
    <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <!-- added -->
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
    <!--added -->
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script> <!-- added -->
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{ asset('assets/layouts/layout4/scripts/layout.min.js') }}" type="text/javascript"></script>
    <!--adding to main page -->
    <script src="{{ asset('assets/layouts/layout4/scripts/demo.min.js') }}" type="text/javascript"></script>
    <!-- adding to main page-->
    <script src="{{ asset('assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>

    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
    $(document).ready(function() {
        $('#clickmewow').click(function() {
            $('#radio1003').attr('checked', 'checked');
        });
    })
    </script>
    <script>
    function changeProfile() {
        $('#image').click();
    }
    $('#image').change(function() {
        var imgPath = $(this)[0].value;
        var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
            readURL(this);
        else
            alert("Please select image file (jpg, jpeg, png).")
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
                $('#remove').val(0);
            }
        }
    }

    function removeImage() {
        $('#preview').attr('src', '{{url('
            images / noimage.jpg ')}}');
        $('#remove').val(1);
    }
    </script>

</body>

</html>