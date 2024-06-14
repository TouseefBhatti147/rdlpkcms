@extends('layouts.fdhl')
@section('title')
@if(isset($projects))
{{$projects['meta_title']}}
@endif
@endsection
@section('description')
@if(isset($projects))
{{$projects['meta_description']}}
@endif
@endsection
@section('keywords')
@if(isset($projects))
{{$projects['meta_keywords']}}
@endif
@endsection
@section('content')
<div class="aboutusBanner">
    <div class="container">
          <div class="row">
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
           <h1>{{$projects['title']}}</h1>
           </div>
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#}">Upcoming Projects</a></li>

                </ol>
            </nav>
           </div>
       </div>
   </div>
</div>


<!-- Project description starts from here-->
<div class="projectDetails">
    <div class="container">
        <div class="row">

           <div class="col-12 col-md-7 projectDetailsCol1">
             <img src="{{asset('/uploads/'.$projects['image'])}}" class="img-responsive" style="object-fit: cover;" alt="Responsive image">
               <div class="row">
                   <div class="col-12 d-flex justify-content-center col-md-12 justify-content-md-center col-lg-5 justify-content-lg-center btn1">
                    <a href="{{$projects['website']}}" target="_blank" class="btn btn-primary">Visit Website</a>
                   </div>
                   <div class="col-12 d-flex justify-content-center col-md-12 justify-content-md-center col-lg-7 justify-content-lg-center btn1">
                    <a href="{{$projects['broucher_link']}}" target="_blank" class="btn btn-primary">Brouchure </a>
                   </div>
               </div>
           </div>

           <div class="col-12 col-md-5 text-justify projectDetailsCol2">

               <h2>{{$projects['title']}}</h2>
                 <br>
           {!!$projects['description']!!}
           </div>

</div>
</div>
</div>
<!-- Project description ends from here-->
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
