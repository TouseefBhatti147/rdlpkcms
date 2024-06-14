<!-- Media Section Div Starts Here-->
<div class="media container-fluid" id="media-target">
  <div class="container">
      <div class="row">
       <div class="col-12 text-center text-md-left justify-content-sm-center col-md-4 justify-content-md-center media-section-heading">
             <h1> MEDIA </h1>
             <div class="rline">
                 <div class="line-white">
             </div>
           </div>
       </div>
     </div>
     <br>
    <!-- HTML for new row starts here -->
      <div class="row">
      <div class="col-12 col-sm-12  col-md-6  col-lg-3 media-column1">
         <div class="col-12 col-sm-12 col-md-12 col-lg-12 media-section-sub-heading">
             <h1> LATEST NEWS </h1>
         </div>
          <!-- HTML for the inner portion of the column starts here -->
              <div class="row">
                  @foreach($twonews as $news)
              <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-lg-center media-card">
        <!--HTML for card begins here -->
                  <div class="card media-section-card" style="">
                    <a href="{{url('/news/'.$news->alias)}}">  <img class="card-img-top" id="media-img-shadow" src="{{ asset('/uploads/'.$news->image)}}" height="120px" width="300px" style="object-fit: cover;" alt="Card image cap"></a>
                       <div class="card-body">
                      <span class="media-text d-flex  justify-content-center">{{$news->short_description}}</span>
                   <p class="media-date d-flex  justify-content-center">{{date('F, Y', strtotime($news->created_at))}}</p>
                       @if($loop->first)
                          @else
                            <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-lg-center index-button">
                                   <a href="{{url('/news')}}" class="btn btn-primary ">View More</a>
                                 </div>
                                @endif
                     </div>
                     @if($loop->first)
                     <div class="hl"></div>
                          @else
                              @endif
                     </div>

                 <!--HTML for card ends here -->
                 </div>
                 @endforeach
                  </div>
           <!-- HTML for the inner portion of the column ends here -->
      </div>
     <div class="col-12  col-sm-12  col-md-6  col-lg-3 media-column2">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12  media-section-sub-heading">
             <h1> EVENTS </h1>
      </div>
              <!-- HTML for the inner portion of the column starts here -->
               <div class="row">
               @foreach($twoevents as $events)
              <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-lg-center media-card">
        <!--HTML for card begins here -->
                  <div class="card media-section-card" style="">
                      <a href="{{url('/events/'.$events->alias)}}">  <img class="card-img-top" id="media-img-shadow" src="{{ asset('/uploads/'.$events->image)}}" height="120px" style="object-fit: cover;" width="300px" alt="Card image cap"></a>
                       <div class="card-body">
                      <span class="media-text d-flex  justify-content-center">{{$events->short_description}}</span>
                           <p class="media-date d-flex  justify-content-center"> {{date('F, Y', strtotime($events->event_date))}} </p>
                           @if($loop->first)
                            @else
                                <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-lg-center index-button">
                                       <a href="{{url('/events')}}" class="btn btn-primary ">View More</a>
                                     </div>
                                    @endif
                     </div>
                     @if($loop->first)
                     <div class="hl"></div>
                           @else
                              @endif
                     </div>
                      <!--HTML for card ends here -->
                     </div>
                      @endforeach

               </div>
           <!-- HTML for the inner portion of the column ends here -->
        </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3 media-column3">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12  media-section-sub-heading">
             <h1> VIDEOS </h1>
         </div>
         <!-- HTML for the inner portion of the column starts here -->
               <div class="row">
                     @foreach($twovideos as $videos)
              <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-lg-center media-card">
        <!--HTML for card begins here -->
                  <div class="card media-section-card" style="">
                       <a  data-toggle="modal" href="#{{$videos->alias}}">
                      <img class="card-img-top" id="media-img-shadow" src="https://img.youtube.com/vi/{{$videos->alias}}/hqdefault.jpg" style="object-fit: cover;" height="120px" width="300px" alt="Video 1 Alt here"></a>
                       <div class="card-body">
                      <span class="media-text d-flex  justify-content-center">{{$videos->title}}.</span>
                           <p class="media-date d-flex  justify-content-center"> {{date('F, Y', strtotime($videos->created_at))}} </p>

                         @if($loop->first)
                              @else
                                <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-lg-center index-button">
                                       <a href="{{url('/videos')}}" class="btn btn-primary ">View More</a>
                                     </div>
                                    @endif
                     </div>
                     @if($loop->first)
                     <div class="hl"></div>


                           @else
                              @endif
                 </div>

                 <!-- HTML for first modal ends here -->
                 <!--HTML for card ends here -->
                 <!--Modal code begins here -->
                      <div class="modal fade" id="{{$videos->alias}}" tabindex="-1" role="basic" aria-hidden="true">
                                             <div class="modal-dialog">
                                                 <div class="modal-content">
                                                     <div class="media-modal-header">
                                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                         <h4 class="media-modal-title">{{$videos->title}}</h4>
                                                         <hr style="width:100%;">
                                                     </div>
                                                     <div class="modal-body">  <!-- div for video column starts here-->
                                                           <div class="col-12 d-flex justify-content-center col-md-12 justify-content-md-center col-lg-12 justify-content-lg-start videoColumn">
                                                <!-- Right now keeping this div empty for time being-->
                                             <iframe width="554" height="396"  src="https://www.youtube.com/embed/{{$videos->alias}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                  </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                     </div>
                                                 </div>
                                                 <!-- /.modal-content -->
                                             </div>
                                             <!-- /.modal-dialog -->
                                         </div>
                                         <!-- /.modal -->

             </div>
               @endforeach

           </div>
           <!-- HTML for the inner portion of the column ends here -->
           </div>

         <!-- HTML for first modal beigns here -->





           <!-- Modal code ends here -->
           <div class="col-12 col-sm-12 col-md-6 col-lg-3 media-column4">
           <div class="col-12 col-sm-12 col-md-12 col-lg-12  media-section-sub-heading">
           <h1> NEWSLETTERS</h1>
                    </div>

          <div class="row"><!--Row of news letters starts here -->
               @foreach($newsletters as $newsl)
            <div class="col-6 d-flex justify-content-center col-sm-6 col-md-6 col-lg-6">
                <!--First Main column starts here -->
            <div class="card media-section-card" style="width: 8rem;">
                 <a href="{{url('/newsletters/'.$newsl->alias)}}">  <img class="card-img-top" id="media-img-shadow" src="{{asset('/uploads/'.$newsl->image)}}" style="object-fit: cover;" height="120px" width="120px" alt="Card image cap"></a>

                 <div class="card-body">

                   <span class="media-text d-flex  justify-content-center">{{$newsl->title}}.</span>
                        <p class="media-date d-flex  justify-content-center"> {{date('F, Y', strtotime($newsl->created_at))}} </p>
                     </div>
                   @if($loop->first)
                   <div class="hl"></div>
                          @else
                            @endif
              </div>
            </div>  <!--First Main column ends here -->
          <div class="col-6 col-sm-6 col-md-6 col-lg-6 newsletter-buttons">
                   <a class="btn-xs btn-primary" href="{{asset('/uploads/'.$newsl->pdf_file)}}"><i class="fas fa-download" aria-hidden="true" download></i>Download</a>
                    <br>
                    <br>
                   <a class="btn-xs btn-primary" href="{{url('/newsletters/'.$newsl->alias)}}"><i class="fas fa-eye" aria-hidden="true"></i>View Online</a>
               </div>  <!--Second Main column ends here -->
              <!--Row of news letters end here -->
              @if($loop->first)
                   @else


                  <div class="col-12 d-flex justify-content-center col-sm-12 justify-content-sm-center col-md-12 justify-content-md-center col-lg-12 justify-content-lg-center index-button-2">
                         <a href="{{url('/newsletters')}}" class="btn btn-primary ">View More</a>

               </div>

              @endif



    @endforeach
          </div>
          </div>
          </div>   <!-- HTML for new media section row ends here -->
      </div><!-- Container ends here -->
   </div> <!-- Media section container ends here -->
<!-- Media Section Div Ends Here-->