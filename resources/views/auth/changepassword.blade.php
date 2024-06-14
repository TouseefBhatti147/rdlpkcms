@extends('layouts.admin')
@section('content')

<!-- BEGIN PAGE BASE CONTENT -->
       <div class="portlet light bordered">
            <div class="portlet-title">
           <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">Change Password</span>
                </div>
                <div style="float: right;" class="caption">
                 <a  class="btn btn-default" href="{{('/admin/')}}">
            <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
             </a>
                </div>
            </div>
            <div class="portlet-body form">
                   <div class="page-title">
                    @include('inc.messages')
                   </div>
                   {!! Form::open(['action','ChangeController@changepassword','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data']) !!}
                            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                <label for="current_password" class="col-md-3 control-label">Current Password</label>
                                <div class="col-md-5">
                                    <input id="current_password" type="password" class="form-control input-inline input-large" name="current_password" required>
                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="new_password" class="col-md-3 control-label">New Password</label>
                                <div class="col-md-5">
                                    <input id="new_password" type="password" class="form-control input-inline input-large" name="new_password" required>
                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new_confirm_password" class="col-md-3 control-label">Confirm New Password</label>
                                <div class="col-md-5">
                                    <input id="new_confirm_password" type="password" class="form-control input-inline input-large" name="new_confirm_password" required>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        {{ Form::button('<span class="glyphicon glyphicon-lock">&nbsp;Change</span>', ['type' => 'submit', 'name'=>'btnSave', 'class' =>'btn red btn-sm'] )  }}
                                      <button type="button" onclick="window.location='{{('/admin/')}}'" class="btn default btn-sm">Cancel</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                 {{ Form::close() }}
              </div>
             </div>
                <!-- END SAMPLE FORM PORTLET-->
@endsection
