<div class="our-smart-group">
   <div class="container">
       <br/>
       <br/>
      {{-- 
        
        <div class="row"><!-- Starts here --><!-- This row is for the defination -->
        <div class="col-12 text-center text-md-left justify-content-sm-center col-md-6 group-defination">
            <h1> OUR GROUP </h1>
            <!--This html is for simple underline and its code start from here -->
            <div class="rline">
               <div class="line">
              </div>
           </div>
           <!--This html is for simple underline and its code ends here -->
          </div>
      </div>
      
    --}}
      <!-- Ends here --><!-- This row is for the defination -->

           
           <div class="row"><!-- Starts here --><!-- This row is for the group elements -->
            @if(isset($files['smart-cares'])) 
            @if($files['smart-cares']['status']==1)
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 group-company">
                   <div class="portlet-body">
                           <div class="mt-element-overlay">
                                <div class="col-md-12">

                                    <div class="mt-overlay-4 mt-overlay-4-icons">
                                           <img id="media-img-shadow" src="{{asset('/uploads/'.$files['smart-cares']['image'])}}" alt="{{$files['smart-cares']['title']}}">
                                           <div class="mt-overlay">
                                            <h2>{{$files['smart-cares']['title']}}</h2>
                                             <ul class="mt-info">
                                                            <li>

                                                               <a class="btn default btn-primary" href="{{url($files['smart-cares']['link'])}}" target="_blank">Learn More</a>

                                                                </a>
                                                            </li>

                                                  </ul>
                                           </div>
                                       </div>
                                 </div>
                           </div>
                       </div>
                       <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-start col-md-12 justify-content-md-start col-lg-12 justify-content-lg-start" style="background-color: #f7fafb">
                        <div class="card" style="width: 100%; border:none; background-color:#f7fafb ">
                            <div class="card-body">
                            <h2 class="card-title">{{$files['smart-cares']['title']}}</h2>
                            <p class="card-text"> {{$files['smart-cares']['title_first_line']}}  {{$files['smart-cares']['title_second_line']}}</p>
                          </div>
                     </div>
                 </div>
                  </div>
                  @else
                @endif
                @endif
                
        @if(isset($files['smart-future-technologies'])) 
            @if($files['smart-future-technologies']['status']==1)
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 group-company">
                   <div class="portlet-body">
                           <div class="mt-element-overlay">
                                <div class="col-md-12">

                                    <div class="mt-overlay-4 mt-overlay-4-icons">
                                           <img id="media-img-shadow" src="{{asset('/uploads/'.$files['smart-future-technologies']['image'])}}" alt="{{$files['smart-future-technologies']['title']}}">
                                           <div class="mt-overlay">
                                            <h2>{{$files['smart-future-technologies']['title']}}</h2>
                                             <ul class="mt-info">
                                                            <li>

                                                               <a class="btn default btn-primary" href="{{url($files['smart-future-technologies']['link'])}}" target="_blank">Learn More</a>

                                                                </a>
                                                            </li>

                                                  </ul>
                                           </div>
                                       </div>
                                 </div>
                           </div>
                       </div>
                       <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-start col-md-12 justify-content-md-start col-lg-12 justify-content-lg-start" style="background-color: #f7fafb">
                        <div class="card" style="width: 100%; border:none; background-color:#f7fafb ">
                            <div class="card-body">
                            <h2 class="card-title">{{$files['smart-future-technologies']['title']}}</h2>
                            <p class="card-text"> {{$files['smart-future-technologies']['title_first_line']}}{{$files['smart-future-technologies']['title_second_line']}} </p>
                          </div>
                     </div>
                 </div>
                  </div>
                  @else
                @endif
                @endif
                @if(isset($files['smart-properties']))
                @if($files['smart-properties']['status']==1)
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 group-company">
                    {{-- Our group text caption starts here --}}
                 
                    {{-- Our group text caption ends here --}}
                   <div class="portlet-body">
                           <div class="mt-element-overlay">
                                <div class="col-md-12">
                                    <div class="mt-overlay-4 mt-overlay-4-icons">
                                           <img id="media-img-shadow" src="{{asset('/uploads/'.$files['smart-properties']['image'])}}" alt="{{$files['smart-properties']['title']}}">
                                           <div class="mt-overlay">
                                            <h2>{{$files['smart-properties']['title']}}</h2>
                                             <ul class="mt-info">
                                                            <li>

                                                               <a class="btn default btn-primary" href="{{url($files['smart-properties']['link'])}}" target="_blank">Learn More</a>

                                                                </a>
                                                            </li>

                                                  </ul>
                                           </div>
                                       </div>
                                 </div>
                           </div>
                       </div>
                       <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-start col-md-12 justify-content-md-start col-lg-12 justify-content-lg-start" style="background-color: #f7fafb">
                        <div class="card" style="width: 100%; border:none; background-color:#f7fafb ">
                            <div class="card-body">
                            <h2 class="card-title">{{$files['smart-properties']['title']}}</h2>
                            <p class="card-text"> {{$files['smart-properties']['title_first_line']}}{{$files['smart-properties']['title_second_line']}} </p>
                       
                          </div>
                     </div>
                 </div>
                  </div>
                  @else
                @endif
                @endif
            </div><!-- Ends here --><!-- This row is for the group elements -->
            <br/>
            <br/>
     </div> <!-- Container ends here -->
</div> <!-- Our smart group ends here -->
