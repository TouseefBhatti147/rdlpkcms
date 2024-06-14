@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
                  <ul class="page-breadcrumb breadcrumb">
                      <li>
                         <a href="{{url('/admin/home')}}">Home</a>
                          <i class="fa fa-circle"></i>
                      </li>
                          <li>
                         <a href="#">{{isset($VideoEdit)?'Edit':'New'}} Video</a>
                         </li>
                  </ul>
                  <!-- END PAGE BREADCRUMB -->
                  <!-- BEGIN PAGE BASE CONTENT -->
                         <div class="portlet light bordered">
                              <div class="portlet-title">
                             <div class="caption">
                                      <i class="icon-settings font-dark"></i>
                                      <span class="caption-subject font-dark sbold uppercase">{{isset($VideoEdit)?'Edit':'New'}} Video</span>
                                  </div>
                                  <div style="float: right;" class="caption">
                                   <a  class="btn btn-default" href="{{url('/admin/videos')}}">
                              <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                               </a>
                                  </div>
                              </div>
                              <div class="portlet-body form">
                                     <div class="page-title">
                                      @include('inc.messages')
                                     </div>
                                     @if(isset($VideoEdit))
                                     {!! Form::model($VideoEdit,['method'=>'put','files'=>true,'class'=>'form-horizontal']) !!}
                                     @else
                                     {!! Form::open(['action','videosController@create','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                     @endif
                                      <div class="form-body">
                                           <div class="form-group form-md-line-input">
                                            {!! Form::label("title","Title",["class"=>"control-label col-md-2"]) !!}
                                              <div class="col-md-6">
                                                     {!! Form::text("title",isset($VideoEdit)?$VideoEdit->title:null,["class"=>"form-control".($errors->has('title')?" is-invalid":"")
                                                                                              ,"autofocus"
                                                                                              ,'maxlength'=>61
                                                                                              ,"placeholder"=>"Enter Title Here"
                                                                                              ,"required"]) !!}
                                             </div>
                                         </div>

                                          <div class="form-group form-md-line-input">
                                             {!! Form::label("alias","Alias (URL)",["class"=>"control-label col-md-2"]) !!}
                                              <div class="col-md-6">
                                                     {!! Form::text("alias",isset($VideoEdit)?$VideoEdit->alias:null,["class"=>"form-control".($errors->has('alias')?" is-invalid":"")
                                                                                              ,"autofocus"
                                                                                              ,"placeholder"=>"Enter Alias Here"
                                                                                              ,"required",
                                                                                              isset($VideoEdit)?"readonly":null]) !!}
                                           </div>
                                        </div>


                                        <div class="form-group">
                                            {!! Form::label("status","Status",["class"=>"control-label  col-md-3 col-lg-2"]) !!}
                                            <div class="col-md-6">
                                             <div class="input-inline input-large">
                                              <div class="mt-radio-inline">
                                               <label class="mt-radio">{!! Form::radio('status', 1 ,isset($VideoEdit)?$VideoEdit->status==1?true:false : true ) !!}
                                                Enable <span></span></label>
                                               <label class="mt-radio">{!! Form::radio('status', 0, isset($VideoEdit)?$VideoEdit->status==0?true:false : false) !!}
                                                Disable <span></span></label>
                                             </div>
                                           </div>
                                          </div>
                                          </div>

                                         {{-- <div class="form-group">
                                                     {!! Form::label("status","Select Status",["class"=>"control-label col-md-2"]) !!}
                                            <div class="col-md-2">
                                                    {{Form::select("status",[
                                                              '1' => 'Enable',
                                                              '0' => 'Disable' ]
                                                   ,(isset($VideoEdit)?$VideoEdit->status:null) ,
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
                                                 <button type="button" onclick="window.location='{{url('/admin/videos')}}'" class="btn default btn-sm">Cancel</button>
                                              </div>
                                          </div>
                                      </div>
                              </div>
                                   {{ Form::close() }}
                        </div>
                       </div>

                  <!-- END PAGE BASE CONTENT -->
@endsection
@section('scripts')
@if(isset($VideoEdit))
@else
<script>
const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
const p = new RegExp(a.split('').join('|'), 'g')
$('#title').keyup(function() {
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