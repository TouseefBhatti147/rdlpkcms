@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li><a href="{{url('/admin/home')}}">Home</a><i class="fa fa-circle"></i> </li>
<li><a href="#">{{isset($SettingEdit)?'Edit':'New'}} Setting</a> </li></ul>

                   <!-- END PAGE BREADCRUMB -->

                   <!-- BEGIN PAGE BASE CONTENT -->

                   <!-- BEGIN SAMPLE FORM PORTLET-->
                           <div class="portlet light bordered">
                               <div class="portlet-title">
                                   <div class="caption">
                                       <i class="icon-settings font-dark"></i>
                                       <span class="caption-subject font-dark sbold uppercase">{{isset($SettingEdit)?'Edit':'New'}} Setting</span>
                                   </div>
                                 <div style="float: right;" class="caption">
                                    <a  class="btn btn-default" href="{{url('/admin/settings')}}">
                               <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                                </a>
                                   </div>
                               </div>
                               <div class="portlet-body form">
                                 <div class="page-title">
                                @include('inc.messages')
                                 </div>
                                 @if(isset($SettingEdit))
                                 {!! Form::model($SettingEdit,['method'=>'put','files'=>true,'class'=>'form-horizontal']) !!}
                                 @else
                                 {!! Form::open(['action','settingsController@create','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                 @endif

                                       <div class="form-body">
                                         <div class="form-group form-md-line-input">
                                          {!! Form::label("name","Title",["class"=>"control-label col-md-2"]) !!}
                                               <div class="col-md-6">

                                                   {!! Form::text("name",isset($SettingEdit)?$SettingEdit->name:null,["class"=>"form-control".($errors->has('name')?" is-invalid":"")
                                                                                                                                              ,"autofocus"
                                                                                                                                              ,"placeholder"=>"Enter Name"
                                                                                                                                              ,"required"]) !!}
                                               </div>
                                           </div>

                                           <div class="form-group form-md-line-input">
                                            {!! Form::label("alias","Alias (URL)",["class"=>"control-label col-md-2"]) !!}
                                             <div class="col-md-6">
                                                    {!! Form::text("alias",isset($SettingEdit)?$SettingEdit->alias:null,["class"=>"form-control".($errors->has('alias')?" is-invalid":"")
                                                                                             ,"autofocus"
                                                                                             ,"placeholder"=>"Enter Alias "
                                                                                             ,"required",
                                                                                              isset($SettingEdit)?"readonly":null]) !!}
                                          </div>
                                       </div>


                                           <div class="form-group form-md-line-input">
                                            {!! Form::label("value","Enter Value",["class"=>"control-label col-md-2"]) !!}
                                               <div class="col-md-6">
                                                 {!! Form::text("value",isset($SettingEdit)?$SettingEdit->value:null,["class"=>"form-control".($errors->has('value')?" is-invalid":"")
                                                                                            ,"autofocus"
                                                                                            ,"placeholder"=>"Enter Value"
                                                                                            ,"required"]) !!}
                                               </div>
                                           </div>

                                           <div class="form-group">
                                            {!! Form::label("status","Status",["class"=>"control-label  col-md-3 col-lg-2"]) !!}
                                            <div class="col-md-6">
                                             <div class="input-inline input-large">
                                              <div class="mt-radio-inline">
                                               <label class="mt-radio">{!! Form::radio('status', 1 ,isset($SettingEdit)?$SettingEdit->status==1?true:false : true ) !!}
                                                Enable <span></span></label>
                                               <label class="mt-radio">{!! Form::radio('status', 0, isset($SettingEdit)?$SettingEdit->status==0?true:false : false) !!}
                                                Disable <span></span></label>
                                             </div>
                                           </div>
                                          </div>
                                          </div>

                                            {{--<div class="form-group">
                                                      {!! Form::label("status","Select Status",["class"=>"control-label col-md-2"]) !!}
                                             <div class="col-md-2">
                                                     {{Form::select("status",[
                                                               '1' => 'Enable',
                                                               '0' => 'Disable' ]
                                                    ,(isset($SettingEdit)?$SettingEdit->status:null) ,
                                                      [
                                                            "class" => "bs-select form-control",
                                                              "placeholder" => "Select Status"
                                                          ])
                                                     }}
                                                      </div>
                                                 </div> --}}


                                       <div class="form-actions">
                                           <div class="row">
                                               <div class="col-md-offset-3 col-md-9">
                                                 {{ Form::button('<span class="glyphicon glyphicon-save">&nbsp;Save</span>', ['type' => 'submit', 'name'=>'btnSave', 'class' =>'btn red btn-sm'] )  }}
                                             <button type="button" onclick="window.location='{{url('/admin/settings')}}'" class="btn default btn-sm">Cancel</button>
                                               </div>
                                           </div>
                                       </div>
                               </div>
                          {{ Form::close() }}
                         </div>
                        </div>
                           <!-- END SAMPLE FORM PORTLET-->

                   <!-- END PAGE BASE CONTENT -->
@endsection
@section('scripts')
@if(isset($SettingEdit))
@else
<script>
const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
const p = new RegExp(a.split('').join('|'), 'g')
$('#name').keyup(function() {
  $('#alias').val(this.value
  .toLowerCase()
  .replace(/\s+/g, '-')// Replace spaces with -
  .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
  .replace(/&/g, '-and-') // Replace & with 'and'
  .replace(/[^\w\-]+/g, '') // Remove all non-word characters
  .replace(/\-\-+/g, '-') // Replace multiple - with single -
  .replace(/^-+/, '') // Trim - from start of text
  );
});
</script>
@endif
@endsection