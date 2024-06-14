@extends('layouts.fdhl')
@section('title')
@if(isset($widgets['newsletter-widget']) && $widgets['newsletter-widget']['status'] == 1)
{{$widgets['newsletter-widget']['meta_title']}}
@endif
@endsection

@section('description')
@if(isset($widgets['newsletter-widget']) && $widgets['newsletter-widget']['status'] == 1)
{{$widgets['newsletter-widget']['meta_description']}}
@endif
@endsection

@section('keywords')
@if(isset($widgets['newsletter-widget']) && $widgets['newsletter-widget']['status'] == 1)
{{$widgets['newsletter-widget']['meta_keywords']}}
@endif
@endsection

@section('content')
@if(isset($widgets['newsletter-widget']) && $widgets['newsletter-widget']['status'] == 1)
{{$widgets['newsletter-widget']['title']}}
@endif
@endsection


@section('content')
<div class="aboutusBanner">
    <div class="container">
        <div class="row">
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
                <h1> @if(isset($widgets['newsletter-widget']) && $widgets['newsletter-widget']['status'] == 1)
                    {{$widgets['newsletter-widget']['title']}}
                    @endif
                </h1>
            </div>
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Newsletters</li>
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
            @foreach($newsletters as $news)
            <!-- gallary starts here -->

            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-6 justify-content-md-left col-lg-6 justify-content-lg-left  listCol1">
                <div class="portlet-body">
                    <div class="mt-element-overlay">
                        <div class="col-md-12">
                            <div class="mt-overlay-4">
                                <img class="card-img-top" id="media-img-shadow"
                                    style="height:600px; width: 100%; object-fit: cover;"
                                    src="{{asset('/uploads/'.$news->image)}}" alt="Card image cap">

                                <div class="mt-overlay">
                                    <h2>{{$news->title}}</h2>
                                    <ul class="mt-info">
                                        <li>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        </li>
                                        <li>
                                            <a class="mt-info btn default btn-primary"
                                                href="{{asset('/uploads/'.$news->pdf_file)}}"><i class="fas fa-download"
                                                    aria-hidden="true"></i>&nbsp;Download</a>
                                            <a class="mt-info btn default btn-primary"
                                                href="{{url('/newsletters/'.$news->alias)}}"><i class="fas fa-eye"
                                                    aria-hidden="true"></i>&nbsp;View online</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card d-flex" style="width: 25rem; border:none">
                        <div class="card-body">
                            <h2 class="d-flex  justify-content-center">{{$news->title}}</h2>
                            <p class="media-date d-flex  justify-content-center">
                                {{date('F, Y', strtotime($news->created_at))}}</p>
                        </div>
                    </div>
                </div>
            </div>

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