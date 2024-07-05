@extends('layouts.admin')

@section('css')
<link href="{{ asset('assets/layouts/layout4/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<style>
/* Add your custom styles here */
</style>
@endsection

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{ url('/admin/home') }}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">Manage Flash News</a>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<div class="row">
    <div class="col-md-12">
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
                                <a href="{{ url('admin/flashnews/create') }}">
                                    <button id="sample_editable_1_new" class="btn btn-sm red btn-circle form-control">
                                        Add New
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column"
                    id="datatable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Ordering</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
var SITEURL = '{{ URL::to('
') }}';
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.flashnews.index') }}",
        columns: [{
                data: 'title',
                name: 'title',
                orderable: false
            },
            {
                data: 'status',
                name: 'status',
                orderable: true
            },
            {
                data: 'ordering',
                name: 'ordering',
                orderable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        columnDefs: [{
                width: "35%",
                targets: 0
            },
            {
                width: "15%",
                targets: 1
            },
            {
                width: "15%",
                targets: 2
            },
            {
                width: "35%",
                targets: 3
            },
        ],
        fixedColumns: true,
    });

    $('body').on('click', '#delete-flashnews', function() {
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: SITEURL + "/admin/flashnews/delete/" + id,
            success: function(data) {
                var oTable = $('#datatable').dataTable();
                oTable.fnDraw(false);
                var messages = $('.page-title');
                var successHtml = '<div class="alert alert-success"> ' + data.message +
                    '</div>';
                $(messages).html(successHtml);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });
});
</script>
@endsection