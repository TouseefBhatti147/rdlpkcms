@php
if (Auth::user()->hasRole('admin')) {
$layoutDirectory = 'layouts.admin';
} elseif (Auth::user()->hasRole('user')) {
$layoutDirectory = 'layouts.app';
}
@endphp

@extends($layoutDirectory)

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        @if (Auth::user()->hasRole('admin'))
        <a href="{{ url('/admin/home') }}">Home</a>
        @elseif (Auth::user()->hasRole('user'))
        <a href="{{ url('/user/home') }}">Home</a>
        @endif
        <i class="fa fa-circle"></i>
    </li>
    <li>
        @if (Auth::user()->hasRole('admin'))
        <a href="{{ url('/admin/pages') }}">Manage pages</a>
        @elseif (Auth::user()->hasRole('user'))
        <a href="{{ url('/user/pages') }}">Manage pages</a>
        @endif
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">{{ isset($pageEdit) ? 'Edit' : 'New' }} page</a>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($pageEdit) ? 'Edit' : 'New' }}
                page</span>
        </div>
        <div style="float: right;" class="caption">
            @if (Auth::user()->hasRole('admin'))
            <a class="btn btn-default" href="{{ url('/admin/pages') }}">
                @elseif (Auth::user()->hasRole('user'))
                <a class="btn btn-default" href="{{ url('/user/pages') }}">
                    @endif
                    <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>
        @if (Auth::user()->hasRole('admin'))
        <form action="{{ isset($pageEdit) ? route('pages.update', $pageEdit->id) : route('pages.store') }}"
            method="{{ isset($pageEdit) ? 'PUT' : 'POST' }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @if (isset($pageEdit))
            @method('PUT')
            @endif
            <div class="form-body">
                <div class="form-group form-md-line-input">
                    <label for="title" class="control-label col-md-2">Title</label>
                    <div class="col-md-6">
                        <input type="text" id="title" name="title" value="{{ old('title', $pageEdit->title ?? '') }}"
                            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            placeholder="Enter Title here" required autofocus>
                        @if ($errors->has('title'))
                        <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label for="alias" class="control-label col-md-2">Alias (URL)</label>
                    <div class="col-md-6">
                        <input type="text" id="alias" name="alias" value="{{ old('alias', $pageEdit->alias ?? '') }}"
                            class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}"
                            placeholder="Enter Alias here" required {{ isset($pageEdit) ? 'readonly' : '' }}>
                        @if ($errors->has('alias'))
                        <span class="invalid-feedback">{{ $errors->first('alias') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label for="website" class="control-label col-md-2">Enter website</label>
                    <div class="col-md-6">
                        <input type="text" id="website" name="website"
                            value="{{ old('website', $pageEdit->website ?? '') }}"
                            class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"
                            placeholder="Enter website here" required>
                        @if ($errors->has('website'))
                        <span class="invalid-feedback">{{ $errors->first('website') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="control-label col-md-3 col-lg-2">Status</label>
                    <div class="col-md-6">
                        <div class="input-inline input-large">
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="status" value="1"
                                        {{ old('status', $pageEdit->status ?? 1) == 1 ? 'checked' : '' }}> Enable
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="status" value="0"
                                        {{ old('status', $pageEdit->status ?? 0) == 0 ? 'checked' : '' }}> Disable
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="control-label col-md-2">Enter Description</label>
                    <div class="col-md-9">
                        <textarea id="description" name="description" rows="4" cols="54" class="form-control"
                            style="resize: none;">{{ old('description', $pageEdit->description ?? '') }}</textarea>
                        <script>
                        CKEDITOR.replace('description');
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image" class="control-label col-md-2">Select image</label>
                    <div class="col-md-9">
                        <img id="preview"
                            src="{{ asset((isset($pageEdit) && $pageEdit->image != '') ? 'uploads/' . $pageEdit->image : 'images/noimage.jpg') }}"
                            height="200px" width="200px" />
                        <input type="file" id="image" name="image" class="form-control" style="display: none;">
                        <br />
                        <a href="javascript:changeProfile();">{{ isset($pageEdit) ? 'Change' : 'Add' }}</a> |
                        <a style="color: red" href="javascript:removeImage()">Remove</a>
                        <input type="hidden" name="remove" value="0">
                    </div>
                </div>
                <div class="form-actions">
                    <div class="caption">
                        <h4><strong class="caption-subject font-dark sbold uppercase">SEO</strong></h4>
                    </div>
                    <br>
                    <div class="form-group form-md-line-input">
                        <label for="meta_title" class="control-label col-md-2">Enter Title</label>
                        <div class="col-md-6">
                            <input type="text" id="meta_title" name="meta_title"
                                value="{{ old('meta_title', $pageEdit->meta_title ?? '') }}"
                                class="form-control{{ $errors->has('meta_title') ? ' is-invalid' : '' }}"
                                placeholder="Enter meta Title here">
                            @if ($errors->has('meta_title'))
                            <span class="invalid-feedback">{{ $errors->first('meta_title') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label for="meta_description" class="control-label col-md-2">Enter Meta Description</label>
                        <div class="col-md-6">
                            <textarea id="meta_description" name="meta_description" rows="2" cols="88"
                                class="form-control" style="resize: none;"
                                placeholder="Enter Meta Description">{{ old('meta_description', $pageEdit->meta_description ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label for="meta_keywords" class="control-label col-md-2">Enter Meta Keywords</label>
                        <div class="col-md-6">
                            <textarea id="meta_keywords" name="meta_keywords" rows="2" cols="88" class="form-control"
                                style="resize: none;"
                                placeholder="Enter Meta Keywords">{{ old('meta_keywords', $pageEdit->meta_keywords ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn red btn-sm">
                            <span class="glyphicon glyphicon-save">&nbsp;Save</span>
                        </button>
                        @if (Auth::user()->hasRole('admin'))
                        <button type="button" onclick="window.location='{{ url('/admin/pages') }}'"
                            class="btn default btn-sm">Cancel</button>
                        @elseif (Auth::user()->hasRole('user'))
                        <button type="button" onclick="window.location='{{ url('/user/pages') }}'"
                            class="btn default btn-sm">Cancel</button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection

@section('scripts')
@if (!isset($pageEdit))
<script>
function changeProfile() {
    document.getElementById('image').click();
}

function removeImage() {
    document.getElementById('preview').src = "{{ asset('images/noimage.jpg') }}";
    document.querySelector('input[name="remove"]').value = 1;
}
const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;';
const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------';
const p = new RegExp(a.split('').join('|'), 'g');

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