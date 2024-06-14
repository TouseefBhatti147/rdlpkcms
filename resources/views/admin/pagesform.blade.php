@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li><a href="{{url('/admin/home')}}">Home</a><i class="fa fa-circle"></i></li>
<li><a href="{{url('/admin/pages')}}">Manage Pages</a> <i class="fa fa-circle"></i></li>
<li><a href="#">{{isset($PageEdit)?'Edit':'New'}} Page</a></li> </ul>
<!-- END PAGE BREADCRUMB -->
                   <!-- BEGIN PAGE BASE CONTENT -->
                   <!-- BEGIN SAMPLE FORM PORTLET-->
                           <div class="portlet light bordered">
                               <div class="portlet-title">
                                   <div class="caption">
                                       <i class="icon-settings font-dark"></i>
                               <span class="caption-subject font-dark sbold uppercase">{{isset($PageEdit)?'Edit':'New'}} Page</span>
                                   </div>
                                    <div style="float: right;" class="caption">
                                    <a  class="btn btn-default" href="{{url('/admin/pages')}}">
                               <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                                </a>
                                   </div>
                               </div>
                               <div class="portlet-body form">
                                 <div class="page-title">
                               @include('inc.messages')
                                    </div>
                               @if(isset($PageEdit))
                               {!! Form::model($PageEdit,['method'=>'put','files'=>true,'class'=>'form-horizontal']) !!}
                                 @else
                               {!! Form::open(['action','pagesController@create','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                               @endif
                                       <div class="form-body">

                                       <div class="form-group form-md-line-input">
                                               {!! Form::label("title","Title",["class"=>"control-label col-md-2"]) !!}
                                                <div class="col-md-6">
                                                      {!! Form::text("title",isset($PageEdit)?$PageEdit->title:null,["class"=>"form-control".($errors->has('title')?" is-invalid":"")
                                                                                              ,"autofocus"
                                                                                              ,"placeholder"=>"Enter Title here"
                                                                                              ,"required"]) !!}

                                               </div>

                                              </div>
                                               <div class="form-group form-md-line-input">
                                                 {!! Form::label("alias","Alias (URL)",["class"=>"control-label col-md-2"]) !!}
                                                <div class="col-md-6">
                                                         {!! Form::text("alias",isset($PageEdit)?$PageEdit->alias:null,["class"=>"form-control".($errors->has('alias')?" is-invalid":"")
                                                                                              ,"autofocus"
                                                                                              ,"placeholder"=>"Enter Alias here"
                                                                                              ,"required",
                                                                                              isset($PageEdit)?"readonly":null]) !!}
                                                </div>
                                               </div>



                                 
                                             


                                           {{--   <div class="form-group">
                                               {!! Form::label("status","Select Status",["class"=>"control-label col-md-2"]) !!}
                                              <div class="col-md-6">
                                                      {{Form::select("status",[
                                                                '1' => 'Enable',
                                                                '0' => 'Disable' ]
                                                     ,(isset($ProjectEdit)?$ProjectEdit->status:null) ,
                                                       [
                                                    "class" => "bs-select form-control",
                                                     "placeholder" => "Select Status"
                                                           ])
                                                      }}
                                                       </div> 
                                                  </div>   --}}


                                             <div class="form-group form-md-line-input">
                                               {!! Form::label("website","Website",["class"=>"control-label col-md-2"]) !!}
                                                <div class="col-md-6">
                                               {!! Form::text("website",isset($PageEdit)?$PageEdit->website:null,["class"=>"form-control".($errors->has('website')?" is-invalid":"")
                                                                                              ,"autofocus"
                                                                                              ,"placeholder"=>"Enter Website here"
                                                                                              ,"required"]) !!}

                                                </div>
                                             </div>

                                             <div class="form-group">
                                              {!! Form::label("status","Status",["class"=>"control-label  col-md-3 col-lg-2"]) !!}
                                              <div class="col-md-6">
                                               <div class="input-inline input-large">
                                                <div class="mt-radio-inline">
                                                 <label class="mt-radio">{!! Form::radio('status', 1 ,isset($ProjectEdit)?$ProjectEdit->status==1?true:false : true ) !!}
                                                  Enable <span></span></label>
                                                 <label class="mt-radio">{!! Form::radio('status', 0, isset($ProjectEdit)?$ProjectEdit->status==0?true:false : false) !!}
                                                  Disable <span></span></label>
                                               </div>
                                             </div>
                                            </div>
                                            </div>


                                            <div class="form-group">
                                             {!! Form::label("description","Enter Description",["class"=>"control-label col-md-2"]) !!}
                                               <div class="col-md-9">
                                                  {!! Form::textarea('description', null, ['id' => 'description', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) !!}
                                              <script>
                                                 CKEDITOR.replace('description');
                                                  </script>
                                             </div>
                                            </div>

                                       <!-- Code for image upload is placed here -->
                                        <div class="form-group ">
                                          {!! Form::label("image","Select image",["class"=>"control-label col-md-2", "for"=>"exampleInputFile"]) !!}
                                         <div class="col-md-9">

                                           <img id="preview"
                                            src="{{asset((isset($PageEdit) && $PageEdit->image!='')?'uploads/'.$PageEdit->image:'images/noimage.jpg')}}"
                                            height="200px" width="200px"/>
                                            {!! Form::file("image",["class"=>"form-control","style"=>"display:none"]) !!}
                                            <br/>
                                            <a href="javascript:changeProfile();">{{isset($PageEdit)?'Change':'Add'}}</a> |
                                            <a style="color: red" href="javascript:removeImage()">Remove</a>
                                            {{ Form::hidden('remove',0 ) }}

                                             </div>
                                           </div>
                                           <div class="form-actions">
                                         <div class="caption">

                                           <h4>
                                             <strong class="caption-subject font-dark sbold uppercase">SEO</strong>
                                           </h4>
                                         </div>
                                         <br>
                                         <div class="form-group form-md-line-input">
                                                {!! Form::label("meta_title","Meta Title",["class"=>"control-label col-md-2"]) !!}
                                                  <div class="col-md-6">
                                                         {!! Form::text("meta_title",isset($PageEdit)?$PageEdit->meta_title:null,["class"=>"form-control".($errors->has('title')?" is-invalid":"")
                                                         ,"autofocus"
                                                         ,"placeholder"=>"Enter meta Title here"
                                                         ]) !!}
                                                  </div>
                                               </div>
                                               <div class="form-group form-md-line-input">
                                               {!! Form::label("meta_description","Meta Description",["class"=>"control-label col-md-2"]) !!}
                                                   <div class="col-md-6">
                                                 {!! Form::textarea('meta_description', isset($PageEdit)?$PageEdit->meta_description:null, [ 'class'=>'form-control','rows' => 2, 'cols' => 88, 'style' => 'resize:none','placeholder'=>'Enter Meta Description']) !!}
                                                 </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                {!! Form::label("meta_keywords","Meta Keywords",["class"=>"control-label col-md-2"]) !!}
                                                    <div class="col-md-6">
                                                  {!! Form::textarea('meta_keywords', isset($PageEdit)?$PageEdit->meta_keywords:null, [ 'class'=>'form-control','rows' => 2, 'cols' => 88, 'style' => 'resize:none','placeholder'=>'Enter Meta Keywords']) !!}
                                                  </div>
                                                 </div>
                                         </div>
                                       <div class="form-actions">
                                           <div class="row">
                                               <div class="col-md-offset-3 col-md-9">
                                                   {{ Form::button('<span class="glyphicon glyphicon-save">&nbsp;Save</span>', ['type' => 'submit', 'name'=>'btnSave', 'class' =>'btn red btn-sm'] )  }}
                                                 <button type="button" onclick="window.location='{{url('/admin/pages')}}'" class="btn default btn-sm">Cancel</button>
                                               </div>
                                           </div>
                                       </div>
                               </div>
                            {{ Form::close() }}
                         </div>
                        </div>
                           <!-- END SAMPLE FORM PORTLET-->
@endsection
@section('scripts')
@if(isset($PageEdit))
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