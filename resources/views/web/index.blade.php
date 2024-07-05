@extends('layouts.fdhl')

@section('title')
@if(isset($widgets['about-uswidget']) && $widgets['about-uswidget']['status'] == 1)
{{$widgets['about-uswidget']['meta_title']}}
@endif
@endsection

@section('description')
@if(isset($widgets['about-uswidget']) && $widgets['about-uswidget']['status'] == 1)
{{$widgets['about-uswidget']['meta_description']}}
@endif
@endsection

@section('keywords')
@if(isset($widgets['about-uswidget']) && $widgets['about-uswidget']['status'] == 1)
{{$widgets['about-uswidget']['meta_keywords']}}
@endif
@endsection

@section('css')
@if(!isset($widgets['about-uswidget']))
<!-- Handle the case when 'about-uswidget' is not set -->
@endif
@endsection

<style>
#mb_parallax {
    background-image: url('{{ asset('/images/wp.jpg')}}');
    opacity: 1;
    filter: alpha(opacity=50);
}
</style>
<link href="{{asset('assets/global/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css" />
@section('content')
@include('inc.slider')
<!-- Header html starts here -->
<div class="jumbotron">
    <div class="container">
        <div class="row row-headers">
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-7 justify-content-md-start col-lg-8 justify-content-lg-start ">
                <h1><br>Everything is designed, few things are designed better</h1>
            </div>
            <div
                class="col-12  d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-5 justify-content-md-start col-lg-4 justify-content-lg-start">
                <span target="_blank" href="https://fdhlpk.com/"
                    class="btn btn-sm c-btn-blue c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">
                    <table>

                        <tr>
                            <td><strong class="top-element1"> Brochure&nbsp; </strong></td>

                            <td><a href="@if(isset($files['brochure']))@if($files['brochure']['status']==1){{asset('/uploads/'.$files['brochure']['image'])}}@else @endif @endif"
                                    class="btn btn-primary btn-xs  tooltips" data-original-title="" title="" download><i
                                        class="fas fa-download c-font-bold"></i></a></td>
                            <td><a href="@if(isset($files['brochure']))@if($files['brochure']['status']==1){{url('/brochure')}}@else @endif @endif"
                                    class="btn btn-primary btn-xs tooltips" data-original-title="" title=""><i
                                        class="far fa-eye c-font-bold"></i></a></td>
                        <tr>
                    </table>

                </span>
            </div>
        </div>
    </div>
</div>
<!-- Header html ends here -->

<!-- Page Content html starts here -->
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12">
                @if(isset($widgets['about-uswidget']))
                @if($widgets['about-uswidget']['status']==1)
                <h1>{{$widgets['about-uswidget']['title']}}</h1>
                <!--  <h1>Future Developments Holdings (Pvt.) Limited</h1> -->
                <hr>
                <div class="d-flex text-justify" style="min-height: auto; overflow-y: auto;">
                    {!!$widgets['about-uswidget']['description']!!}</div>
                <a class="more-link" href="{{url($widgets['about-uswidget']['link'])}}">Learn More &raquo;</a>
                <br>
                @else
                @endif
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Page Content html ends here -->
<!-- Page Cards HTML starts here -->
<div class="page-cards">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col3">
                @if(isset($widgets['about-edlwidget']))
                @if($widgets['about-edlwidget']['status']==1)
                <div class="card h-100">
                    <img class="card-img-top" src="{{ asset('/uploads/'.$widgets['about-edlwidget']['image'])}}" alt="">
                    <div class="card-body main-page-card-edl">
                        <h3 class="card-title">{{$widgets['about-edlwidget']['title']}}</h3>
                        <div class="card-text text-justify">{!!$widgets['about-edlwidget']['description']!!}</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{url($widgets['about-edlwidget']['link'])}}" target="_blank"
                            class="btn btn-primary">Find Out More!</a>
                    </div>
                </div>
                @else
                @endif
                @endif
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col3">
                @if(isset($widgets['about-clicwidget']))
                @if($widgets['about-clicwidget']['status']==1)
                <div class="card h-100">
                    <img class="card-img-top" src="{{asset('/uploads/'.$widgets['about-clicwidget']['image'])}}"
                        alt="clic">
                    <div class="card-body main-page-card-clic">
                        <h3 class="card-title">{{$widgets['about-clicwidget']['title']}}</h3>
                        <div class="card-text text-justify">{!!$widgets['about-clicwidget']['description']!!}</d>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{url($widgets['about-clicwidget']['link'])}}" target="_blank"
                            class="btn btn-primary">Find Out More!</a>
                    </div>
                </div>
                @else
                @endif
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Page Cards html ends here -->

