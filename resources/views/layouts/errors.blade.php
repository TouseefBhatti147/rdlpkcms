<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="@yield('description')">
<meta name="keywords" content="@yield('keywords')">
<meta name="msapplication-TileImage" content="{{asset('/images/logo5.gif')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/images/logo5.gif')}}">
<link rel="icon" type="image/gif" href="{{asset('/images/logo5.gif')}}" sizes="32x32">
<title>Future Developments Holdings | @yield('title')</title>
<!-- copy element {{asset('')}} -->
<link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{asset('assets/global/css/animate.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/assets/fontawsome/css/fontawesome.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{asset('/assets/fontawsome/css/fontawesome.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/assets/fontawsome/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/assets/fontawsome/css/all.min.css')}}" rel="stylesheet" type="text/css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="shortcut icon" href="{{asset('/images/logo5.gif')}}" />
<link href="{{asset('assets/pages/css/error.min.css')}}" rel="stylesheet" type="text/css" />
@yield('css')
<!-- Scripts -->
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="loader">  <!-- loader div starts here -->
<img id="logoloader" alt="logoloader" src="{{ asset('images/logo5.gif') }}">
<img id="loadersvg" alt="Loader" src="{{ asset('images/loader.svg') }}">
</div> <!-- loader div ends here -->
<div id="contents"> <!--loader contents starts here -->
<!-- Introduction div starts from here-->
<div class="pagewide p-3 fixed-top">
<div class="container">
<div class="row">
<div class="col-12 d-flex justify-content-start col-sm-12 justify-content-sm-start col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start topbarcolumn1">
<ul>
<li class="too-topbar-contact"><i class="fa fa-phone"></i>  Toll Free: 0800 SMART (76278) &nbsp;&nbsp;&nbsp;</li>
<li class="topbar-contact"><i class="fa fa-phone"></i> UAN: 111-444-475 &nbsp;&nbsp; </li>
<li class="topbar-contact"><i class="fa fa-envelope"></i> sales@fdhlpk.com &nbsp;&nbsp;</li>
</ul>
<!--    <li><span>&nbsp;</span></li> -->
 <!--    <li><i class="fa fa-phone"></i><span>UAN : +92 51 111 444 475</span></li> -->
 </div>
<div class="col-12 d-flex justify-content-start col-sm-12 justify-content-sm-start col-md-4 justify-content-md-end col-lg-4 justify-content-lg-end topbarcolumn2">
<ul class="social-media-list">
<li><a href="https://www.facebook.com/fdhlpk"><img src="{{asset('/images/facebook.png')}}" alt="Facebook" title="Facebook"></a></li>
<li> <a href=""><img src="{{asset('/images/instagram.png')}}" alt="Instagram" title="Instagram"></a></li>
<li><a href="https://twitter.com/fdhdevelopments"><img src="{{asset('/images/twitter.png')}}" alt="Twitter" title="Twitter"></a></li>
<li><a href="#"><img src="{{asset('/images/youtube.png')}}" alt="YouTube" title="YouTube"></a></li>
</ul>
</div>
</div>
</div>
</div>

<!-- Introduction div end here-->
<!-- Navigation bar code starts here  -->
<!-- Navigation bar code starts here  -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="197" id="topnavbar">
<div class="container">
<a class="navbar-brand" href="{{url('/index')}}"><img src="{{asset('/images/logo.png')}}" class="img-responsive logo"></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span> </button>
<div class="collapse navbar-collapse" id="navbarResponsive">
<ul class="navbar-nav ml-auto">
<li class="nav-item active">  <a class="nav-link text-dark" id="home" href="{{url('/index')}}">&nbsp;Home  <span class="sr-only">(current)</span> </a>  </li>
<li class="nav-item"><a class="nav-link text-dark" href="{{url('/about-us')}}">&nbsp;About Us</a>  </li>
<!--    <li class="nav-item dropdown">
<button class="dropbtn">Services</button>
<div class="dropdown-content">
<a href="#">---</a>
<div class="dropdown-divider"></div>
<a  href="#">---</a> <div class="dropdown-divider"></div>
<a class="nav-link text-dark"  href="#">---</a>
</div>
</li> -->
<li class="nav-item dropdown"> <button class="dropbtn">Projects</button> <div class="dropdown-content">
<a href="{{url('/current-projects')}}">Current</a>
<div class="dropdown-divider"></div>
<a href="{{url('/upcoming-projects')}}">Upcoming</a> </div>
</li>

<li class="nav-item dropdown"> <button class="dropbtn">Media</button>  <div class="dropdown-content">
<a href="{{url('/news')}}">News</a> <div class="dropdown-divider"></div>
<a href="{{url('/events')}}">Events</a>
<!--   <div class="dropdown-divider"></div>
<a href="#">Press Release</a> -->
<div class="dropdown-divider"></div>
<a href="{{url('/videos')}}">Videos</a>
</div>
</li>
<li class="nav-item"><a class="nav-link text-dark" href="{{url('/contact-us')}}">&nbsp;Contact Us</a></li>
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
<div class="col-12 col-sm-12 col-md-6 col-lg-4  footer-address">
 <div class="footer-title"> <h1>International Office</h1> </div>
<div class="line-yellow"></div>
{{--Starford office is being commented for now --}}  
{{--   <div class="footer-content">
<div class="text-warning"> <strong>
Stratford Office - UK
</strong></div>
<em class="fa fa-map-marker"> </em> <div class="element" >
Silver Square Plaza, Plot # 15, Street # 73, Mehr Ali Road, F-11 Markaz, Islamabad.
 </div>
<em class="fa fa-phone"> </em><div class="element">
+44 20 3150 0550
</div>
<em class="fa fa-phone"> </em>   <div class="element">
Toll Free: 0800 1700 550
</div>
<em class="fa fa-envelope"> </em>   <div class="element">
sales.uk@smartcitypk.com
</div>
</div>
<hr> --}}
{{--Starford office is being commented for now --}}  
<div class="footer-content">
<div class="text-warning"> <strong> Ilford Office - UK  </strong></div>
<em class="fa fa-map-marker"> </em>   <div class="element" >   2nd Floor, 112 High Road, Ilford IG1 1BY London, United Kingdom</div>
<em class="fa fa-phone"> </em><div class="element"> +44 20 3903 4751, 4752 & 4753  </div>
<em class="fa fa-phone"> </em>  <div class="element"> +44 7881 388270 </div>
<em class="fa fa-phone"> </em> <div class="element"> +44 7881 388280</div>
<em class="fa fa-envelope"> </em><div class="element"> sales.uk@smartcitypk.com </div>
<em class="fa fa-envelope"> </em><div class="element">sales.uk@fdhlpk.com </div>
</div>
</div>
<!-- Footer column 1 ends here -->
<!-- Footer column 2 starts here -->
<div class="col-12  col-sm-12 col-md-6  col-lg-4   footer-address">
 <div class="footer-title"><h1>  HEAD OFFICE </h1> </div>
<div class="line-yellow"></div>

<div class="footer-content"> 
<em class="fa fa-map-marker"> </em> <div class="element" >  Silver Square Plaza, Plot # 15, Street # 73, Mehr Ali Road, F-11 Markaz, Islamabad.</div>
<em class="fa fa-phone"> </em><div class="element">00800-SMART (76278) </div>
<em class="fa fa-phone"> </em>   <div class="element"> UAN : +92 51 111 444 475 </div>
<em class="fa fa-phone"> </em>   <div class="element">  Tel :+92 51 2224301 - 04 </div>
</div>
<hr>
<div class="footer-title"> <h1>   CORPORATE OFFICE  </h1></div>
<div class="line-yellow"></div>
<div class="footer-content">
<em class="fa fa-map-marker"> </em><div class="element">   24 A. XX Commercial, Khiaban-e-Iqbal,DHA Phase III, Lahore. </div>
<em class="fa fa-phone"> </em> <div class="element">   UAN: +92 42 111 444 475</div>
</div>
</div>
 <!-- Footer column 2 ends here -->
<!-- Footer column 3 starts here -->
<div class="col-12 col-sm-12 col-md-6  col-lg-4  footer-address">
<div class="footer-title">  <h1>Sales &amp; Marketing Office</h1> </div>
<div class="line-yellow"></div> <div class="footer-content">
<div class="text-warning"> <strong>  Islamabad Office </strong></div>
<em class="fa fa-map-marker"> </em>  <div class="element">  Plaza #11, Jinnah Boulevard (East) Sector-A Near Gate #1, DHA Phase II, G.T.Road, Islamabad </div>
<em class="fa fa-phone"> </em><div class="element"> Tel: +92 51 5419180,81,82 </div>
<em class="fa fa-phone"> </em><div class="element">  Toll Free: 0800 SMART (76278) </div>
<em class="fa fa-phone"> </em><div class="element">  UAN: +92 51 111 444 475</div>
<em class="fa fa-fax"> </em>  <div class="element">   Fax: +92 51 5419183  </div>
<em class="fa fa-envelope"> </em><div class="element"> sales@smartcitypk.com  </div>
<hr>
<div class="footer-content">
<div class="text-warning"> <strong>  Multan Office  </strong></div>
<em class="fa fa-map-marker"> </em>    <div class="element">  Gate # 1, Multan Public School Road, Multan </div>
<em class="fa fa-phone"> </em>  <div class="element">  Tel: +92 61 6740201 - 8  </div>
<em class="fa fa-phone"> </em>  <div class="element">  UAN: +92 61 111 444 475   </div>

</div>
</div>
</div>
<!-- Footer column 3 ends here -->
</div>
</div>
</div>
<!--Footer ends here-->

<!-- Copy right div starts Here-->
<div class="copyright">
<div class="container">
<div class="row">
<div class="col-12 d-flex text-justify-center justify-content-center col-sm-12 justify-content-sm-center col-md-7 justify-content-md-start col-lg-7 justify-content-lg-start copyrightcol">
<p>Copyright 2019 © All rights reserved by FDH Technologies.
</p>
</div>
</div>
</div>
</div>
<!-- Copy right div ends here-->

</div>
<script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script><!--added -->
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js ') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js ') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/login.min.js')}}" type="text/javascript"></script>
<script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
    //$('#loading-background').fadeOut(1000);
$('#loader').fadeOut(1000);
});
/*document.onreadystatechange = function () {
var state = document.readyState
if (state == 'interactive') {
// document.getElementById('contents').style.visibility="hidden";
} else if (state == 'complete') {
setTimeout(function(){
document.getElementById('interactive');
document.getElementById('loader').style.visibility="hidden";
document.getElementById('contents').style.visibility="visible";
},1000);
}
}
*/
</script>
<script src="{{asset('assets/bootstrap/js/bootstrap.js')}}" type="text/javascript"></script> <!-- added -->
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script> <!-- added -->
<script src="{{asset('/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script> <!-- added -->
</body>
</html>
