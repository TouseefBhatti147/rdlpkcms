@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
                  <ul class="page-breadcrumb breadcrumb">
                      <li>
                         <a href="{{url('/admin/home')}}">Home</a>
                          <i class="fa fa-circle"></i>
                      </li>
                          <li>
                       <a href="#">{{isset($UserEdit)?'Edit':'New'}} User</a>
                         </li>
                  </ul>
                  <!-- END PAGE BREADCRUMB -->
                  <!-- BEGIN PAGE BASE CONTENT -->
                         <div class="portlet light bordered">
                              <div class="portlet-title">
                             <div class="caption">
                                      <i class="icon-settings font-dark"></i>
                                  <span class="caption-subject font-dark sbold uppercase">{{isset($UserEdit)?'Edit':'New'}} User</span>
                                  </div>
                                  <div style="float: right;" class="caption">
                                   <a  class="btn btn-default" href="{{url('/admin/users')}}">
                              <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                               </a>
                                  </div>
                              </div>
                              <div class="portlet-body form">
                                     <div class="page-title">
                                      @include('inc.messages')
                                     </div>
                                   @if(isset($UserEdit))
                                   {!! Form::model($UserEdit,['method'=>'put','files'=>true,'class'=>'form-horizontal']) !!}
                                     @else
                                     {!! Form::open(['action','usersController@create','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                     @endif
                                      <div class="form-body">
                                           <div class="form-group form-md-line-input{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {!! Form::label("name","Enter Name",["class"=>"control-label col-md-2"]) !!}
                                              <div class="col-md-6">
                                                 
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-user"></i>
                                                            </span>
                                                            {!! Form::text("name",isset($UserEdit)?$UserEdit->name:null,["class"=>"form-control".($errors->has('name')?" is-invalid":"")
                                                                                                         ,"autofocus"
                                                                                                         ,"placeholder"=>"Enter Name Here"
                                                                                                         ,"required"]) !!} </div>
                                                   
                                                  </div>
                                                </div>
                                                    <div class="form-group form-md-line-input{{ $errors->has('email') ? ' has-error' : '' }}">
                                              {!! Form::label("email","Enter Email",["class"=>"control-label col-md-2"]) !!}
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </span>
                                                        {!! Form::email("email",isset($UserEdit)?$UserEdit->email:null,["class"=>"form-control".($errors->has('email')?" is-invalid":"")
                                                                                                       ,"autofocus"
                                                                                                       ,"placeholder"=>"Enter Email here"
                                                                                                       ,"required"]) !!}</div>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input{{ $errors->has('password') ? ' has-error' : '' }}">
                                                   {!! Form::label("password","Enter Password",["class"=>"control-label col-md-2"]) !!}
                                                                      <div class="col-md-6">
                                                                          <div class="input-group">
                                                                             <span class="input-group-addon">
                                                                              <i class="fa fa-user"></i>
                                                                            </span>
                                                                            {!! Form::text("password",null,["class"=>"form-control ".($errors->has('confirm_password')?" is-invalid":"")
                                                                                                                           ,"autofocus"
                                                                                                              ,"placeholder"=>"Enter Password here"

                                                                                                                           ,"required"]) !!}    </div>
                                                                      </div>
                                                                 </div>


                                                                 <div class="form-group form-md-line-input{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                                                        {!! Form::label("confirm_password","Confirm Password",["class"=>"control-label col-md-2"]) !!}
                                                                                           <div class="col-md-6">
                                                                                               <div class="input-group">
                                                                                                  <span class="input-group-addon">
                                                                                                   <i class="fa fa-user"></i>
                                                                                                 </span>
                                                                                                 {!! Form::text("confirm_password",null,["class"=>"form-control".($errors->has('confirm_password')?" is-invalid":"")
                                                                                                                                                ,"autofocus"
                                                                                                                                                ,"placeholder"=>"Confirm Password here"
                                                                                                                                                ,"required"]) !!}   </div>
                                                                                           </div>
                                                                                      </div>

                                      <div class="form-actions">
                                          <div class="row">
                                              <div class="col-md-offset-3 col-md-9">
                                                  {{ Form::button('<span class="glyphicon glyphicon-save">&nbsp;Save</span>', ['type' => 'submit', 'name'=>'btnSave', 'class' =>'btn red btn-sm'] )  }}
                                                 <button type="button" onclick="window.location='{{url('/admin/users')}}'" class="btn default btn-sm">Cancel</button>
                                              </div>
                                          </div>
                                      </div>
                              </div>
                                   {{ Form::close() }}
                        </div>
                       </div>

                  <!-- END PAGE BASE CONTENT -->
@endsection