<!-- Our Projects Div Starts Here-->
<!--<div class="our-projects">-->
<div id="projects-target">
</div>
<div class="mb_parallax_container" id="mb_parallax">
    <div class="mb_parallax_overlay">

        <div class="container container-fluid">
            <div class="row">
                <div
                    class="col-12 text-center text-md-left text-lg-left  justify-content-sm-center col-md-10 col-lg-10 our-projects-col1">
                    <h1> OUR PROJECTS </h1>
                    <div class="rline">
                        <div class="line-white">
                        </div>
                    </div>
                </div>
                <div
                    class="col-12 text-center text-md-right justify-content-sm-center col-md-2 d-none d-lg-block d-xl-none our-projects-col1">
                    <i class="fas fa-chevron-left"></i>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div class="row projects-column">
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 sm-screen">
                    <div class="portlet-body">
                        <div class="mt-element-overlay">
                            <div class="col-md-12">
                                <div class="mt-overlay-4">
                                    <img id="media-img-shadow" src="https://fdhlpk.com/uploads/1572605876_2947.jpg"
                                        height="400px" width="150px" style=" object-fit: cover; border: 1px solid grey">
                                    <div class="mt-overlay">
                                        <h2></h2>
                                        <a class="mt-info btn default btn-primary"
                                            href="https://fdhlpk.com/current-projects/capital-smart-city-the-first-smart-city-in-project">Learn
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-center projects-caption">
                        <div class="mt-overlay">
                            <h2>Capital Smart City (The first Smart City in Pakistan) </h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 sm-screen">
                    <div class="portlet-body">
                        <div class="mt-element-overlay">
                            <div class="col-md-12">
                                <div class="mt-overlay-4">
                                    <img id="media-img-shadow" src="https://fdhlpk.com/uploads/1572605884_4133.png"
                                        height="400px" width="150px" style="object-fit: cover;">
                                    <div class="mt-overlay">
                                        <h2></h2>
                                        <a class="mt-info btn default btn-primary"
                                            href="https://fdhlpk.com/upcoming-projects/smart-industrial-park">Learn
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-center projects-caption">
                        <div class="mt-overlay">
                            <h2> M223 Smart Industrial Park </h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 sm-screen">
                </div>

            </div>
            <div class="row">
                <div
                    class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-5 justify-content-md-start col-lg-5 justify-content-start our-projects-col3">
                    <h2> WE ARE IN THIS FIELD SINCE LONG FOR CREATING QUALITY URBAN LIFESTYLES </h2>
                </div>
                <div
                    class="col-12 d-flex justify-content-xs-center justify-content-center col-md-2 justify-content-md-center col-lg-2 justify-content-lg-center  our-projects-col4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="parent-icon-column">
                                <div class="fas fa-users  icon-column"></div>
                            </div>
                        </li>
                        <li>
                            <h2 class="d-flex justify-content-center">Qualified staff</h2>
                        </li>
                        <li>
                            <span class="d-flex justify-content-center staff">400</span>
                        </li>
                    </ul>
                </div>
                <div
                    class="col-12 d-flex justify-content-xs-center justify-content-center col-md-2 justify-content-md-center col-lg-2 justify-content-lg-center our-projects-col4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="parent-icon-column">
                                <div class="fas fa-smile-beam icon-column"></div>
                            </div>
                        </li>
                        <li>
                            <h2 class="d-flex justify-content-center">Happy Clients</h2>
                        </li>
                        <li>
                            <span class="d-flex justify-content-center clients">75</span>
                        </li>
                    </ul>
                </div>
                <div
                    class="col-12 d-flex justify-content-xs-center justify-content-center col-md-2 justify-content-md-center col-lg-2 justify-content-lg-center our-projects-col4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="parent-icon-column">
                                <div class="fas fa-trophy icon-column"></div>
                            </div>
                        </li>
                        <li>
                            <h2 class="d-flex justify-content-center">Awards Won</h2>
                        </li>
                        <li>
                            <span class="d-flex justify-content-center awards">25</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- container ends here -->
        </div>
    </div>
</div>

</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-12 sm-screen">
    @if(isset($projects['lahore-smart-city']))
    @if($projects['lahore-smart-city']['status']==1)
    <div class="portlet-body">
        <div class="mt-element-overlay">
            <div class="col-md-12">
                <div class="mt-overlay-4">
                    <img id="media-img-shadow" src="{{asset('/uploads/'.$projects['lahore-smart-city']['image'])}}"
                        height="400px" width="150px" style="object-fit: cover; ">
                    <div class="mt-overlay">
                        <h2></h2>
                        <a class="mt-info btn default btn-primary"
                            href="{{url('/upcoming-projects/'.$projects['lahore-smart-city']['alias'])}}">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-center projects-caption">
        <div class="mt-overlay">
            <h2> {{$projects['lahore-smart-city']['title']}} </h2>
        </div>
    </div>
    @else
    @endif
    @endif
