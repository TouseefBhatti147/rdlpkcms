{{-- Settings start here --}}
@extends('layouts.admin')
@section('css')
<link href="{{asset('assets/layouts/layout4/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" /> 
@endsection
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li>
    <a href="{{url('/admin/home')}}">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
    <a href="#">Manage Settings</a>
</li>
</ul>
<!-- END PAGE BREADCRUMB -->

<!--Code for new data table ends here -->
<div class="row">
  <div class="col-md-12 col-md-offset-0">
  <div class="portlet light bordered">
        <div class="portlet-title">
                  <div class="caption font-dark">
                      <i class="icon-settings font-dark"></i>
                      <span class="caption-subject bold uppercase"> Manage Settings</span>
                  </div>
            </div>
            <div class="portlet-body">
              <div class="page-title">
              @include('inc.messages')
              </div>
              <div class="table-toolbar">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="btn-group">
                            <a href="{{url('admin/settings/create')}}">  <button id="sample_editable_1_new" class="btn btn-sm red btn-circle form-control"> Add New
                                  <i class="fa fa-plus"></i>
                              </button></a>
                          </div>
                      </div>
                 </div>
              </div>

              <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="datatable">
                  <thead>
                      <tr>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 500px;">Title</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 70px;">Value</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 80px;">Status</th>
                          <th class="sorting_asc float-left" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 100px;">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
            </br>
     </div> <!-- Column ends here -->
</div><!-- Row ends here -->



@endsection
@section('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
var SITEURL = '{{URL::to('')}}';
    $(document).ready( function () {
        $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    // Viewing Data in Ajax DataTable
     $(document).ready( function () {
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "columnDefs": [
            { "width": "35%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "15%", "targets": 2 },
            { "width": "35%", "targets": 3 },
            ],
            "fixedColumns": true,
            "ajax": "{{ route('api.settings.index') }}",
            "columns": [
                { "data": "name", orderable: false},
                { "data": "value", orderable: true },
                { "data": "status", orderable: true },
                { "data": "action", name: 'action', orderable: false}
            ]
        });
    });

   
});
</script>
@endsection
{{-- Settings end here --}}





{{-- Old code --}}
{{--@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li>
  <a href="{{url('/admin/home')}}">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
    <a href="#">Manage Settings</a>
</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- Search box starts here -->
<div>
<!--Add new starts here -->
<a href="{{url('/admin/settings/create')}}" class="btn btn-md green"> Add New &nbsp;<i class="fa fa-plus"></i></a>
<!-- Add new ends here -->
<div class="table-group-actions pull-right">
  <form method="get" action="{{url('/admin/settings/search')}}">
{!! Form::text("searchsetting",isset($SettingEdit)?$SettingEdit->searchsetting:null,["class"=>"form-control input-inline input-small".($errors->has('searchsetting')?" is-invalid":"")
                                                  ,"autofocus"
                                                  ,"placeholder"=>"Search Settings"
                                                  ,"required"]) !!}
      {{ Form::button('<i class="fa fa-search"></i> &nbsp;Search</button>', ['type' => 'submit', 'class' =>'btn btn-md green table-group-action-submit'] )  }}
      </form>
         </div>
    </div>
    <br>
  <!-- Search box ends here -->
  <!-- tring to add gallary functionality for files section  -->
  <!-- gallary functionality starts here -->
  <!-- BEGIN SAMPLE FORM PORTLET-->
  <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i><span class="caption-subject font-dark sbold uppercase">Manage Settings</span></div>
            </div>
            <div class="portlet-body">
              <div class="table-responsive">
                    <div class="page-title">
                       @include('inc.messages')
                   </div>

                   <!-- Table logic starts here -->
                        <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                   <tr>
                                      <th><div class="table-title">Name</div></th>
                                      <th><div class="table-title">Value</div></th>
                                      <th><div class="table-title">Status</div></th>
                                      <th><div class="table-title">Actions</div></th>
                                  </tr>
                                  </thead>
                                     @foreach($Settings as $Setting)
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="table-title">
                                            <div class="title caption-desc font-grey-cascade">{{$Setting->name}}</div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="table-title">
                                            <div class="title caption-desc font-grey-cascade">{{$Setting->value}}</div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="table-title">
                                            <div class="title caption-desc font-grey-cascade">  @if ($Setting->status == 1)
                                                  Enabled
                                                  @else Disabled
                                               @endif</div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="actions">
                                          <br/>
                                          <a href="{{url('/admin/settings/update/'.$Setting->id)}}" class="btn blue btn-md">
                                             <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                          </a>
                                        </div>
                                     </div>
                                      </td>
                                    </tr>
                                  </tbody>
                                @endforeach
                          </table>
                       <!-- Table logic ends here -->

                 </div>
               </div>
             </div>
            <nav>
            <ul class="pagination justify-content-end">
     {{ $Settings->links() }}
            </ul>
            </nav>
            <!--Card logic ends here -->
               <!-- gallary view logic ends here -->
               <!-- END SAMPLE FORM PORTLET-->
                      <!-- gallary functionality ends here -->
@endsection
--}}