@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
  <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{url('/admin/home')}}">Home</a>
            <i class="fa fa-circle"></i>
      </li>
  <li>
            <a href="{{url('/admin/news')}}">Manage News</a>
            <i class="fa fa-circle"></i>
    </li>
    <li>
            <a href="#">{{isset($NewsEdit)?'Edit':'New'}} News</a>
  </li>
  </ul>
              <!-- END PAGE BREADCRUMB -->
              <!-- BEGIN PAGE BASE CONTENT -->
                     <div class="portlet light bordered">
                          <div class="portlet-title">
                              <div class="caption">
                                  <i class="icon-settings font-dark"></i>
                                  <span class="caption-subject font-dark sbold uppercase">{{isset($NewsEdit)?'Edit':'New'}} News</span>
                              </div>
                               <div style="float: right;" class="caption">
                               <a  class="btn btn-default" href="{{url('/admin/news')}}">
                          <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                           </a>
                              </div>
                          </div>
                          <div class="portlet-body form">
                                 <div class="page-title">
                                    @include('inc.messages')
                                     </div>
                                   @if(isset($NewsEdit))
                                   {!! Form::model($NewsEdit,['method'=>'put','files'=>true,'class'=>'form-horizontal']) !!}
                                   @else
                                   {!! Form::open(['action','newsController@create','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                   @endif

                                  <div class="form-body">
                                   <div class="form-group form-md-line-input">
                                          {!! Form::label("title","Title",["class"=>"control-label col-md-2"]) !!}
                                            <div class="col-md-6">
                                                   {!! Form::text("title",isset($NewsEdit)?$NewsEdit->title:null,["class"=>"form-control".($errors->has('title')?" is-invalid":"")
                                                   ,"autofocus"
                                                   ,"placeholder"=>"Enter Title here"
                                                   ,"required"]) !!}
                                            </div>

                                          </div>


                                          <div class="form-group form-md-line-input">
                                            {!! Form::label("alias","Alias (URL)",["class"=>"control-label col-md-2"]) !!}
                                              <div class="col-md-6">
                                               {!! Form::text("alias",isset($NewsEdit)?$NewsEdit->alias:null,["class"=>"form-control".($errors->has('alias')?" is-invalid":"")
                                                       ,"autofocus"
                                                       ,"placeholder"=>"Enter Alias here"
                                                       ,"required",
                                                       isset($NewsEdit)?"readonly":null]) !!}

                                              </div>
                                          </div>

                                   {{--     <div class="form-group">
                                         {!! Form::label("link","Enter Link",["class"=>"control-label col-md-2"]) !!}
                                          <div class="col-md-9">
                                              {!! Form::text("link",isset($NewsEdit)?$NewsEdit->link:null,["class"=>"form-control input-inline input-medium".($errors->has('link')?" is-invalid":"")
                                                   ,"autofocus"
                                                   ,"placeholder"=>"Enter Link here"
                                                   ,"required"]) !!}

                                          </div>
                                      </div> --}}

                                 
                                 
                                      <div class="form-group">
                                        {!! Form::label("status","Status",["class"=>"control-label  col-md-3 col-lg-2"]) !!}
                                        <div class="col-md-6">
                                         <div class="input-inline input-large">
                                          <div class="mt-radio-inline">
                                           <label class="mt-radio">{!! Form::radio('status', 1 ,isset($NewsEdit)?$NewsEdit->status==1?true:false : true ) !!}
                                            Enable <span></span></label>
                                           <label class="mt-radio">{!! Form::radio('status', 0, isset($NewsEdit)?$NewsEdit->status==0?true:false : false) !!}
                                            Disable <span></span></label>
                                         </div>
                                       </div>
                                      </div>
                                      </div>
                                 
                                       <div class="form-group form-md-line-input">
                                      {!! Form::label("short_description","Short Description",["class"=>"control-label col-md-2"]) !!}
                                          <div class="col-md-6">
                                        {!! Form::textarea('short_description', isset($NewsEdit)?$NewsEdit->short_description:null, [ 'class'=>'form-control','rows' => 2, 'cols' => 88,  'maxlength'=>60, 'style' => 'resize:none','placeholder'=>'Enter Short Description']) !!}
                                        </div>
                                       </div>
                                      {{-- 
                                       <div class="form-group">
                                              {!! Form::label("status","Select Status",["class"=>"control-label col-md-2"]) !!}
                                              <div class="col-md-2">
                                             {{Form::select("status",[
                                                 '1' => 'Enable',
                                                 '0' => 'Disable' ]
                                                 ,(isset($NewsEdit)?$NewsEdit->status:null) ,
                                                            [
                                                               "class" => "bs-select form-control",
                                                               "placeholder" => "Select Status"
                                                            ])
                                               }}
                                             </div>
                                       </div>  --}}


                                      <div class="form-group">
                                           {!! Form::label("description","Description",["class"=>"control-label col-md-2"]) !!}
                                          <div class="col-md-9">

                                         {!! Form::textarea('description', isset($NewsEdit)?$NewsEdit->description:null, ['id' => 'description', 'rows' => 2, 'cols' => 88, 'style' => 'resize:none']) !!}
                                         <script>
                                            CKEDITOR.replace('description');
                                             </script>
                                        </div>
                                       </div>

                                       <!-- Code for image upload is placed here -->
                                        <div class="form-group ">
                                          {!! Form::label("image","image",["class"=>"control-label col-md-2", "for"=>"exampleInputFile"]) !!}
                                         <div class="col-md-9">

                                           <img id="preview"
                                            src="{{asset((isset($NewsEdit) && $NewsEdit->image!='')?'uploads/'.$NewsEdit->image:'images/noimage.jpg')}}"
                                            height="200px" width="200px"/>
                                            {!! Form::file("image",["class"=>"form-control","style"=>"display:none",]) !!}
                                            <br/>
                                            <a href="javascript:changeProfile();">{{isset($NewsEdit)?'Change':'Add'}}</a> |
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
                                                         {!! Form::text("meta_title",isset($NewsEdit)?$NewsEdit->meta_title:null,["class"=>"form-control".($errors->has('title')?" is-invalid":"")
                                                         ,"autofocus"
                                                         ,"placeholder"=>"Enter meta Title here"
                                                         ]) !!}
                                                  </div>
                                               </div>
                                               <div class="form-group form-md-line-input">
                                               {!! Form::label("meta_title","Meta Description",["class"=>"control-label col-md-2"]) !!}
                                                   <div class="col-md-6">
                                                 {!! Form::textarea('meta_description', isset($NewsEdit)?$NewsEdit->meta_description:null, [ 'class'=>'form-control','rows' => 2, 'cols' => 88, 'style' => 'resize:none','placeholder'=>'Enter Meta Description']) !!}
                                                 </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                {!! Form::label("meta_title","Meta Keywords",["class"=>"control-label col-md-2"]) !!}
                                                    <div class="col-md-6">
                                                  {!! Form::textarea('meta_keywords', isset($NewsEdit)?$NewsEdit->meta_keywords:null, [ 'class'=>'form-control','rows' => 2, 'cols' => 88, 'style' => 'resize:none','placeholder'=>'Enter Meta Keywords']) !!}
                                                  </div>
                                                 </div>
                                         </div>
                                  <div class="form-actions">
                                      <div class="row">
                                          <div class="col-md-offset-3 col-md-9">
                                            {{ Form::button('<span class="glyphicon glyphicon-save">&nbsp;Save</span>', ['type' => 'submit', 'name'=>'btnSave', 'class' =>'btn red btn-sm'] )  }}
                                                 <button type="button" onclick="window.location='{{url('/admin/news')}}'" class="btn default btn-sm">Cancel</button>
                                          </div>
                                      </div>
                                  </div>
                          </div>
                       {{ Form::close() }}
                    </div>
                   </div>
@endsection


@section('scripts')
@if(isset($NewsEdit))
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