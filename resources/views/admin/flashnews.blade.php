@extends('layouts.admin')
@section('css')
<link href="{{asset('assets/layouts/layout4/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" /> 
<style>
   
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
    <a href="#">Manage Flash News</a>
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
                      <span class="caption-subject bold uppercase"> Manage Flash News</span>
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
                            <a href="{{url('admin/flashnews/create')}}">  <button id="sample_editable_1_new" class="btn btn-sm red btn-circle form-control"> Add New
                                  <i class="fa fa-plus"></i>
                              </button></a>
                          </div>
                      </div>
                 </div>
              </div>

              <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="datatable">
                  <thead>
                      <tr>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending">Title</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: auto !important;;">Status</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: auto !important;;">Ordering</th>
                          <th class="sorting_asc float-left" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" Username : activate to sort column descending" style="width: auto !important;">Actions</th>
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
        $('#datatable').removeAttr('width').DataTable({
           "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "ajax": "{{ route('api.flashnews.index') }}",
            "columnDefs": [
            { "width": "35%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "15%", "targets": 2 },
            { "width": "35%", "targets": 3 },
            ],
            "fixedColumns": true,
            "columns": 
             [
                { "data": "title", orderable: false},
                { "data": "status", orderable: true },
                { "data": "ordering", orderable: false },
                { "data": "action", name: 'action', orderable: false}
            ],
        });
    });
   
  

    // Delete commons table element via ajax
    $('body').on('click', '#delete-flashnews', function () {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: "delete",
                url: SITEURL + "/admin/flashnews/delete/"+id,
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