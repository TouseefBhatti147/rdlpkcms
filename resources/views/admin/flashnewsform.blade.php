@extends('layouts.admin')
@section('css')

@endsection
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li><a href="{{url('/admin/home')}}">Home</a><i class="fa fa-circle"></i></li>
<li><a href="{{url('/admin/flashnews')}}">Manage Flash News</a><i class="fa fa-circle"></i></li>
<li><a href="#">{{isset($AlertEdit)?'Edit':'New'}} Flash News</a></li></ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN FORM -->
<div class="portlet light bordered">
      <div class="portlet-title">
                <div class="caption">
                  <i class="icon-settings font-dark"></i>
                  <span class="caption-subject font-dark sbold uppercase">{{isset($AlertEdit)?'Edit':'New'}} Flash News</span>
                  </div>
                    <div class="actions">
                           <label class="btn btn-transparent light btn-outline  btn-circle btn-sm">
                                             <a  href="{{url('/admin/flashnews')}}">
                                                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                                             </a></label>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                  <div class="page-title">
                                      @include('inc.messages')
                                     </div>
                                     @if(isset($AlertEdit))
                                      {!! Form::model($AlertEdit,['method'=>'put','files'=>true,'class'=>'form-horizontal']) !!}
                                     @else
                                      {!! Form::open(['action','FlashNewsController@create','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                     @endif
                                  
                                        <div class="form-body">
                                           <!-- Title starts here -->
                                           
                                           <div class="row">
                                               <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                              {!! Form::label("title","Title",["class"=>"control-label  col-md-2 col-lg-2"]) !!}
                                               <div class="col-md-4 col-lg-4">
                                                 <div class="input-inline input-large">
                                                  {!! Form::text("title",isset($AlertEdit)?$AlertEdit->title:null,["class"=>"form-control".($errors->has('title')?" is-invalid":"")
                                                    ,"autofocus"
                                                    ,"placeholder"=>"Enter Title Here"
                                                    ]) !!}
                                                 </div>
                                               </div>

                                                 {!! Form::label("link","link",["class"=>"control-label  col-md-2 col-lg-2"]) !!}
                                                <div class="col-md-4 col-lg-4{{ $errors->has('link') ? ' has-error' : '' }}">
                                                  <div class="input-inline input-large">
                                                   {!! Form::text("link",isset($AlertEdit)?$AlertEdit->link:null,["class"=>"form-control".($errors->has('link')?" is-invalid":"")
                                                    ,"autofocus"
                                                    ,"placeholder"=>"Enter Link",
                                                    ]) !!}
                                                </div>
                                              </div>
                                             </div>
                                             <!-- row ends here -->
                                             </div>
                                            

                                             <div class="row">
                                               <div class="form-group">
                                               {!! Form::label("status","Status",["class"=>"control-label  col-md-2 col-lg-2"]) !!}
                                               <div class="col-md-4">
                                                <div class="input-inline input-large">
                                                 <div class="mt-radio-inline">
                                                  <label class="mt-radio">{!! Form::radio('alert_status', 1 ,isset($AlertEdit)?$AlertEdit->status==1?true:false : true ) !!}
                                                   Enable <span></span></label>
                                                  <label class="mt-radio">{!! Form::radio('alert_status', 0, isset($AlertEdit)?$AlertEdit->status==0?true:false : false) !!}
                                                   Disable <span></span></label>
                                                </div>
                                              </div>
                                             </div>
                                               @if(isset($AlertEdit))
                                                {!! Form::label("ordering","Ordering",["class"=>"control-label  col-md-2 col-lg-2"]) !!}
                                                <div class="col-md-4 col-lg-4{{ $errors->has('ordering') ? ' has-error' : '' }}">
                                                  <div class="input-inline input-large">
                                                  {!! Form::number("ordering",isset($AlertEdit)?$AlertEdit->ordering:null,["class"=>"form-control input-inline input-small".($errors->has('ordering')?" is-invalid":"")
                                                    ,"autofocus"
                                                    ,"placeholder"=>"Order",
                                                    ]) !!}
                                                </div>
                                              </div>
                                              @endif
                                            </div>

                                            </div>
                                    <!-- Radio buttons start here -->
                        
                                    <!-- Radio buttons end here -->
                                        
                                          <!-- Title ends here -->

                                         <!-- Form control for text area starts here -->
                                          <div class="row">
                                         <div class="form-group{{ $errors->has('alert_description') ? ' has-error' : '' }}">
                                              {!! Form::label("alert_description","Description",["class"=>"control-label col-md-2 col-lg-2"]) !!}
                                             <div class="col-md-9">
                                           {!! Form::textarea('alert_description',isset($AlertEdit)?$AlertEdit->description:null, ['id' => 'alert_description', 'rows' => 2, 'cols' => 88, 'style' => 'resize:none']) !!}
                                            </div>
                                          </div>
                                          </div>
                                        
                                      <!-- Form control for text area ends here -->
                                         
                                           <!-- date range picker starts here -->
                                      <div class="row">
                                          <div class="form-group">
                                                <label class="control-label col-md-2">Date</label>
                                                <div class="col-md-4">
                                                <div class="input-inline input-large">
                                                    <div class="input-group input-large date-picker input-daterange" data-date="2020-04-17" data-date-format="yyyy-mm-dd">
                                                    
                                                        <input type="text" value="{{isset($AlertEdit)? Carbon\Carbon::createFromFormat('Y-m-d', $AlertEdit->start_date)->format('Y-m-d') : null}}" class="form-control" name="start_date">
                                                        <span class="input-group-addon"> to </span>
                                                        <input type="text" value="{{isset($AlertEdit)?  Carbon\Carbon::createFromFormat('Y-m-d', $AlertEdit->end_date)->format('Y-m-d') : null}}" class="form-control" name="end_date"> </div>
                                                    <!-- /input-group -->
                                                    <span class="help-block"> Select date range </span>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                      <!-- date range picker ends here -->

                         
                                          <!-- form group for image upload starts here -->
                                          <div class="row">
                                          <div class="form-group">
                                            {!! Form::label("image","Select image",["class"=>"control-label col-md-2", "for"=>"exampleInputFile"]) !!}
                                           <div class="col-md-4">
  
                                             <img id="preview"
                                              src="{{asset((isset($AlertEdit) && $AlertEdit->image!='')?'uploads/'.$AlertEdit->image:'images/noimage.jpg')}}"
                                              height="200px" width="200px"/>
                                              {!! Form::file("image",["class"=>"form-control","style"=>"display:none",]) !!}
                                              <br/>
                                              <a href="javascript:changeProfile();">{{isset($AlertEdit)?'Change':'Add'}}</a> |
                                              <a style="color: red" href="javascript:removeImage()">Remove</a>
                                                    {{ Form::hidden('remove',0,['id'=>'remove'] ) }}
                                               </div>
                                             </div>
                                             </div>
                                            <!-- form group for image upload ends here-->
                                       
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                              <div class="col-md-offset-3 col-md-9">
                                                {{ Form::button('<span class="glyphicon glyphicon-save">&nbsp;Save</span>', ['type' => 'submit', 'name'=>'btnSave', 'class' =>'btn btn-sm red'] )  }}
                                                 <button type="button" onclick="window.location='{{url('/admin/flashnews')}}'" class="btn btn-sm default">Cancel</button>
                                              </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

<!-- END FORM -->
@endsection
@section('scripts')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
   CKEDITOR.replace('alert_description');
    </script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script>
    function changeProfile() {
             $('#image').click();
         }
         $('#image').change(function () {
             var imgPath = $(this)[0].value;
             var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
             if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                 readURL(this);
             else
               alert("Please select image file (jpg, jpeg, png).")
         });
         function readURL(input) {
             if (input.files && input.files[0]) {
                 var reader = new FileReader();
                 reader.readAsDataURL(input.files[0]);
                 reader.onload = function (e) {
                     $('#preview').attr('src', e.target.result);
                     $('#remove').val(0);
                 }
             }
         }
         function removeImage() {
             $('#preview').attr('src', '{{url('images/noimage.jpg')}}');
             $('#remove').val(1);
         }
</script>

@endsection
