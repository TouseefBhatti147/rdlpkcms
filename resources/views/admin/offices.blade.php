{{-- Offices start here --}}
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
    <a href="#">Manage Offices</a>
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
                      <span class="caption-subject bold uppercase"> Manage Offices</span>
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
                            <a href="{{url('admin/offices/create')}}">  <button id="sample_editable_1_new" class="btn btn-sm red btn-circle form-control"> Add New
                                  <i class="fa fa-plus"></i>
                              </button></a>
                          </div>
                      </div>
                 </div>
              </div>

              <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="datatable">
                  <thead>
                      <tr>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: 500px;">Office Title</th>
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
            { "width": "50%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "15%", "targets": 2 },
         
            ],
            "fixedColumns": true,
            "ajax": "{{ route('api.offices.index') }}",
            "columns": [
                { "data": "office_title", orderable: false},
                { "data": "status", orderable: true },
                { "data": "action", name: 'action', orderable: false}
            ]
        });
    });

    
 // Delete commons table element via ajax
 $('body').on('click', '#delete-offices', function () {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: "delete",
                url: SITEURL + "/admin/offices/delete/"+id,
                success: function (data) {
                var oTable = $('#datatable').dataTable();
                 oTable.fnDraw(false);
                                var messages = $('.page-title');
                                var successHtml = '<div class="alert alert-success"> '+ data.message +
                               '</div>';

                               $(messages).html(successHtml);
                //  $("#msg").html(data.msg);
                //  $('#page-title').replaceWith($('#page-title',data));
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
      });
   
});
</script>
@endsection
{{-- Offices end here --}}

{{-- Offices old code --}}
{{--@extends('layouts.admin')
@section('css')
<style>
ul > li {
    display: inline-block;
    /* You can also add some margins here to make it look prettier */
    zoom:1;
}
</style>
@endsection
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li>
    <a href="{{url('/admin/home')}}">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
    <a href="#">Manage Offices</a>
</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- Search box starts here -->
<div>
<!--Add new starts here -->
<a href="{{url('/admin/offices/create')}}" class="btn btn-md green"> Add New &nbsp;<i class="fa fa-plus"></i></a>
<!-- Add new ends here -->
<div class="table-group-actions pull-right">
  <form method="get" action="{{url('/admin/offices/search')}}">
{!! Form::text("searchoffice",isset($OfficeEdit)?$OfficeEdit->searchoffice:null,["class"=>"form-control input-inline input-small".($errors->has('searchoffice')?" is-invalid":"")
                                                  ,"autofocus"
                                                  ,"placeholder"=>"Search Office"
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
  <div class="portlet light bordered ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i><span class="caption-subject font-dark sbold uppercase">Manage Offices</span></div>
            </div>
            <div class="portlet-body">
              <div class="table-responsive">
                    <div class="page-title">
                       @include('inc.messages')

                             <table class="table table-striped table-bordered table-hover">
                                 <thead>
                                  <tr>
                                     <th><div class="table-title">Office Title</div></th>
                                <!--     <th><div class="table-title">Address</div></th>-->
                                     <th><div class="table-title">Status</div></th>
                                     <th><div class="table-title">Actions</div></th>
                                 </tr>
                                 </thead>
                                    @foreach($Offices as $Office)
                                 <tbody>
                                   <tr>
                                     <td>
                                       <div class="table-title">
                                           <div class="title caption-desc font-grey-cascade">{{$Office->office_title}}</div>
                                       </div>
                                     </td>
                                <!--     <td>
                                       <div class="table-title">
                                           <div class="title caption-desc font-grey-cascade">{{$Office->address}}
                                           </div>
                                       </div>
                                     </td> -->
                                     <td>
                                       <div class="table-title">
                                           <div class="title caption-desc font-grey-cascade">    @if ($Office->status == 1)
                                                 Enabled
                                                 @else Disabled
                                              @endif</div>
                                       </div>
                                     </td>

                                     <td>
                                       <div class="actions">
                                         <br/>


                                             <a href="{{('/admin/offices/update/'.$Office->id)}}" class="btn blue btn-responsive btn-sm">
                                            <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                          </a>


                                         <button type="button" class="btn btn-danger btn-responsive btn-sm " data-toggle="modal" href="#basic" data-target="#basic{{$Office->id}}">
                                         <span class="glyphicon glyphicon-remove-circle">&nbsp;Delete</span>
                                       </button>




                                             <!--Modal code starts here -->
                                             <div class="modal fade" id="basic{{$Office->id}}" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                   <div class="modal-content">
                                                       <div class="modal-header">
                                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                         <h4 class="modal-title"></h4>
                                                         </div>

                                                         <div class="modal-body">Are you sure You want to delete this !!! </div>

                                                         <div class="modal-footer">
                                                           <div class="grid-container">
                                                                  <div class="grid-item">
                                                                    <table>
                                                                      <thead>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                          </thead>
                                                              <thead>
                                                             {!! Form::open(['action' => ['officesController@delete', $Office->id], 'method' => 'POST']) !!}
                                                                {{ Form::hidden('_method', 'DELETE') }}
                                                                {{ Form::submit('Yes Delete !!' ,['class'=>'btn red']) }}
                                                                {!! Form::close() !!}
                                                               {{csrf_field()}}
                                                             </thead>
                                                             </table>
                                                           </div>
                                                         </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                               </div>
                                                <!-- /.modal-dialog -->
                                         </div>
                                        <!--Modal code ends here -->
                                       </div>
                                    </div>

                                     </td>
                                   </tr>
                                 </tbody>
                                   @endforeach
                         </table>


                   </div>
                 </div>
               </div>
             </div>
            <nav>
            <ul class="pagination justify-content-end">
                 {{ $Offices->Links() }}
            </ul>
            </nav>
            <!--Card logic ends here -->
               <!-- gallary view logic ends here -->
               <!-- END SAMPLE FORM PORTLET-->
                      <!-- gallary functionality ends here -->
@endsection
--}}