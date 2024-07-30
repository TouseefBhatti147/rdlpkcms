<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="msapplication-TileImage" content="{{asset('/images/logo.gif')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/images/logo.gif')}}">
    <link rel="icon" type="image/gif" href="{{asset('/images/logo.gif')}}" sizes="32x32">
    <title>Royal Developers & Builders (Pvt) Limited | @yield('title')</title>
    <!-- copy element {{asset('')}} -->

    <link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components"
        type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('assets/global/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/fontawsome/css/fontawesome.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('/assets/fontawsome/css/fontawesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/fontawsome/css/all.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/fontawsome/css/all.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" />
    <link href="{{asset('assets/pages/css/error.min.css')}}" rel="stylesheet" type="text/css" />
    @yield('css')
    <style>
    .member-portal-heading {
        color: white !important;
        font-size: 14px !important;
        line-height: -1.7em !important;
    }

    body {
        font-family: 'Roboto', sans-serif;
    }

    .pagewide {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e7e7e7;
    }

    .topbar-contact {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .topbar-contact li {
        display: inline;
        margin-right: 20px;
    }

    .topbar-contact i {
        margin-right: 5px;
    }

    #div_for_social_media_icons ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #list_social_media_icons li {
        display: inline;
        margin-right: 10px;
    }

    /* Include the CSS provided here if not using an external stylesheet */
    .pagewide {
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
        z-index: 1030;
    }

    .topbarcolumn1 ul,
    .topbarcolumn2 ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .topbarcolumn1 ul li,
    .topbarcolumn2 ul li {
        display: inline;
        margin-right: 20px;
        font-size: 14px;
        color: #ffff;
    }

    .topbarcolumn1 ul li i,
    .topbarcolumn2 ul li i {
        margin-right: 5px;
        color: #007bff;
    }

    .portal-login {
        display: inline;
        font-size: 14px;
        color: #007bff;
        vertical-align: middle;
        line-height: normal;
    }

    .a_top_hypers img {
        vertical-align: middle;
        margin-right: 5px;
    }

    #list_social_media_icons li {
        display: inline;
        margin-right: 10px;
    }

    #list_social_media_icons li img {
        width: 20px;
        height: 20px;
    }

    @media (max-width: 767.98px) {

        .topbarcolumn1,
        .topbarcolumn2 {
            justify-content: center !important;
        }
    }
    </style>
    <!-- Scripts -->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="loader">
        <!-- loader div starts here -->
        <img id="logoloader" alt="logoloader" src="{{ asset('images/logo.jpg') }}">
        <img id="loadersvg" alt="Loader" src="{{ asset('images/loader.svg') }}">
    </div> <!-- loader div ends here -->
    <div id="contents">
        <!--loader contents starts here -->
        <!-- Introduction div starts from here-->
        <div class="pagewide p-3 fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 d-flex justify-content-start topbarcolumn1">
                        <ul>
                            @if(isset($settings['toll-free-number']) && $settings['toll-free-number']['status'] == 1)
                            <li class="too-topbar-contact"><i class="fa fa-phone"></i>
                                {{ $settings['toll-free-number']['value'] }}
                                &nbsp;&nbsp;&nbsp;</li>
                            @endif

                            @if(isset($settings['uan-number']) && $settings['uan-number']['status'] == 1)
                            <li class="topbar-contact"><i class="fa fa-phone"></i>
                                {{ $settings['uan-number']['value'] }}
                                &nbsp;&nbsp; </li>
                            @endif

                            @if(isset($settings['email']) && $settings['email']['status'] == 1)
                            <li class="topbar-contact"><i class="fa fa-envelope"></i>
                                {{ $settings['email']['value'] }}
                                &nbsp;&nbsp;</li>
                            @endif
                        </ul>
                    </div>
                    <div
                        class="col-12 col-sm-12 col-md-4 col-lg-4 d-flex justify-content-start justify-content-md-end topbarcolumn2">
                        <div id="div_for_social_media_icons">
                            <ul id="list_social_media_icons">
                                @if(isset($settings['member-portal-link']) && $settings['member-portal-link']['status']
                                == 1)
                                <li><a href="{{ $settings['member-portal-link']['value'] }}" target="_blank"
                                        class="a_top_hypers">
                                        <img src="{{ asset('/images/user-profile.png') }}" alt="Member portal Login"
                                            title="Member portal Login">
                                        <h1 class="portal-login"> &nbsp;Member Portal Login&nbsp; </h1>
                                    </a>
                                </li>
                                @endif

                                @if(isset($settings['facebook-link']) && $settings['facebook-link']['status'] == 1)
                                <li><a href="{{ $settings['facebook-link']['value'] }}" target="_blank">
                                        <img src="{{ asset('/images/facebook.png') }}" alt="Facebook" title="Facebook">
                                    </a>
                                </li>
                                @endif

                                @if(isset($settings['instagram-link']) && $settings['instagram-link']['status'] == 1)
                                <li><a href="{{ $settings['instagram-link']['value'] }}" target="_blank">
                                        <img src="{{ asset('/images/instagram.png') }}" alt="Instagram"
                                            title="Instagram">
                                    </a>
                                </li>
                                @endif

                                @if(isset($settings['twitter-link']) && $settings['twitter-link']['status'] == 1)
                                <li><a href="{{ $settings['twitter-link']['value'] }}" target="_blank">
                                        <img src="{{ asset('/images/twitter.png') }}" alt="Twitter" title="Twitter">
                                    </a>
                                </li>
                                @endif

                                @if(isset($settings['youtube-link']) && $settings['youtube-link']['status'] == 1)
                                <li><a href="{{ $settings['youtube-link']['value'] }}" target="_blank">
                                        <img src="{{ asset('/images/youtube.png') }}" alt="YouTube" title="YouTube">
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Introduction div end here-->
        <!-- Navigation bar code starts here -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="197"
            id="topnavbar">
            <div class="container">
                @if(isset($files['fdhl-logo']) && $files['fdhl-logo']['status'] == 1)
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('/uploads/' . $files['fdhl-logo']['image']) }}" class="img-responsive logo">
                </a>
                @endif

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-dark" id="home" href="{{ url('/') }}">&nbsp;Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ url('/about-us') }}">&nbsp;About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ url('/our-group') }}">&nbsp;Our Group</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#iso-certificates">
                                <button class="dropbtn">ISO Certificates</button>
                            </a>
                            <div class="dropdown-content">
                                <a href="{{ url('/iso-certificates/tuv-austria') }}">TUV Austria</a>
                                <a href="{{ url('/iso-certificates/reliable-certification') }}">Reliable
                                    Certification</a>
                                <a href="{{ url('/iso-certificates/pgbc-patrons-club') }}">PGBC - Patron's Club</a>
                                <a href="{{ url('/iso-certificates/world-green-building-council') }}">World Green
                                    Building Council</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#projects">
                                <button class="dropbtn" id="projects">Projects</button>
                            </a>
                            <div class="dropdown-content">
                                <a href="{{ url('/current-projects') }}">Current</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('/upcoming-projects') }}">Upcoming</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#media">
                                <button class="dropbtn" id="media">Media</button>
                            </a>
                            <div class="dropdown-content">
                                <a href="{{ url('/news') }}">News</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('/events') }}">Events</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('/videos') }}">Videos</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('/newsletters') }}">Newsletters</a>
                            </div>
                        </li>
                        <li classclass="nav-item"><a class="nav-link text-dark"
                                href="{{ url('/contact-us') }}">&nbsp;Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navigation bar code ends here -->




        @yield('content')


        <!-- Footer starts here -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!-- Footer column 1 starts here -->
                    @foreach($officess as $office)
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 footer-address">
                        <div class="footer-title">
                            @if(isset($office->office_title))
                            <h1>{{ $office->office_title }}</h1>
                            @endif
                        </div>
                        <div class="line-yellow"></div>
                        {{-- footer content starts here --}}
                        <div class="footer-content">
                            @if(isset($office->city))
                            <div class="text-warning">
                                <strong>{{ $office->city }}</strong>
                            </div>
                            @endif
                            @if(isset($office->address))
                            <em class="fa fa-map-marker"></em>
                            <div class="element">{{ $office->address }}</div>
                            @endif
                            @if(isset($office->telephone_1))
                            <em class="fa fa-phone"></em>
                            <div class="element">{{ $office->telephone_1 }}</div>
                            @endif
                            @if(isset($office->telephone_2))
                            <em class="fa fa-phone"></em>
                            <div class="element">{{ $office->telephone_2 }}</div>
                            @endif
                            @if(isset($office->telephone_3))
                            <em class="fa fa-phone"></em>
                            <div class="element">{{ $office->telephone_3 }}</div>
                            @endif
                            @if(isset($office->telephone_4))
                            <em class="fa fa-phone"></em>
                            <div class="element">{{ $office->telephone_4 }}</div>
                            @endif
                            @if(isset($office->email_1))
                            <em class="fa fa-envelope"></em>
                            <div class="element">{{ $office->email_1 }}</div>
                            @endif
                            @if(isset($office->email_2))
                            <em class="fa fa-envelope"></em>
                            <div class="element">{{ $office->email_2 }}</div>
                            @endif
                            @if(isset($office->uan_number))
                            <em class="fa fa-phone"></em>
                            <div class="element">{{ $office->uan_number }}</div>
                            @endif
                            @if(isset($office->fax_number))
                            <em class="fa fa-fax"></em>
                            <div class="element">{{ $office->fax_number }}</div>
                            @endif
                        </div>
                        {{-- footer content ends here --}}
                    </div>
                    @endforeach

                    <!-- Footer column 1 ends here -->

                    <!-- Footer column 3 ends here -->
                </div>
            </div>
        </div>
        <!--Footer ends here-->



        <!-- Copy right div starts Here-->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div
                        class="col-12 d-flex text-justify-center justify-content-center col-sm-12 justify-content-sm-center col-md-7 justify-content-md-start col-lg-7 justify-content-lg-start copyrightcol">
                        <p> @if(isset($settings['copy-right']))
                            @if($settings['copy-right']['status']==1)
                            {{$settings['copy-right']['value']}}
                            @else
                            @endif
                            @endif
                        </p>
                    </div>
                    <div
                        class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-5 justify-content-md-start col-lg-5 justify-content-lg-start  web-menu-div">
                        <ul id="web-menu">
                            @if(isset($pages['privacy-policy']))
                            @if($pages['privacy-policy']['status']==1)
                            <li><u><a class="web-menu-element" href="@if($pages['terms-of-service']['status']==1)
                {{url('/pages/'.$pages['terms-of-service']['alias'])}}
                @else
                  #
               @endif">Terms of Service</a></u> |</li>
                            @endif
                            @endif
                            @if(isset($pages['privacy-policy']))
                            @if($pages['privacy-policy']['status']==1)
                            <li><u><a class="web-menu-element" href="@if($pages['privacy-policy']['status']==1)
                {{url('/pages/'.$pages['privacy-policy']['alias'])}}
                 @else
                   #
                @endif
               ">Privacy Policy</a></u> |</li>
                            @else
                            @endif
                            @endif
                            @if(isset($pages['site-map']))
                            @if($pages['site-map']['status']==1)
                            <li><u><a class="web-menu-element" href="@if($pages['site-map']['status']==1)
                  {{url('/pages/'.$pages['site-map']['alias'])}}
                  @else
                  #
                  @endif"> Site Map</a></u></li>
                            @else
                            @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>




        <!-- Copy right div ends here-->
    </div>
    <!--loader contents ends here -->

    {{--<script src="{{asset('/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script> <!-- added -->
    --}}
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"> </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>