</div>

</div>
<div class="row">
    <div
        class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-5 justify-content-md-start col-lg-5 justify-content-start our-projects-col3">
        <h2> WE ARE IN THIS FIELD SINCE LONG FOR CREATING QUALITY URBAN LIFESTYLES </h2>
    </div>
    <div
        class="col-12 d-flex justify-content-xs-center justify-content-center col-md-2 justify-content-md-center col-lg-2 justify-content-lg-center  our-projects-col4">
        @if(isset($settings['qualified-staff']))
        @if($settings['qualified-staff']['status']==1)
        <ul class="list-unstyled">
            <li>
                <div class="parent-icon-column">
                    <div class="fas fa-users  icon-column"></div>
                </div>
            </li>
            <li>
                <h2 class="d-flex justify-content-center">Qualified staff</h2>
            </li>
            <li>
                <span class="d-flex justify-content-center staff">
                    {{$settings['qualified-staff']['value']}}
                </span>
            </li>
        </ul>
        @else
        @endif
        @endif
    </div>
    <div
        class="col-12 d-flex justify-content-xs-center justify-content-center col-md-2 justify-content-md-center col-lg-2 justify-content-lg-center our-projects-col4">
        @if(isset($settings['happy-clients']))
        @if($settings['happy-clients']['status']==1)
        <ul class="list-unstyled">
            <li>
                <div class="parent-icon-column">
                    <div class="fas fa-smile-beam icon-column"></div>
                </div>
            </li>
            <li>
                <h2 class="d-flex justify-content-center">Happy Clients</h2>
            </li>
            <li>
                <span class="d-flex justify-content-center clients">
                    {{$settings['happy-clients']['value']}}
                </span>
            </li>
        </ul>
        @else
        @endif
        @endif
    </div>
    <div
        class="col-12 d-flex justify-content-xs-center justify-content-center col-md-2 justify-content-md-center col-lg-2 justify-content-lg-center our-projects-col4">
        @if(isset($settings['awards-won']))
        @if($settings['awards-won']['status']==1)
        <ul class="list-unstyled">
            <li>
                <div class="parent-icon-column">
                    <div class="fas fa-trophy icon-column"></div>
                </div>
            </li>
            <li>
                <h2 class="d-flex justify-content-center">Awards Won</h2>
            </li>
            <li>
                <span class="d-flex justify-content-center awards">
                    {{$settings['awards-won']['value']}}
                </span>
            </li>
        </ul>
        @else
        @endif
        @endif
    </div>
</div>
<!-- container ends here -->
</div>
</div>
</div>
<!--</div> -->


<!-- Media section starts here -->
@include('inc.mediasection')
<!-- Media Section ends here-->

<!-- Our partners Div Starts Here-->
<div class="our-partners">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-md-left justify-content-sm-center  col-md-6 opcol1">
                <h1> OUR PARTNERS AND ASSOCIATES </h1>
                <!--This html is for simple underline and its code start from here -->
                <div class="rline">
                    <div class="line">
                    </div>
                </div>
                <!--This html is for simple underline and its code ends here -->
            </div>
        </div>

        <div class="row">
            @if(isset($files['opaa-1']))
            @if($files['opaa-1']['status']==1)
            <div class="col-12 d-flex justify-content-center justify-content-md-start col-md-4 opcol2">
                <div class="img-border">
                    <a href="{{url($files['opaa-1']['link'])}}" target="_blank">
                        <img class="img-thumbnail" id="media-img-shadow"
                            src="{{asset('/uploads/'.$files['opaa-1']['image'])}}" alt="OP image 1">
                    </a>
                </div>
            </div>
            @else
            @endif
            @endif
            @if(isset($files['opaa-2']))
            @if($files['opaa-2']['status']==1)
            <div class="col-12 d-flex justify-content-center justify-content-md-start col-md-4  opcol3">
                <div class="img-border">
                    <a href="{{url($files['opaa-2']['link'])}}" target="_blank">
                        <img class="img-thumbnail" id="media-img-shadow"
                            src="{{asset('/uploads/'.$files['opaa-2']['image'])}}" alt="OP image 2">
                    </a>
                </div>
            </div>
            @else
            @endif
            @endif
            @if(isset($files['opaa-3']))
            @if($files['opaa-3']['status']==1)
            <div class="col-12 d-flex justify-content-center justify-content-md-start   col-md-4  opcol4">
                <div class="img-border">
                    <a href="{{url($files['opaa-3']['link'])}}" target="_blank">
                        <img class="img-thumbnail" id="media-img-shadow"
                            src="{{asset('/uploads/'.$files['opaa-3']['image'])}}" alt="OP image 3">
                    </a>
                </div>
            </div>
            @else
            @endif
            @endif
        </div>

    </div>
