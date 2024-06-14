@extends('layouts.fdhl')
@section('content')
<div class="aboutusBanner">
    <div class="container">
          <div class="row">
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
           <h1> Privacy Policy </h1>
           </div>
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                   <li class="breadcrumb-item active" aria-current="page">Privacy Policy </li>
                </ol>
            </nav>
           </div>
       </div>
   </div>
</div>

<!-- Privacy Policy Page starts from here-->
  <div class="list">
         <div class="container">
              @if($pages['privacy-policy']['status']==1)
             <div class="row">
                <div class="col-lg-12 text-lg-center col-md-12 text-md-center col-sm-12 text-sm-center col-12 text-center">
                     <div class="pages-title">
                        <h1>
                         {!! $pages['privacy-policy']['title']!!}
                      </h1>
                      </div>
                             <div class="pline">
                       <div class="line-yellow"></div>
                     </div>
              </div>
          </div>
          <div class="row">
            <div class="col-lg-12 text-lg-left col-md-12 text-md-left col-sm-12 text-sm-left col-12 text-left pages-content">
                  {!! $pages['privacy-policy']['description']!!}
            </div>
          </div>
          @else
         @endif
  </div>
<!-- Privacy Policy Ends from here-->


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
