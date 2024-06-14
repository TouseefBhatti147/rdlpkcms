@extends('layouts.app')

@section('content')

 <div class="portlet light bordered">
                      <div class="portlet-title">



                    @if(Auth::user()->hasRole('admin'))

                    @elseif(Auth::user()->hasRole('user'))
                          <h3>{{ Auth::user()->name }} Dashboard </h3>
                    @endif

                      </div>
                      <div class="portlet-body">
                          <div class="tiles">
                <!--           <div class="tile  bg-yellow-saffron">
                                  <div class="corner"> </div>
                                  <div class="tile-body">
                                      <i class="fa fa-user"></i>
                                  </div>
                                  <div class="tile-object">
                                      <div class="name"> Members </div>
                                      <div class="number"> 452 </div>
                                  </div>
                              </div> -->
                              <a href="{{url('/user/widgets')}}">
                              <div class="tile bg-red-sunglo">
                                  <div class="tile-body">
                                      <i class="icon-puzzle"></i>
                                  </div>
                                 <div class="tile-object">
                                      <div class="name"> Widgets </div>
                                      <div class="number"> </div>
                                  </div>

                              </div>
                                  </a>
                            <a href="{{url('/user/pages')}}">
                              <div class="tile bg-green">
                                  <div class="tile-body">
                                      <i class="icon-layers"></i>
                                  </div>
                                  <div class="tile-object">
                                      <div class="name"> Pages </div>
                                      <div class="number"> </div>
                                  </div>
                              </div>
                            </a>
                                          <a href="#">
                              <div class="tile bg-blue-steel">
                                  <div class="tile-body">
                                      <i class="icon-docs"></i>
                                  </div>
                                  <div class="tile-object">
                                      <div class="name"> Files </div>
                                      <div class="number"> </div>
                                  </div>
                              </div>
                            </a>
                              <a href="#">
                              <div class="tile bg-red-sunglo">
                                  <div class="tile-body">
                                      <i class="icon-folder"></i>
                                  </div>
                                  <div class="tile-object">
                                      <div class="name"> Projects </div>
                                      <div class="number"> </div>
                                  </div>
                              </div>
                            </a>
                            <a href="#">
                              <div class="tile bg-green">
                                  <div class="tile-body">
                                      <i class="icon-globe"></i>
                                  </div>
                                  <div class="tile-object">
                                      <div class="name"> News </div>
                                      <div class="number"> </div>
                                  </div>
                              </div>
                            </a>
                              <a href="#">
                              <div class="tile bg-blue-steel">
                                  <div class="tile-body">
                                      <i class="icon-calendar"></i>
                                  </div>
                                  <div class="tile-object">
                                      <div class="name"> Events </div>
                                      <div class="number"> </div>
                                  </div>
                              </div>
                            </a>
                                        <a href="#">
                              <div class="tile bg-blue-steel">
                                  <div class="tile-body">
                                      <i class="icon-camera"></i>
                                  </div>
                                  <div class="tile-object">
                                      <div class="name"> Videos </div>
                                      <div class="number"> </div>
                                  </div>
                              </div>
                            </a>
                        
                          </div>
                      </div>
                  </div>
                  <!-- END PAGE BASE CONTENT -->
@endsection
