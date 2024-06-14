@extends('layouts.fdhl')

@section('title')
@if(isset($widgets) && isset($widgets['contact-us']) && $widgets['contact-us']['status'] == 1)
{{$widgets['contact-us']['meta_title']}}
@endif
@endsection

@section('description')
@if(isset($widgets) && isset($widgets['contact-us']) && $widgets['contact-us']['status'] == 1)
{{$widgets['contact-us']['meta_description']}}
@endif
@endsection

@section('keywords')
@if(isset($widgets) && isset($widgets['contact-us']) && $widgets['contact-us']['status'] == 1)
{{$widgets['contact-us']['meta_keywords']}}
@endif
@endsection

@section('content')
<div class="aboutusBanner">
    <div class="container">
        <div class="row">
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
                <h1> @if(isset($widgets['contact-us']) && $widgets['contact-us']['status'] == 1)
                    {{$widgets['contact-us']['title']}}
                    @endif
                </h1>
            </div>
            <div
                class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Conatact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Contact us Text banner starts from here -->
    <div class="contactForm">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="messages">@include('inc.messages')</div>
                    <h1>Contact Form</h1>
                    <hr>
                    <p>Send an Email. All fields with an asterisk (*) are required.</p>
                    <br>
                    <form action="{{ route('contact.send') }}" id="contact-form" role="form" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" name="name"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" autofocus
                                placeholder="Enter Name here" required>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" name="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" autofocus
                                placeholder="Enter Email here" required>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" name="subject"
                                class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" autofocus
                                placeholder="Enter Subject here" required>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="description">Message *</label>
                            <textarea name="description" class="form-control" rows="10" cols="50"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            @if(env('GOOGLE_RECAPTCHA_SITE_KEY'))
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}"></div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" name="btnSave" class="btn btn-primary btn-send">
                                <span class="glyphicon glyphicon-save">&nbsp;Send Email</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 fdhlContact">
                    <h1>FDHL Contact</h1>
                    <hr>
                    <br>
                    <br>
                    <h1>Contact</h1>
                    <hr>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt"></i><span>&nbsp;&nbsp;&nbsp;Silver Square Plaza,
                                Plot#15,Street # 73,Mehr Ali Road, </span></li>
                        <li><i class="fas fa-location-arrow"></i><span>&nbsp;&nbsp;&nbsp;F-11 Markaz, </span></li>
                        <li><i class="fas fa-location-arrow"></i><span>&nbsp;&nbsp;&nbsp;Islamabad, </span></li>
                        <li><i class="fas fa-globe-asia"></i><span>&nbsp;&nbsp;&nbsp;Pakistan, </span></li>
                        <li><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Toll Free: 00800-SMART
                                (76278)</span></li>
                        <li><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UAN:+92 51 111 444 475</span>
                        </li>
                        <li><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tel:+92 51 2224301 - 04</span>
                        </li>
                        <li><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email:sales@fdhlpk.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Google maps area start from here-->
    <div class="mapsArea">
        <div class="map-responsive">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3319.946809354719!2d72.98665731473112!3d33.68444144447095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfbde3bdee61ff%3A0x1aaf4f07fee731ee!2sSilver+Square+(S2)!5e0!3m2!1sen!2s!4v1552895845412"
                width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    @endsection