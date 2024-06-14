@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li><a href="{{url('/admin/home')}}">Home</a><i class="fa fa-circle"></i> </li>
<li> <a href="{{url('/admin/offices')}}">Manage Offices</a> <i class="fa fa-circle"></i>   </li>
<li><a href="#">{{isset($OfficeEdit)?'Edit':'New'}} Office</a>   </li>
</ul>
                <!-- END PAGE BREADCRUMB -->
                  <!-- BEGIN PAGE BASE CONTENT -->
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">{{isset($OfficeEdit)?'Edit':'New'}} Office</span>
                                </div>
                                 <div style="float: right;" class="caption">
                                 <a  class="btn btn-default" href="{{url('/admin/offices')}}">
                            <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                             </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                     <div class="page-title">
                                @include('inc.messages')
                                     </div>
                                     @if(isset($OfficeEdit))
                               {!! Form::model($OfficeEdit,['method'=>'put','files'=>true,'class'=>'horizontal-form']) !!}
                                 @else
                               {!! Form::open(['action','officesController@create','class'=>'horizontal-form','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                               @endif
                               <div class="form-body">


                                                             {{-- First row starts here --}}
                                                              <div class="row">
                                                              <div class="col-md-5 col-md-offset-1">
                                                                    <div class="form-group {{ $errors->has('office_title') ? ' has-error' : '' }}">
                                                                    {!! Form::label("office_title","Enter office title",["class"=>"control-label"]) !!}
                                                                    {!! Form::text("office_title",isset($OfficeEdit)?$OfficeEdit->office_title:null,["class"=>"form-control".($errors->has('office_title')?" is-invalid":"")
                                                                   ,"autofocus"
                                                                   ,"placeholder"=>""
                                                                   ,"required"]) !!}
                                                                  </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                  <div class="form-group {{ $errors->has('alias') ? ' has-error' : '' }}">
                                                                  {!! Form::label("alias","Alias (Auto Generated)",["class"=>"control-label"]) !!}
                                                                  {!! Form::text("alias",isset($OfficeEdit)?$OfficeEdit->alias:null,["class"=>"form-control".($errors->has('alias')?" is-invalid":"")
                                                                                                    ,"autofocus"
                                                                                                    ,"placeholder"=>""
                                                                                                    ,"required",
                                                                                                     isset($OfficeEdit)?"readonly":null]) !!}
                                                                </div>
                                                              </div>
                                                              
                                                            </div>
                                                            {{-- First row ends here --}}

    
                                                          {{-- Second row starts here --}}
                                                          <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                              <div class="form-group">
                                                               {!! Form::label("address","Enter Address",["class"=>"control-label"]) !!}
                                                               {!! Form::textarea('address', isset($OfficeEdit)?$OfficeEdit->address:null, [ 'class'=>'form-control','rows' => 2, 'cols' => 88, 'style' => 'resize:none','placeholder'=>'Enter Address']) !!}
                                                               </div>
                                                            </div>
                                                            </div> 
                                                          {{-- Second row ends here --}}

                                                         



                                                       {{-- Third row starts here --}}
                                                           <div class="row">
                                                              <div class="col-md-5 col-md-offset-1">
                                                                    <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                                                    {!! Form::label("category","Select Ofiice Category",["class"=>"control-label"]) !!}
                                                                    {{Form::select("category",[
                                                                    'head_office' => 'Head Office',
                                                                    'corporate_office'=>'Corporate Office',
                                                                    'sales_and_marketing' => 'Sales & Marketing Office',
                                                                    'global_office'=>'Global Office'
                                                                     ]
                                                                    ,(isset($OfficeEdit)?$OfficeEdit->category:null) ,
                                                                    [
                                                                    "class" => "bs-select form-control",
                                                                    "placeholder" => "Select Office category"
                                                                     ])
                                                                     }}
                                                                  </div>
                                                                </div>

                                                                <!--/span-->
                                                                <div class="col-md-5">
                                                                  <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                                                  {!! Form::label("city","Enter city",["class"=>"control-label"]) !!}
                                                                  {!! Form::text("city",isset($OfficeEdit)?$OfficeEdit->city:null,["class"=>"form-control".($errors->has('city')?" is-invalid":"")
                                                                   ,"autofocus"
                                                                   ,"placeholder"=>""
                                                                    ]) !!}
                                                                    </div>
                                                              </div>
                                                            </div>
                                                            {{-- Third row ends here --}}

                                                               {{-- Fourth row starts here --}}
                                                               <div class="row">
                                                                <!--/span-->
                                                                <div class="col-md-5 col-md-offset-1"">
                                                                  <div class="form-group{{ $errors->has('telephone_1') ? ' has-error' : '' }}">
                                                                  {!! Form::label("telephone_1","Enter First Telephone #",["class"=>"control-label"]) !!}
                                                                  {!! Form::text("telephone_1",isset($OfficeEdit)?$OfficeEdit->telephone_1:null,["class"=>"form-control".($errors->has('telephone_1')?" is-invalid":"")
                                                                 ,"autofocus"
                                                                 ,"placeholder"=>""
                                                                 ]) !!}
                                                                    </div>
                                                              </div>
                                                              <!--/span-->
                                                             

                                                                <!--/span-->
                                                                <div class="col-md-5">
                                                                    <div class="form-group{{ $errors->has('telephone_2') ? ' has-error' : '' }}">
                                                                    {!! Form::label("telephone_2","Second Telephone #",["class"=>"control-label"]) !!}
                                                                    {!! Form::text("telephone_2",isset($OfficeEdit)?$OfficeEdit->telephone_2:null,["class"=>"form-control".($errors->has('telephone_2')?" is-invalid":"")
                                                                     ,"autofocus"
                                                                     ,"placeholder"=>""
                                                                      ]) !!}
                                                                      </div>
                                                                </div>
                                                                <!--/span-->
                                                            </div>
                                                            {{-- Fourth row ends here --}}
                                                           

                                                            {{-- Fifth row starts here --}}  
                                                            <div class="row">
                                                              <div class="col-md-5 col-md-offset-1">
                                                                    <div class="form-group{{ $errors->has('telephone_3') ? ' has-error' : '' }}">
                                                                    {!! Form::label("telephone_3","Third Telephone #",["class"=>"control-label"]) !!}
                                                                    {!! Form::text("telephone_3",isset($OfficeEdit)?$OfficeEdit->telephone_3:null,["class"=>"form-control".($errors->has('telephone_3')?" is-invalid":"")
                                                                   ,"autofocus"
                                                                   ,"placeholder"=>""
                                                                   ]) !!}
                                                                  </div>
                                                                </div>

                                                                <!--/span-->
                                                                <div class="col-md-5">
                                                                    <div class="form-group{{ $errors->has('telephone_4') ? ' has-error' : '' }}">
                                                                    {!! Form::label("telephone_4","Fourth Telephone #",["class"=>"control-label"]) !!}
                                                                    {!! Form::text("telephone_4",isset($OfficeEdit)?$OfficeEdit->telephone_4:null,["class"=>"form-control".($errors->has('telephone_4')?" is-invalid":"")
                                                                   ,"autofocus"
                                                                   ,"placeholder"=>""
                                                                    ]) !!}
                                                                   </div>
                                                                </div>
                                                                <!--/span-->
                                                            </div>
                                                            {{-- Fifth row ends here --}}  
                                                
                                                            {{-- Sixth row starts here --}}
                                                            <div class="row">
                                                              <div class="col-md-5 col-md-offset-1">
                                                                    <div class="form-group {{ $errors->has('email_1') ? ' has-error' : '' }}">
                                                                    {!! Form::label("email_1","Enter first Email",["class"=>"control-label"]) !!}
                                                                    {!! Form::text("email_1",isset($OfficeEdit)?$OfficeEdit->email_1:null,["class"=>"form-control".($errors->has('email_1')?" is-invalid":"")
                                                                                           ,"autofocus"
                                                                                           ,"placeholder"=>""
                                                                                           ]) !!}
                                                                  </div>
                                                                </div>

                                                                <!--/span-->
                                                                <div class="col-md-5">
                                                                    <div class="form-group{{ $errors->has('email_2') ? ' has-error' : '' }}">
                                                                    {!! Form::label("email_2","Enter second Email",["class"=>"control-label"]) !!}
                                                                    {!! Form::text("email_2",isset($OfficeEdit)?$OfficeEdit->email_2:null,["class"=>"form-control".($errors->has('email_2')?" is-invalid":"")
                                                                    ,"autofocus"
                                                                    ,"placeholder"=>""
                                                                    ]) !!}
                                                                      </div>
                                                                </div>
                                                                <!--/span-->
                                                            </div>
                                                            {{-- Sixth row ends here --}}


                                                            {{-- Seventh row starts here --}}
                                                            <div class="row">
                                                              <div class="col-md-5 col-md-offset-1">
                                                                    <div class="form-group{{ $errors->has('uan_number') ? ' has-error' : '' }}">
                                                                    {!! Form::label("uan_number","Enter Uan #",["class"=>"control-label"]) !!}
                                                                    {!! Form::text("uan_number",isset($OfficeEdit)?$OfficeEdit->uan_number:null,["class"=>"form-control".($errors->has('uan_number')?" is-invalid":"")
                                                                   ,"autofocus"
                                                                   ,"placeholder"=>""
                                                                      ]) !!}
                                                                  </div>
                                                                </div>

                                                                <!--/span-->
                                                                <div class="col-md-5">
                                                                    <div class="form-group {{ $errors->has('fax_number') ? ' has-error' : '' }}">
                                                                    {!! Form::label("fax_number","Enter Fax #",["class"=>"control-label"]) !!}
                                                                    {!! Form::text("fax_number",isset($OfficeEdit)?$OfficeEdit->fax_number:null,["class"=>"form-control".($errors->has('fax_number')?" is-invalid":"")
                                                                                                    ,"autofocus"
                                                                                                    ,"placeholder"=>""
                                                                                                  ]) !!}
                                                                      </div>
                                                                </div>
                                                                <!--/span-->
                                                            </div>
                                                            {{-- Seventh row ends here --}}

                                                          {{-- Eight row starts here --}}
                                                            <div class="row">
                                                              <div class="col-md-5 col-md-offset-1">
                                                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                                                  {!! Form::label("status","Select Status",["class"=>"control-label"]) !!}
                                                                  {{Form::select("status",[
                                                                  '1' => 'Enable',
                                                                  '0' => 'Disable' ]
                                                                 ,(isset($OfficeEdit)?$OfficeEdit->status:null) ,
                                                                  [
                                                                    "class" => "bs-select form-control",
                                                                     "placeholder" => "Select Status"
                                                                  ])
                                                                  }}  
                                                                 </div>
                                                              </div>
                                                            </div> 
                                                           {{-- Eight row ends here --}}
                                                           <br>
                                                           <br>
                                                           <br>
                                                                                        

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                               {{ Form::button('<span class="glyphicon glyphicon-save">&nbsp;Save</span>', ['type' => 'submit', 'name'=>'btnSave', 'class' =>'btn red btn-sm'] )  }}
                                                 <button type="button" onclick="window.location='{{url('/admin/offices')}}'" class="btn default btn-sm">Cancel</button>
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
@if(isset($OfficeEdit))
@else
<script>
const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
const p = new RegExp(a.split('').join('|'), 'g')
$('#office_title').keyup(function() {
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