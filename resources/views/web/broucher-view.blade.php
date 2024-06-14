@extends('layouts.fdhl')

@section('content')
<div class="aboutusBanner">
    <div class="container">
        <div class="row">
            <div
                class="col-12 col-sm-12 col-md-8 col-lg-8 d-flex justify-content-center justify-content-md-start aboutusBannerCol1">
                <h1>
                    @if($files['brochure']['status'] == 1)
                    {{ $files['brochure']['title'] }}
                    @endif
                </h1>
            </div>
            <div
                class="col-12 col-sm-12 col-md-4 col-lg-4 d-flex justify-content-center justify-content-md-center aboutusBannerCol2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/index/newsletters') }}">
                                @if($files['brochure']['status'] == 1)
                                {{ $files['brochure']['title'] }}
                                @endif
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- NEWS LIST Start from here -->
<div class="container fdhl-flipbooks">
    <div class="row">
        <div class="col-12">
            <iframe src="{{ url($files['brochure']['link']) }}" width="100%" height="600px" frameborder="0"
                webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen></iframe>
        </div>
    </div>
</div>
<!-- NEWS LIST Ends from here -->

<!-- Contact us Div Starts Here -->
<div class="contact-us">
    <div class="container">
        <div class="row">
            <div
                class="col-12 col-sm-12 col-md-7 col-lg-9 d-flex justify-content-center justify-content-md-start cucol1">
                <h2>Have a question or need help? Don't hesitate to contact us</h2>
            </div>
            <div
                class="col-12 col-sm-12 col-md-5 col-lg-3 d-flex justify-content-center justify-content-md-start cucol2">
                <a href="{{ url('/contact-us') }}" class="btn btn-border">Contact us</a>
            </div>
        </div>
    </div>
</div>
<!-- Contact us Div Ends Here -->
@endsection