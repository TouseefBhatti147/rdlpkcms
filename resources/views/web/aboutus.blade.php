@extends('layouts.fdhl')

@section('title')
{{ $widgets['about-us']['meta_title'] ?? '' }}
@endsection

@section('description')
{{ $widgets['about-us']['meta_description'] ?? '' }}
@endsection

@section('keywords')
{{ $widgets['about-us']['meta_keywords'] ?? '' }}
@endsection

@section('content')
<div class="aboutusBanner">
    <div class="container">
        <div class="row">
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
                <h1>About us</h1>
            </div>
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- About Company Div starts from here-->
<div class="aboutusCompany">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 heading">
                @if(!empty($widgets['about-us']['status']))
                <h1>{{ $widgets['about-us']['title'] }}</h1>
                <div class="rline">
                    <div class="line-black"></div>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-justify aboutusParagraph">
                @if(!empty($widgets['about-us']['status']))
                {!! $widgets['about-us']['description'] !!}
                @endif
            </div>
            <div class="col-12 text-justify col-md-6 col-lg-6 aboutusParagraph2">
                @if(!empty($widgets['who-we-are']['status']))
                <h2><em class="fa fa-heart"></em> {{ $widgets['who-we-are']['title'] }}</h2>
                {!! $widgets['who-we-are']['description'] !!}
                @endif
                @if(!empty($widgets['what-we-offer']['status']))
                <h2><em class="fa fa-star"></em> {{ $widgets['what-we-offer']['title'] }}</h2>
                {!! $widgets['what-we-offer']['description'] !!}
                @endif
            </div>
        </div>
        <div class="row">
            @foreach(['innovative-ideas', 'modern-living-enviroment'] as $widgetKey)
            @if(!empty($widgets[$widgetKey]['status']))
            <div class="col-12 col-md-4 d-flex justify-content-center text-justify col-lg-4 aboutusCard1">
                <div class="card" style="width: 18rem; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                    <img class="card-img-top" src="{{ asset('/uploads/'.$widgets[$widgetKey]['image']) }}"
                        alt="Card image cap">
                    <div class="card-body text-justify about-page-card" style="overflow-y: auto; height: 300px;">
                        <h2 class="card-title">{{ $widgets[$widgetKey]['title'] }}</h2>
                        {!! $widgets[$widgetKey]['description'] !!}
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            <div class="col-12 col-md-4 d-flex justify-content-center text-justify col-lg-4 aboutusCard1">
                <div id="accordion">
                    @foreach(['our-mission', 'our-vision', 'our-goal'] as $widgetKey)
                    @if(!empty($widgets[$widgetKey]['status']))
                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-header" id="heading{{ ucfirst($widgetKey) }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapse{{ ucfirst($widgetKey) }}" aria-expanded="false"
                                    aria-controls="collapse{{ ucfirst($widgetKey) }}">
                                    <em class="fa fa-star"></em> {{ $widgets[$widgetKey]['title'] }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{ ucfirst($widgetKey) }}" class="collapse @if($loop->first) show @endif"
                            aria-labelledby="heading{{ ucfirst($widgetKey) }}" data-parent="#accordion">
                            <div class="card-body text-justify about-page-card-om">
                                {!! $widgets[$widgetKey]['description'] !!}
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Company div ends here-->

<!-- Latest content div starts from here -->
<div class="boxIcons">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center col-md-6 videoColumn">
                @if(!empty($videos['233784683']['status']))
                <iframe src="https://player.vimeo.com/video/{{ $videos['233784683']['alias'] }}" frameborder="0"
                    webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
                @endif
            </div>
            <div class="col-12 col-md-6 iconColumn">
                <div class="row">
                    @foreach(['clock' => 'Always Available', 'user-tie' => 'Quality Agents', 'gift' => 'Best Offers',
                    'wallet' => 'Fair Prices'] as $icon => $text)
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5 d-flex justify-content-center box">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-{{ $icon }}"></i></li>
                            <li>
                                <h2>{{ $text }}</h2>
                            </li>
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Latest content div ends here -->

<!-- Contact us Div Starts Here -->
<div class="contact-us">
    <div class="container">
        <div class="row">
            <div
                class="col-12 col-md-7 col-lg-9 d-flex justify-content-center justify-content-md-start justify-content-lg-start cucol1">
                <h2>Have a question or need help? Don't hesitate to contact us</h2>
            </div>
            <div
                class="col-12 col-md-5 col-lg-3 d-flex justify-content-center justify-content-md-start justify-content-lg-start cucol2">
                <a href="{{ url('/contact-us') }}" class="btn btn-border">Contact us</a>
            </div>
        </div>
    </div>
</div>
<!-- Contact us Div Ends Here -->

@endsection