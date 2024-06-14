@extends('layouts.fdhl')

@section('title')
    @if(isset($widgets['about-us']) && $widgets['about-us']['status'] == 1)
        {{$widgets['about-us']['meta_title']}}
    @endif
@endsection

@section('description')
    @if(isset($widgets['about-us']) && $widgets['about-us']['status'] == 1)
        {{$widgets['about-us']['meta_description']}}
    @endif
@endsection

@section('keywords')
    @if(isset($widgets['about-us']) && $widgets['about-us']['status'] == 1)
        {{$widgets['about-us']['meta_keywords']}}
    @endif
@endsection

@section('content')
<div class="aboutusBanner">
    <div class="container">
          <div class="row">
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-8 justify-content-md-start col-lg-8 justify-content-lg-start aboutusBannerCol1">
           <h1> About us </h1>
           </div>
           <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-4 justify-content-md-center col-lg-4 justify-content-lg-center aboutusBannerCol2">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
            @if(isset($widgets['about-us']))
                  @if($widgets['about-us']['status']==1)
                  <h1>
                    {{ $widgets['about-us']['title'] }}
                  </h1>
                        <div class="rline">
                    <div class="line-black">
                    </div>
              </div>
              @else
             @endif
             @endif
            </div>

          </div>
          <div class="row">
              <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-justify aboutusParagraph">
                @if(isset($widgets['about-us']))
                  @if($widgets['about-us']['status']==1)
                  {!! $widgets['about-us']['description']!!}
                  @else
                 @endif
                 @endif
                </div>
              <div class="col-12 text-justify col-md-6 col-lg-6 aboutusParagraph2">
                @if(isset($widgets['who-we-are']))
                 @if($widgets['who-we-are']['status']==1)
                 <h2><em class="fa fa-heart"></em>
                         {{$widgets['who-we-are']['title']}}
                </h2>
                {!!$widgets['who-we-are']['description']!!}
                @else
              @endif
              @endif
              @if(isset($widgets['what-we-offer']))
              @if($widgets['what-we-offer']['status']==1)
                <h2><em class="fa fa-star"></em>
                                {{$widgets['what-we-offer']['title']}}
                          </h2>
                                {!!$widgets['what-we-offer']['description']!!}
                                  @else
                     @endif
                     @endif
              </div>
          </div>
          <div class="row">
        <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-center  justify-content-lg-center text-justify col-lg-4 aboutusCard1">
          @if(isset($widgets['innovative-ideas']))
          @if($widgets['innovative-ideas']['status']==1)
           <div class="card" style="width: 18rem;  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);"   >
            <img class="card-img-top" src="{{asset('/uploads/'.$widgets['innovative-ideas']['image'])}}" alt="Card image cap">
            <div class="card-body text-justify about-page-card" style="overflow-y: auto; height:300px;">
              <h2 class="card-title">
                            {{$widgets['innovative-ideas']['title']}}
                      </h2>

                                   {!!$widgets['innovative-ideas']['description']!!}

            </div>
          </div>
          @else
         @endif
         @endif
       </div>

       <div class="col-12 text-justify col-md-4 d-flex justify-content-center justify-content-md-center  justify-content-lg-center col-lg-4 aboutusCard1">
        @if(isset($widgets['modern-living-enviroment']))
        @if($widgets['modern-living-enviroment']['status']==1)
     <div class="card" style="width: 18rem;  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); "   >
            <img class="card-img-top" src="@if($widgets['modern-living-enviroment']['status']==1)
            {{asset('/uploads/'.$widgets['modern-living-enviroment']['image'])}}
                   @else
                  @endif" alt="Card image cap">
            <div class="card-body text-justify about-page-card" style="height:300px;  overflow-y: auto;">
              <h2 class="card-title">
                              {{$widgets['modern-living-enviroment']['title']}}
                        </h2>

                                      {!!$widgets['modern-living-enviroment']['description']!!}

            </div>
         </div>
         @else
        @endif
        @endif
      </div>

      <div class="col-12 text-justify col-md-4 d-flex justify-content-center justify-content-md-center  justify-content-lg-center col-lg-4 aboutusCard1">
      <div id="accordion">
     <div class="card" style="  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);"   >
        <div class="card-header text-justify " id="headingOne">
          <h5 class="mb-0"  id="my_styles">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><em class="fa fa-star"></em>
              @if(isset($widgets['our-mission']))
              @if($widgets['our-mission']['status']==1)
                           {{$widgets['our-mission']['title']}}
                       @else
                      @endif
                      @endif
            </button>
          </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body text-justify about-page-card-om">
            @if(isset($widgets['our-mission']))
            @if($widgets['our-mission']['status']==1)
                   {!!$widgets['our-mission']['description']!!}
               @else
              @endif
              @endif
          </div>
        </div>
      </div>
       <div class="card" style="  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);"   >
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><em class="fa fa-star"></em>
              @if(isset($widgets['our-vision']))
              @if($widgets['our-vision']['status']==1)
                     {{$widgets['our-vision']['title']}}
                 @else
                @endif
                @endif
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body about-page-card-om">
            @if(isset($widgets['our-vision']))
            @if($widgets['our-vision']['status']==1)
                   {!!$widgets['our-vision']['description']!!}
               @else
              @endif
              @endif
        </div>
      </div>
     <div class="card" style="  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);"   >
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><em class="fa fa-star"></em>
              @if(isset($widgets['our-goal']))
              @if($widgets['our-goal']['status']==1)
                     {{$widgets['our-goal']['title']}}
                 @else
                @endif
                @endif
            </button>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body about-page-card-om">
            @if(isset($widgets['our-goal']))
            @if($widgets['our-goal']['status']==1)
                   {!!$widgets['our-goal']['description']!!}
               @else
              @endif
              @endif
          </div>
        </div>
      </div>
      </div>
      </div>

      </div>
      </div>
       </div>
       </div>
       <!-- Latest content div starts from here -->
         <div class="boxIcons">
         <div class="container">
             <div class="row">
                 <!-- div for video column starts here-->
                 <div class="col-12 d-flex justify-content-center col-md-6 justify-content-md-start col-lg-6 justify-content-lg-start videoColumn">
                 <!-- Right now keeping this div empty for time being-->
                 @if(isset($videos['233784683']))
                 @if($videos['233784683']['status']==1)
                  <iframe src="https://player.vimeo.com/video/{{$videos['233784683']['alias']}}" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>  @else
                   @endif
                   @endif
                 </div>
                 <div class="col-12 col-md-6 col-lg-6 iconColumn">
                   <div class="row">
                       <div class="col-12 d-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center col-sm-12 col-md-5 col-lg-5 box">

                         <ul class="list-unstyled">
                                         <li><i class="fas fa-clock"></i></li>
                                         <li><h2 class="">Always Avaiable</h2></li>
                                     </ul>

                       </div>
                       <div class="col-12 d-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center col-sm-12 col-md-5 col-lg-5 box">
                         <ul class="list-unstyled">
                                       <li>   <i class="fas fa-user-tie"></i> </li>
                                       <li><h2 class="">Quality Agents</h2></li>
                                  </ul>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-12 d-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center col-sm-12 col-md-5 col-lg-5 box">
                         <ul class="list-unstyled">
                                    <li><i class="fas fa-gift"></i></li>
                                    <li><h2 class="">Best Offers</h2></li>
                               </ul>
                       </div>
                       <div class="col-12 d-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center col-sm-12 col-md-5 col-lg-5 box">
                         <ul class="list-unstyled">
                                     <li><i class="fas fa-wallet"></i></li>
                                     <li><h2 class="">Fair Prices</h2></li>
                                </ul>
                       </div>
                   </div>
                 </div>
               </div> <!-- row ends here -->
         </div> <!-- container ends here -->
         </div> <!--Box icons div ends here -->

    <!-- About Company div ends here-->
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
