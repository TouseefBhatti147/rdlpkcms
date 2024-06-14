@extends('layouts.admin')
@section('css')
<style>
.form-group.required label:after {
   content: " *";
   color: red;
   font-weight: bold;
 }
.img-container {
    width: 500px;
    height: 400px;
    display: block;
    position: relative;
    overflow: hidden;
}
.img-container embed {
    max-width: 100%;
    max-height: 100%;
}
    </style>
@endsection
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li><a href="{{url('/admin/home')}}">Home</a> <i class="fa fa-circle"></i> </li>
<li><a href="{{url('/admin/files')}}">Manage Files</a> <i class="fa fa-circle"></i> </li>
<li><a href="#">{{isset($FileEdit)?'Edit':'New'}} File</a> </li> </ul>
               <!-- END PAGE BREADCRUMB -->
               <!-- BEGIN PAGE BASE CONTENT -->
               <!-- BEGIN SAMPLE FORM PORTLET-->
                   <div class="portlet light bordered">
                           <div class="portlet-title">
                               <div class="caption">
                                   <i class="icon-settings font-dark"></i>
                                   <span class="caption-subject font-dark sbold uppercase">{{isset($FileEdit)?'Edit':'New'}} File</span>
                               </div>
                               <div style="float: right;" class="caption">
                                <a  class="btn btn-default" href="{{url('/admin/files')}}">
                           <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                            </a>
                               </div>
                           </div>
                           <div class="portlet-body form">
                             <div class="page-title">
                              @include('inc.messages')
                                   </div>
                            @if(isset($FileEdit))
                            {!! Form::model($FileEdit,['method'=>'put','files'=>true,'class'=>'form-horizontal']) !!}

                              @else
                             {!! Form::open(['action','filesController@create','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                             @endif
                                   <div class="form-body">

                                     <div class="form-group form-md-line-input">
                                        {!! Form::label("title","File Title",["class"=>"control-label col-md-2"]) !!}
                                        <div class="col-md-6">
                                         {!! Form::text("title",isset($FileEdit)?$FileEdit->title:null,["class"=>"form-control".($errors->has('title')?" is-invalid":"")
                                             ,"autofocus"
                                             ,"placeholder"=>"Enter Title here"
                                             ,"required"]) !!}
                                       </div>
                                   </div>
                               

                                  

                                     <div class="form-group form-md-line-input">
                                        {!! Form::label("alias","Alias (URL)",["class"=>"control-label col-md-2"]) !!}
                                         <div class="col-md-6">
                                                {!! Form::text("alias",isset($FileEdit)?$FileEdit->alias:null,["class"=>"form-control".($errors->has('alias')?" is-invalid":"")
                                                                                         ,"autofocus"
                                                                                         ,"placeholder"=>"Enter Alias "
                                                                                         ,"required",
                                                                                         isset($FileEdit)?"readonly":null
                                                                                         ]) !!}
                                      </div>

                                   </div>
                                   <div class="form-group form-md-line-input">
                                     {!! Form::label("category","Category",["class"=>"control-label col-md-2"]) !!}
                                     <div class="col-md-6">
                                    {{Form::select("category",[
                                        'logo' => 'Logo',
                                        'slider' => 'Slider',
                                        'partnersandassociates' => 'Partners $ Associates',
                                        'broucher'=>'Broucher',
                                           'newsletter'=>'News Letter',
                                           'ourgroup'=>'Our Group',
                                              'isocertificates'=>'Iso Certificates',
                                        'others'=>'Others' ]
                                        ,(isset($FileEdit)?$FileEdit->category:null) ,
                                                   [
                                                      "class" => "bs-select form-control",
                                                      "placeholder" => "Select a category"
                                                   ])
                                      }}
                                    </div>
                                   </div>


                                  {{-- <div class="form-group">
                                     {!! Form::label("status","Select Status",["class"=>"control-label col-md-2"]) !!}
                                   <div class="col-md-2">
                                    {{Form::select("status",[
                                              '1' => 'Enable',
                                              '0' => 'Disable' ]
                                   ,(isset($FileEdit)?$FileEdit->status:null) ,
                                     [
                                  "class" => "bs-select form-control",
                                   "placeholder" => "Select Status"
                                         ])
                                    }}
                                     </div>
                                   </div>  --}}

                               {{--  <div class="form-group">
                                      {!! Form::label("link","Link",["class"=>"control-label col-md-2"]) !!}
                                      <div class="col-md-6">
                                       {!! Form::text("link",isset($FileEdit)?$FileEdit->link:null,["class"=>"form-control".($errors->has('link')?" is-invalid":"")
                                           ,"autofocus"
                                           ,"placeholder"=>"Enter Url link here"
                                           ]) !!}
                                     </div>
                                   </div>  --}}

                                 {{--  @if(isset($FileEdit))
                                   <div class="form-group">
                                          {!! Form::label("link","Flipbook Path",["class"=>"control-label col-md-2"]) !!}
                                            <div class="col-md-1">
                                                   {!! Form::text("link",isset($FileEdit)?$FileEdit->link:null,["class"=>"form-control input-inline input-medium".($errors->has('title')?" is-invalid":"")
                                                   ,"autofocus"
                                                   ,"placeholder"=>"Enter Flipbook Path"
                                                   ]) !!}
                                            </div>
                                        </div>
                                   @endif  --}}


                                     <div class="form-group form-md-line-input">
                                              {!! Form::label("image","Select File",["class"=>"control-label col-md-2", "for"=>"exampleInputFile"]) !!}
                                       <div class="col-md-6">
                                           {!! Form::file("image",["class"=>"form-control"]) !!}

                                                <p class="help-block">
                                                {{isset($FileEdit)?'Please select a new file to replace the exsisting one':'Please select a file '}}
                                                </p>
                                        </div>

                                         </div>


                                         <div class="form-group ">
                                          {!! Form::label("status","Status",["class"=>"control-label  col-md-3 col-lg-2"]) !!}
                                          <div class="col-md-6">
                                           <div class="input-inline input-large">
                                            <div class="mt-radio-inline">
                                             <label class="mt-radio">{!! Form::radio('status', 1 ,isset($FileEdit)?$FileEdit->status==1?true:false : true ) !!}
                                              Enable <span></span></label>
                                             <label class="mt-radio">{!! Form::radio('status', 0, isset($FileEdit)?$FileEdit->status==0?true:false : false) !!}
                                              Disable <span></span></label>
                                           </div>
                                         </div>
                                        </div>
                                        </div>

                                         <div class="form-group">
                                           @if(isset($FileEdit))
                                               {!! Form::label("image","Current File",["class"=>"control-label col-md-2", "for"=>"exampleInputFile"]) !!}
                                               <div class="col-md-6 img-container">
                                                <embed src="{{asset(($FileEdit->image!='')?'uploads/'.$FileEdit->image:'images/nofile.png')}}" class="cover" />
                                                </div>
                                            @endif
                                         </div>



                                     {{--   <div class="form-actions">
                                                   <div class="caption">
                                         <h4>
                                           <strong class="caption-subject font-dark sbold uppercase"></strong>
                                         </h4>
                                       </div>
                                       <br>

                                     <div class="form-group">
                                       {!! Form::label("file","Flipbook zip File",["class"=>"control-label col-md-2", "for"=>"exampleInputFile"]) !!}
                                           <div class="col-md-2">
                                                {!! Form::file("file",["class"=>"form-control"]) !!}
                                            <p class="help-block">
                                           {{isset($FileEdit)?'Please select a new file to replace the exsisting one':'Please select a ZIP file '}}
                                           </p>
                                          </div>
                                     </div>
                                   </div> --}}
                                   <div class="form-actions">
                                    <div class="caption">

                                      <h4>
                                        <strong class="caption-subject font-dark sbold uppercase">Optional File Inputs</strong>
                                      </h4>
                                    </div>
                                    <br>
                                     
                                       {{--  adding second line for title --}}
                                       <div class="form-group form-md-line-input">
                                        {!! Form::label("title_first_line","File Input 1",["class"=>"control-label col-md-2"]) !!}
                                        <div class="col-md-6">
                                         {!! Form::text("title_first_line",isset($FileEdit)?$FileEdit->title_first_line:null,["class"=>"form-control".($errors->has('title_first_line')?" is-invalid":"")
                                             ,"autofocus"
                                             ,"placeholder"=>"Enter First line of title here"
                                           ]) !!}
                                        </div>
                                      </div>
                                       {{--  --}}
  
                                     {{--  adding second line for title --}}
                                     <div class="form-group form-md-line-input">
                                      {!! Form::label("title_second_line","File Input 2",["class"=>"control-label col-md-2"]) !!}
                                      <div class="col-md-6">
                                       {!! Form::text("title_second_line",isset($FileEdit)?$FileEdit->title_second_line:null,["class"=>"form-control".($errors->has('title_second_line')?" is-invalid":"")
                                           ,"autofocus"
                                           ,"placeholder"=>"Enter Seond line of title here"
                                         ]) !!}
                                      </div>
                                    </div>
                                     {{--  --}}
                                        
                                           
                                    </div>

                                 <div class="form-actions">
                                       <div class="row">
                                           <div class="col-md-offset-3 col-md-9">
                                             {{ Form::button('<span class="glyphicon glyphicon-save">&nbsp;Save</span>', ['type' => 'submit', 'name'=>'btnSave', 'class' =>'btn red btn-sm'] )  }}
                                             <button type="button" onclick="window.location='{{url('/admin/files')}}'" class="btn default btn-sm">Cancel</button>
                                           </div>
                                       </div>
                                   </div>
                           </div>
                    {{ Form::close() }}
                     </div>
                    </div>
                       <!-- END SAMPLE FORM PORTLET-->

               <!-- END PAGE BASE CONTENT -->
           </div>
           <!-- END CONTENT BODY -->
       </div>
       <!-- END CONTENT -->
@endsection
@section('scripts')
@if(isset($FileEdit))
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