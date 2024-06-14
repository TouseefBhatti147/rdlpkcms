@extends('layouts.fdhl')
@section('title')
@if(isset($widgets['videos-widget']) && $widgets['videos-widget']['status'] == 1)
{{$widgets['videos-widget']['meta_title']}}
@endif
@endsection

@section('description')
@if(isset($widgets['videos-widget']) && $widgets['videos-widget']['status'] == 1)
{{$widgets['videos-widget']['meta_description']}}
@endif
@endsection

@section('keywords')
@if(isset($widgets['videos-widget']) && $widgets['videos-widget']['status'] == 1)
{{$widgets['videos-widget']['meta_keywords']}}
@endif
@endsection

@section('content')
<div class="aboutusBanner">
    <div class="container">
        <div class="row">
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
                <h1>@if(isset($widgets['videos-widget']) && $widgets['videos-widget']['status'] == 1)
                    {{$widgets['videos-widget']['title']}}
                    @endif
                </h1>
            </div>
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Videos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<!-- NEWS LIST Start from here from here-->
<div class="list">
    <div class="container">
        <div class="row">
            @foreach($allvideos as $videos)
            <!-- gallary starts here -->@if ($loop->first)
            @else
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-6 justify-content-md-left col-lg-4 justify-content-lg-left  listCol1">
                <div class="card" style=" border:none; height:auto; ">
                    <div class="fdhl-video">
                        <iframe src="https://www.youtube.com/embed/{{$videos->alias}}" height="300px" frameborder="0"
                            webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
                    <div class="card-body fdhl-video-title">
                        <h2 class="card-title">{{$videos->title}}</h2>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

<!-- NEWS LIST Ends from here from here-->
<!-- Contact us Div Starts Here-->
<div class="contact-us">
    <div class="container">
        <div class="row">
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-7 justify-content-md-start col-lg-9 justify-content-lg-start cucol1">
                <h2>Have a question or need help! Don't hesitate to contact us</h2>
            </div>
            <div
                class="col-12  d-flex justify-content-center col-sm-12 justify-content-center col-md-5 justify-content-md-start col-lg-3 justify-content-lg-start cucol2">
                <a href="{{url('/contact-us')}}" class="btn btn-border">Contact us</a>
            </div>
        </div>
    </div>
</div>
<!-- Contact us Div Ends Here-->
@endsection