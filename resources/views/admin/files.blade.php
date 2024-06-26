@extends('layouts.admin')

@section('css')
<link href="{{ asset('assets/layouts/layout4/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{ url('/admin/home') }}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Manage Files</span>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> Manage Files</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="page-title">
                    @include('inc.messages')
                </div>
                <div class="row" id="search">
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input">
                            <input type="text" name="file_title" id="file_title"
                                class="form-control{{ $errors->has('file_title') ? ' is-invalid' : '' }}"
                                placeholder="File Title" value="{{ old('file_title') }}" />
                            <label for="file_title">Title</label>
                            @if($errors->has('file_title'))
                            <span class="invalid-feedback">{{ $errors->first('file_title') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input">
                            <select name="file_category" id="file_category" class="form-control">
                                <option value="">Select Category</option>
                                <option value="logo">Logo</option>
                                <option value="slider">Slider</option>
                                <option value="partnersandassociates">Partners & Associates</option>
                                <option value="broucher">Brochure</option>
                                <option value="newsletter">Newsletter</option>
                                <option value="ourgroup">Our Group</option>
                                <option value="isocertificates">ISO Certificates</option>
                                <option value="others">Others</option>
                            </select>
                            <label for="file_category">File Category</label>
                        </div>
                    </div>
                    <div class="form-group col-md-2" style="margin-top: 32px;">
                        <div class="controls">
                            <button type="button" id="btn-search" class="btn red btn-circle form-control">
                                <span class="glyphicon glyphicon-search"></span> Search
                            </button>
                        </div>
                    </div>
                    <div class="form-group col-md-2" style="margin-top: 32px;">
                        <div class="controls">
                            <button type="button" id="btn-reset" class="btn red btn-circle form-control">
                                <span class="glyphicon glyphicon-refresh"></span> Reset
                            </button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="{{ url('admin/files/create') }}"
                                    class="btn btn-sm red btn-circle form-control">
                                    Add New <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <table
                    class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer"
                    id="datatable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div> <!-- Portlet Body ends here -->
        </div><!-- Portlet ends here -->
    </div><!-- Column ends here -->
</div><!-- Row ends here -->

@endsection

@section('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
</script>
<script>
var SITEURL = '{{ URL::to('
') }}';
$(document).ready(function() {
    $('#datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('api.files.index') }}",
            "data": function(d) {
                d.file_title = $('#file_title').val();
                d.file_category = $('#file_category').val();
            }
        },
        "columns": [{
                "data": "title",
                "name": "title",
                "orderable": true
            },
            {
                "data": "category",
                "name": "category",
                "orderable": true
            },
            {
                "data": "status",
                "name": "status",
                "orderable": true
            },
            {
                "data": "file",
                "name": "file",
                "orderable": false
            },
            {
                "data": "action",
                "name": "action",
                "orderable": false
            }
        ]
    });

    $('#btn-search').click(function() {
        $('#datatable').DataTable().draw(true);
    });

    $('#btn-reset').click(function() {
        $('#file_title').val('');
        $('#file_category').val('').change();
        $('#datatable').DataTable().draw(true);
    });
});
</script>
@endsection