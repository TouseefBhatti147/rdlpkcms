@extends('layouts.fdhl')
@section('title')
@if(isset($widgets))
  @if($widgets['contact-us']['status']==1)
{{$widgets['contact-us']['meta_title']}}
@endif
@endif
@endsection
@section('description')
@if(isset($widgets))
@if($widgets['contact-us']['status']==1)
{{$widgets['contact-us']['meta_description']}}
@endif
@endif
@endsection
@section('keywords')
@if(isset($widgets))
@if($widgets['contact-us']['status']==1)
{{$widgets['contact-us']['meta_keywords']}}
@endif
@endif
@endsection
@section('content')
<div class="aboutusBanner">
    <div class="container">
          <div class="row">
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
           <h1>Iso Certificates</h1>
           </div>
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#}">Iso certificates</a></li>

                </ol>
            </nav>
           </div>
       </div>
   </div>
</div>

{{-- iso certificates starts here --}}
@include('inc.isocertificates')
{{-- ISO certificates ends here --}}

<!-- Contact us Div Starts Here-->
<div class="contact-us">
    <div class="container">
        <div class="row">
        <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-7 justify-content-md-start col-lg-9 justify-content-lg-start cucol1">
            <h2>Have a question or need help! Don't hesitate to contact us</h2>
        </div>
        <div class="col-12  d-flex justify-content-center col-sm-12 justify-content-center col-md-5 justify-content-md-start col-lg-3 justify-content-lg-start cucol2">
            <a href="{{url('/contact-us')}}" class="btn btn-border">Contact us</a>
        </div>
    </div>
</div>
</div>
<!-- Contact us Div Ends Here-->
@endsection
