@extends('layouts.fdhl')
@section('title')
@if(isset($newsletters))
{{$newsletters['meta_title']}}
@endif
@endsection
@section('description')
@if(isset($newsletters))
{{$newsletters['meta_description']}}
@endif
@endsection
@section('keywords')
@if(isset($newsletters))
{{$newsletters['meta_keywords']}}
@endif
@endsection
@section('content')
<div class="aboutusBanner">
    <div class="container">
        <div class="row">
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
                <h1>{{$newsletters['title']}}</h1>
            </div>
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/index/newsletters')}}">Newsletter</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- NEWS LIST Start from here from here-->
<div class="container fdhl-flipbooks">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <iframe src="{{url($newsletters['link'])}}" width="100%" height="600px" frameborder="0"
                webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen=""></iframe>
        </div>
    </div>
</div>

@endsection