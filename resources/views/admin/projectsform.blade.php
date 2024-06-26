@extends('layouts.admin')

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{ url('/admin/home') }}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ url('/admin/projects') }}">Manage Projects</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">{{ isset($ProjectEdit) ? 'Edit' : 'New' }} Project</a>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<!-- BEGIN PAGE BASE CONTENT -->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($ProjectEdit) ? 'Edit' : 'New' }}
                Project</span>
        </div>
        <div style="float: right;" class="caption">
            <a class="btn btn-default" href="{{ url('/admin/projects') }}">
                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
            </a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>

        @if(isset($ProjectEdit))
        <form method="POST" action="{{ route('projects.update', $ProjectEdit->id) }}" class="form-horizontal"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @else
            <form method="POST" action="{{ route('projects.store') }}" class="form-horizontal"
                enctype="multipart/form-data">
                @csrf
                @endif

                <div class="form-body">

                    <div class="form-group form-md-line-input">
                        <label for="title" class="control-label col-md-2">Title</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ isset($ProjectEdit) ? $ProjectEdit->title : old('title') }}"
                                autofocus placeholder="Enter Title here" required>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <label for="alias" class="control-label col-md-2">Alias (url)</label>
                        <div class="col-md-6">
                            <input id="alias" type="text" class="form-control @error('alias') is-invalid @enderror"
                                name="alias" value="{{ isset($ProjectEdit) ? $ProjectEdit->alias : old('alias') }}"
                                placeholder="Enter Alias here" required {{ isset($ProjectEdit) ? 'readonly' : '' }}>
                            @error('alias')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Other form fields -->

                    <div class="form-group">
                        <label class="control-label col-md-3 col-lg-2">Status</label>
                        <div class="col-md-6">
                            <div class="input-inline input-large">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="1"
                                            {{ isset($ProjectEdit) && $ProjectEdit->status == 1 ? 'checked' : '' }}>
                                        Enable <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="0"
                                            {{ isset($ProjectEdit) && $ProjectEdit->status == 0 ? 'checked' : '' }}>
                                        Disable <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Remaining form fields -->

                    <div class="form-actions">
                        <div class="caption">
                            <h4>
                                <strong class="caption-subject font-dark sbold uppercase">SEO</strong>
                            </h4>
                        </div>
                        <br>
                        <div class="form-group form-md-line-input">
                            <label for="meta_title" class="control-label col-md-2">Meta Title</label>
                            <div class="col-md-6">
                                <input id="meta_title" type="text" class="form-control" name="meta_title"
                                    value="{{ isset($ProjectEdit) ? $ProjectEdit->meta_title : old('meta_title') }}"
                                    placeholder="Enter Meta Title here">
                            </div>
                        </div>
                        <!-- Remaining SEO fields -->
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn red btn-sm">
                                    <span class="glyphicon glyphicon-save"></span> &nbsp;Save
                                </button>
                                <a href="{{ url('/admin/projects') }}" class="btn default btn-sm">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
@endsection

@section('scripts')
@if(!isset($ProjectEdit))
<script>
const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
const p = new RegExp(a.split('').join('|'), 'g')
document.getElementById('title').addEventListener('keyup', function() {
    document.getElementById('alias').value = this.value
        .toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
        .replace(/&/g, '-and-') // Replace & with 'and'
        .replace(/[^\w\-]+/g, '') // Remove all non-word characters
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
        .replace(/^-+/, ''); // Trim - from start of text
});
</script>
@endif
@endsection