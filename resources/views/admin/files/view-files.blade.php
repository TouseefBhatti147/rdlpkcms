@extends('layouts.admin')

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{ url('/admin/home') }}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('files.index') }}">Manage Files</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>View File</span>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> View File</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="form-group">
                    <label for="title">File Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $file->title }}" readonly>
                </div>

                <div class="form-group">
                    <label for="category">File Category</label>
                    <input type="text" name="category" id="category" class="form-control" value="{{ $file->category }}"
                        readonly>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="form-control"
                        value="{{ $file->status ? 'Enabled' : 'Disabled' }}" readonly>
                </div>

                <div class="form-group">
                    <label for="file">File</label>
                    <div>
                        <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank">View File</a>
                    </div>
                </div>

                <a href="{{ route('files.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- You can add custom scripts here if needed -->
@endsection