</div>
<!-- Our partners Div Ends Here-->

<!-- Contact us Div Starts Here-->

<div class="row">
    <div class="col-md-12 col-xs-12">
        <hr>
    </div>
</div>


<div class="our-partners" id="iso-certificates">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-md-left justify-content-sm-center  col-md-6 opcol1">
                <h1> ISO Certificates & Memberships </h1>
                <!--This html is for simple underline and its code start from here -->
                <div class="rline">
                    <div class="line"></div>
                </div>
                <!--This html is for simple underline and its code ends here -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12">

                @include('certificates._cards')

            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <br>
    </div>
</div>


<!-- Contact us Div Starts Here-->
<div class="contact-us">
    <div class="container">
        <div class="row">
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-7 justify-content-md-start col-lg-9 justify-content-lg-start cucol1">
                <h2>
                    Have a question or need help! Don't hesitate to contact us
                </h2>
            </div>
            <div
                class="col-12  d-flex justify-content-center col-sm-12 justify-content-center col-md-5 justify-content-md-start col-lg-3 justify-content-lg-start cucol2">
                <a href="{{url('/contact-us')}}" class="btn btn-border">Contact us</a>
            </div>
        </div>
    </div>
</div>

@if($flashnews->isEmpty())
@else
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-custom">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h2 class="modal-title modal-title-custom f-font-black">NEWS FLASH</h2>
                <button type="button" class="nf-close" data-dismiss="modal" aria-hidden="true">X</button>
            </div>
            <div class="modal-body modal-body-cutom">
                @if(isset($flashnews))
                @foreach($flashnews as $fn)
                <div class="row shadow-2">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        {{--  Date starts here --}}
                        <p class="flashnews-date float-right">Published on :
                            {{date('d/m/Y h:i:s', strtotime($fn->created_at))}} </p>
                        <br>
                        {{--  Date ends here --}}
                        <h2 class="h2-custom text-left label-primary f-font-white padding-10 f-font-yellow yellow"><i
                                class="fa fa-star fa-spin yellow"></i> {{$fn->title}}</h2>

                        @if($fn->description!==null)
                        <div class="" style="min-height: auto; overflow-y: auto;">
                            {!!($fn->description!=='')?$fn->description:''!!}
                        </div>
                        @endif
                        <div>
                            @if($fn->image!==null)
                            <p></p>
                            <div> <img src="{{asset(($fn->image!=='')?'uploads/'.$fn->image:'')}}" alt="" width="100%"
                                    height="auto"> </div>
                            @endif
                        </div>
                    </div>
                    <!-- Description starts here -->
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        @if($fn->image!==null)
                        <br>
                        @endif

                        @if($fn->link!==null)
                        <a class="more-link" href="{{($fn->link!=='')?$fn->link:''}}">Learn More &raquo;</a>
                        @endif
                    </div>
                    <!-- Description ends here -->

                </div>
                @endforeach
                @endif
            </div>
            <div class="modal-footer modal-footer-custom">
                <span class="pull-left"> <input class='modal-check' name='modal-check' type="checkbox"> Don't show me
                    again for rest of the day &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <button class="btn btn-primary float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal code ends here -->
@endif

@endsection

@section('scripts')
<script src="{{asset('assets/global/plugins/icheck/icheck.min.js')}}"></script>
@if($flashnews->isEmpty())
@else
<script>
$(document).ready(function() {
    //Referances
    //jQuery Cookie : https://github.com/carhartl/jquery-cookie
    //Modal : http://getbootstrap.com/javascript/#modals
    var my_cookie = $.cookie($('.modal-check').attr('name'));
    if (my_cookie && my_cookie == "true") {
        $(this).prop('checked', my_cookie);
        console.log('checked checkbox');
    } else {
        $('#myModal').modal('show');
        console.log('uncheck checkbox');
    }

    $(".modal-check").change(function() {
        $.cookie($(this).attr("name"), $(this).prop('checked'), {
            path: '/',
            expires: 1
        });
    });
});
</script>
@endif

@endsection