@extends('layouts.admin')

@section('content')


        
             <div class="row">
             <div class="col-md-8 pull-left">
            <div class="card">
                <div class="card-header"><h3>  @if(Auth::guard('admin')->check())
                    <h3> {{ Auth::user()->name }} Dashboard </h3>
                 @else
                 <h3> User Dashboard </h3>
                 @endif</h3><br></div>

                <div class="card-body">
          <!-- No message -->         
                </div>
            </div>
            </div>
           </div>
          

                         <div class="row">
                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                                 <a class="dashboard-stat dashboard-stat-v2 blue" href="{{url('/admin/flashnews')}}">
                                   <div class="visual">
                                   <i class="icon-bell"></i>
                                  </div>
                                  <div class="details">
                                   <div class="number">
                                   <span data-counter="counterup" data-value="{{$flashnewscount}}"></span>
                                   </div>
                                 <div class="desc">Flash News </div>
                               </div>
                            </a>
                           </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                     <a class="dashboard-stat dashboard-stat-v2 red " href="{{url('/admin/users')}}">
                                           <div class="visual">
                                            <i class="fa fa-user"></i>
                                            </div>
                                           <div class="details">
                                            <div class="number">
                                            <span data-counter="counterup" data-value="{{$userscount}}"></span>
                                            </div>
                                             <div class="desc"> Users</div>
                                            </div>
                                         </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="{{url('/admin/pages')}}">
                                                                <div class="visual">
                                                             <i class="icon-layers"></i>
                                                            </div>
                                                           <div class="details">
                                                            <div class="number">
                                                            <span data-counter="counterup" data-value="{{$pagescount}}"></span>
                                                            </div>
                                                            <div class="desc">  Pages </div>
                                                             </div></a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="{{('/admin/files')}}">
                                                  <div class="visual">
                                               <i class="icon-docs"></i>
                                             </div>
                                               <div class="details">
                                               <div class="number">
                                                <span data-counter="counterup" data-value="{{$filescount}}"></span>
                                             </div>
                                             <div class="desc">  Files </div>
                                            </div>
                                       </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{url('/admin/projects')}}">
                                                          <div class="visual">
                                                    <i class="icon-folder"></i>
                                                          </div>
                                                          <div class="details">
                                                              <div class="number">
                                                                  <span data-counter="counterup" data-value="{{$projectscount}}"></span>
                                                              </div>
                                                              <div class="desc"> Projects </div>
                                                          </div>
                                                      </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="{{url('/admin/news')}}">
                                                                                  <div class="visual">
                                                                              <i class="icon-globe"></i>
                                                                                  </div>
                                                                                  <div class="details">
                                                                                      <div class="number">
                                                                                          <span data-counter="counterup" data-value="{{$newscount}}"></span>
                                                                                      </div>
                                                                                      <div class="desc"> News </div>
                                                                                  </div>
                                                                              </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="{{url('/admin/events')}}">
                                   <div class="visual">
                                    <i class="icon-calendar"></i>
                                     </div>
                                    <div class="details">
                                    <div class="number">
                                    <span data-counter="counterup" data-value="{{$eventscount}}"></span>
                                    </div>
                                    <div class="desc"> Events </div>
                                     </div>
                                    </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="{{url('/admin/newsletters')}}">
                                 <div class="visual">
                                   <i class="icon-envelope"></i>
                                    </div>
                                    <div class="details">
                                    <div class="number">
                                    <span data-counter="counterup" data-value="{{$newsletterscount}}"></span>
                                    </div>
                                    <div class="desc">  Newsletters </div>
                                    </div>
                                    </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="{{url('/admin/offices')}}">
                                                          <div class="visual">
                                                <i class="icon-briefcase"></i>
                                                          </div>
                                                          <div class="details">
                                                              <div class="number">
                                                                  <span data-counter="counterup" data-value="{{$officescount}}"></span>
                                                              </div>
                                                              <div class="desc">  Offices </div>
                                                          </div>
                                                      </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 red " href="{{url('/admin/videos')}}">
                                                          <div class="visual">
                                                      <i class="icon-camera"></i>
                                                          </div>
                                                          <div class="details">
                                                              <div class="number">
                                                                  <span data-counter="counterup" data-value="{{$videoscount}}"></span>
                                                              </div>
                                                              <div class="desc"> Videos </div>
                                                          </div>
                                                      </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{url('/admin/widgets')}}">
                                                          <div class="visual">
                                                                <i class="icon-puzzle"></i>
                                                          </div>
                                                          <div class="details">
                                                              <div class="number">
                                                                  <span data-counter="counterup" data-value="{{$widgetscount}}"></span>
                                                              </div>
                                                              <div class="desc"> Widgets </div>
                                                          </div>
                                                      </a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="{{url('/admin/settings')}}">
                                                                                  <div class="visual">
                                                                              <i class="fa fa-cogs"></i>
                                                                                  </div>
                                                                                  <div class="details">
                                                                                      <div class="number">
                                                                                          <span data-counter="counterup" data-value="{{$settingscount}}"></span>
                                                                                      </div>
                                                                                      <div class="desc">Settings </div>
                                                                                  </div>
                                                                              </a>
                            </div>
                        </div>
      <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->

@endsection


