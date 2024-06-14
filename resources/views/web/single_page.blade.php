@extends('layouts.fdhl')
@section('css')
<style>
.sitmaplist {
  list-style: none;
    font-size: 16px;
    font-weight: 500;
    display: block;

}
.sitmaplist a{
  list-style: none;
    font-size: 16px;
    font-weight: 500;
    display: block;
    color: #7f8386;

}

.sitmaplist ul{


  margin-block-start: 1em;
  margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
}
.sitmaplist li{
  color: #7f8386;
}
.sitmaplist>li:before {
    content: '';
    width: 21px;
    height: 2px;
    float: left;
    margin: 9px 15px 0 -36px;
    background: #eeb313 !important;
}

.c-content-list-1>a:active, a:hover, a:focus{
  color: #eeb313;
}

</style>
@endsection
@section('title')
@if(isset($specific_pages))
{{$specific_pages['meta_title']}}
@endif
@endsection
@section('description')
@if(isset($specific_pages))
{{$specific_pages['meta_description']}}
@endif
@endsection
@section('keywords')
@if(isset($specific_pages))
{{$specific_pages['meta_keywords']}}
@endif
@endsection
@section('content')
<div class="aboutusBanner">
    <div class="container">
          <div class="row">
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
           <h1>     </h1>
           </div>
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                   <li class="breadcrumb-item active" aria-current="page">{{$specific_pages['title']}}</li>
                </ol>
            </nav>
           </div>
       </div>
   </div>
</div>

<!-- Privacy Policy Page starts from here-->
  <div class="list">
         <div class="container">
            @if($specific_pages['alias']=='site-map')
            <div class="row">
                <div class="col-lg-12 text-lg-center col-md-12 text-md-center col-sm-12 text-sm-center col-12 text-center">
                     <div class="pages-title">
                        <h1>
                    {{$specific_pages['title']}}
                       </h1>
                     </div>
                      <div class="pline">
                      <div class="line-yellow"></div>
                     </div>
                     </div>
                 </div>
                 <div class="row">
                   <div class="col-lg-12 text-lg-left col-md-12 text-md-left col-sm-12 text-sm-left col-12 text-left pages-content">
                     <ul class="sitmaplist">
                       <li><a href="{{url('/')}}"><h2>Home Page</h2></a></li>

                          <ul class="sitmaplist">
                            <li><a href="{{url('/brochure')}}"><h2>FDH broucher (View Online)</h2></a></li>
                            <li><a href="{{url('/uploads/1571747915_1423.pdf')}}"><h2>FDH broucher (Download)</h2></a></li>
                            <li><a href="{{url('/about-us')}}"><h2>About Us</h2></a></li>

                            <li><h2>Projects</h2></li>
                            <ul class="sitmaplist">
                               <li><h2>Current Projects</h2></li>
                               <ul class="sitmaplist">
                                             @foreach($currentProjects as $cr_project)
                                  <li><a href="{{url('/current-projects/'.$cr_project->alias)}}"><h2>{{$cr_project->title}}</h2></a></li>
                                             @endforeach
                               </ul>
                               <li><h2>Upcoming Projects</h2></li>
                               <ul class="sitmaplist">
                                 @foreach($upcomingProjects as $cr_project)
                                      <li><a href="{{url('/upcoming-projects/'.$cr_project->alias)}}"><h2>{{$cr_project->title}}</h2></a></li>
                                 @endforeach
                               </ul>
                             </ul>
                            <li><h2>News List</h2></li>

                            <ul class="sitmaplist">
                                @foreach($allnews as $news)
                               <li><a href="{{url('/news/'.$news->alias)}}"><h2>{{$news->title}}</h2></a></li>
                                @endforeach
                            </ul>

                            <li><h2>Event List</h2></li>
                            <ul class="sitmaplist">
                                @foreach($allevents as $events)
                               <li><a href="{{url('/events/'.$events->alias)}}"><h2>{{$events->title}}</h2></a></li>
                                @endforeach
                            </ul>
                            <li><h2>Newsletters List</h2></li>
                            <ul class="sitmaplist">
                                @foreach($newsletters as $newsl)
                               <li><a href="{{url('/newsletters/'.$newsl->alias)}}"><h2>{{$newsl->title}}</h2></a></li>
                                @endforeach
                            </ul>
                            <li><a href="{{url('/contact-us')}}"><h2>Contact Us</h2></a></li>
                            <li><h2>Pages</h2></li>
                            <ul class="sitmaplist">
                               <li><a href="@if($pages['terms-of-service']['status']==1)
                                 {{url('/pages/'.$pages['terms-of-service']['alias'])}}
                                 @else
                                   #
                                @endif"><h2>Terms of Service</h2></a></li>
                               <li><a href="@if($pages['privacy-policy']['status']==1)
                                 {{url('/pages/'.$pages['privacy-policy']['alias'])}}
                                 @else
                                   #
                                @endif"><h2>Privacy Policy</h2></a></li>
                            </ul>
                            <li><h2>Important Links</h2></li>
                            <ul class="sitmaplist">
                               <li><a href="@if($settings['facebook-link']['status']==1){{$settings['facebook-link']['value']}}
                                 @else
                                #
                               @endif"><h2>Facebook</h2></a></li>
                               <li><a href="@if($settings['twitter-link']['status']==1){{$settings['twitter-link']['value']}}
                                 @else
                                #
                               @endif"><h2>Twitter</h2></a></li>
                               <li><a href="@if($settings['instagram-link']['status']==1){{$settings['instagram-link']['value']}}
                                 @else
                                #
                               @endif"><h2>Instagram</h2></a></li>
                               <li><a href="@if($settings['youtube-link']['status']==1){{$settings['youtube-link']['value']}}
                                 @else
                                #
                               @endif"><h2>Youtube</h2></a></li>

                               <li><a href="http://www.habibrafiq.com/index.php?lang=en"><h2>Habib Rafiq (Pvt) Limited.</h2></a></li>
                                                                         <li><a href="http://www.smartcarespk.com/"><h2>Smart Cares (Pvt) Limited.</h2></a></li>
                               <li><a href="http://edlpk.com/home.php"><h2>Engineering Dimensions (Pvt) Limited.</h2></a></li>
                               <li><a href="http://www.cccme.org.cn/shop/cccme9107/index.aspx"><h2>China Liaoning International Economic and Technical Cooperation Group Corporation Limited.</h2></a></li>
                             </ul>

                         </ul>

                       <li><a href=" {{url('/sitemap.xml')}}"><h2>Sitemap - XML</h2></a></li>
                     </ul>
                   </div>
                 </div>
             @else
            @if($specific_pages['status']==1)
            <div class="row">
                <div class="col-lg-12 text-lg-center col-md-12 text-md-center col-sm-12 text-sm-center col-12 text-center">
                     <div class="pages-title">
                        <h1>
                      {{$specific_pages['title']}}
                      </h1>
                      </div>
                             <div class="pline">
                       <div class="line-yellow"></div>
                     </div>
              </div>
          </div>
          <div class="row">
            <div class="col-lg-12 text-lg-left col-md-12 text-md-left col-sm-12 text-sm-left col-12 text-left pages-content">
                {!!$specific_pages['description']!!}
            </div>
          </div>
          @else
          @endif
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
