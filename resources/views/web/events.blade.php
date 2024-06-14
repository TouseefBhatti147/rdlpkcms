@extends('layouts.fdhl')
@section('title')
@if(isset($widgets))  
@if($widgets['events-widget']['status']==1)
{{$widgets['events-widget']['meta_title']}}
@endif
@endif
@endsection
@section('description')
@if(isset($widgets))  
@if($widgets['events-widget']['status']==1)
{{$widgets['events-widget']['meta_description']}}
@endif
@endif
@endsection
@section('keywords')
@if(isset($widgets))  
@if($widgets['events-widget']['status']==1)
{{$widgets['events-widget']['meta_keywords']}}
@endif
@endif
@endsection
@section('content')
<div class="aboutusBanner">
    <div class="container">
          <div class="row">
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
           <h1>   @if($widgets['events-widget']['status']==1)
           {{$widgets['events-widget']['meta_title']}}
             @endif </h1>
           </div>
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                   <li class="breadcrumb-item active" aria-current="page">Events</li>
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
            @foreach($allevents as $events)
             <!-- gallary starts here -->

                                <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-6 justify-content-md-left col-lg-4 justify-content-lg-left  listCol1">
                                 <div class="card" style="width: 18rem; border:none ">
                                       <a  href="{{url('/events/'.$events->alias)}}"> <img class="card-img-top" height="200px" style="object-fit: cover;"  src="{{asset('/uploads/'.$events->image)}}" alt="Card image cap"></a>
                                       <div class="card-body">
                                    <h2 class="card-title">{{$events->title}}</h2>
                                     <p class="card-text">
                                       {!!$events->short_description!!}
                                    </p>
                                   <a class="more-link" href="{{url('/events/'.$events->alias)}}">Read More &raquo;</a>
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
