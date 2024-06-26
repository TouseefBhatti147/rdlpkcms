@extends('layouts.admin')
@section('css')
<style>
.form-group.required label:after {
    content: " *";
    color: red;
    font-weight: bold;
}

.img-container {
    width: 500px;
    height: 400px;
    display: block;
    position: relative;
    overflow: hidden;
}

.img-container embed {
    max-width: 100%;
    max-height: 100%;
}
</style>
@endsection
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li><a href="{{url('/admin/home')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li><a href="{{url('/admin/files')}}">Manage Files</a> <i class="fa fa-circle"></i> </li>
    <li><a href="#">{{isset($FileEdit)?'Edit':'New'}} File</a> </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($FileEdit) ? 'Edit' : 'New' }} File</span>
        </div>
        <div style="float: right;" class="caption">
            <a class="btn btn-default" href="{{ url('/admin/files') }}">
                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>
        @if(isset($FileEdit))
        <form method="post" action="{{ route('files.update', $FileEdit->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @else
            <form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
                @endif
                @csrf
                <div class="form-body">

                    <div class="form-group">
                        <label for="title" class="control-label col-md-2">File Title</label>
                        <div class="col-md-6">
                            <input type="text" id="title" name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', isset($FileEdit) ? $FileEdit->title : '') }}" autofocus
                                placeholder="Enter Title here" required>
                            @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alias" class="control-label col-md-2">Alias (URL)</label>
                        <div class="col-md-6">
                            <input type="text" id="alias" name="alias"
                                class="form-control @error('alias') is-invalid @enderror"
                                value="{{ old('alias', isset($FileEdit) ? $FileEdit->alias : '') }}" autofocus
                                placeholder="Enter Alias" required {{ isset($FileEdit) ? 'readonly' : '' }}>
                            @error('alias')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category" class="control-label col-md-2">Category</label>
                        <div class="col-md-6">
                            <select id="category" name="category"
                                class="form-control @error('category') is-invalid @enderror">
                                <option value="">Select a category</option>
                                <option value="logo"
                                    {{ old('category', isset($FileEdit) ? $FileEdit->category : '') === 'logo' ? 'selected' : '' }}>
                                    Logo</option>
                                <option value="slider"
                                    {{ old('category', isset($FileEdit) ? $FileEdit->category : '') === 'slider' ? 'selected' : '' }}>
                                    Slider</option>
                                <option value="partnersandassociates"
                                    {{ old('category', isset($FileEdit) ? $FileEdit->category : '') === 'partnersandassociates' ? 'selected' : '' }}>
                                    Partners & Associates</option>
                                <option value="broucher"
                                    {{ old('category', isset($FileEdit) ? $FileEdit->category : '') === 'broucher' ? 'selected' : '' }}>
                                    Brochure</option>
                                <option value="newsletter"
                                    {{ old('category', isset($FileEdit) ? $FileEdit->category : '') === 'newsletter' ? 'selected' : '' }}>
                                    Newsletter</option>
                                <option value="ourgroup"
                                    {{ old('category', isset($FileEdit) ? $FileEdit->category : '') === 'ourgroup' ? 'selected' : '' }}>
                                    Our Group</option>
                                <option value="isocertificates"
                                    {{ old('category', isset($FileEdit) ? $FileEdit->category : '') === 'isocertificates' ? 'selected' : '' }}>
                                    ISO Certificates</option>
                                <option value="others"
                                    {{ old('category', isset($FileEdit) ? $FileEdit->category : '') === 'others' ? 'selected' : '' }}>
                                    Others</option>
                            </select>
                            @error('category')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image" class="control-label col-md-2">Select File</label>
                        <div class="col-md-6">
                            <input type="file" id="image" name="image"
                                class="form-control @error('image') is-invalid @enderror">
                            <p class="help-block">
                                {{ isset($FileEdit) ? 'Please select a new file to replace the existing one' : 'Please select a file' }}
                            </p>
                            @error('image')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-lg-2">Status</label>
                        <div class="col-md-6">
                            <div class="input-inline input-large">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="1"
                                            {{ old('status', isset($FileEdit) ? $FileEdit->status : '1') == '1' ? 'checked' : '' }}>
                                        Enable <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="0"
                                            {{ old('status', isset($FileEdit) ? $FileEdit->status : '1') == '0' ? 'checked' : '' }}>
                                        Disable <span></span>
                                    </label>
                                </div>
                            </div>
                            @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="caption">
                            <h4>
                                <strong class="caption-subject font-dark sbold uppercase">Optional File Inputs</strong>
                            </h4>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="title_first_line" class="control-label col-md-2">File Input 1</label>
                            <div class="col-md-6">
                                <input type="text" id="title_first_line" name="title_first_line"
                                    class="form-control @error('title_first_line') is-invalid @enderror"
                                    value="{{ old('title_first_line', isset($FileEdit) ? $FileEdit->title_first_line : '') }}"
                                    autofocus placeholder="Enter First line of title here">
                                @error('title_first_line')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title_second_line" class="control-label col-md-2">File Input 2</label>
                            <div class="col-md-6">
                                <input type="text" id="title_second_line" name="title_second_line"
                                    class="form-control @error('title_second_line') is-invalid @enderror"
                                    value="{{ old('title_second_line', isset($FileEdit) ? $FileEdit->title_second_line : '') }}"
                                    autofocus placeholder="Enter Second line of title here">
                                @error('title_second_line')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn red btn-sm">
                                    <span class="glyphicon glyphicon-save">&nbsp;Save</span>
                                </button>
                                <button type="button" onclick="window.location='{{ url('/admin/files') }}'"
                                    class="btn default btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>


<!-- END SAMPLE FORM PORTLET-->

<!-- END PAGE BASE CONTENT -->
</div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
@endsection
@section('scripts')
@if(isset($FileEdit))
@else
<script>
const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
const p = new RegExp(a.split('').join('|'), 'g')
$('#title').keyup(function() {
    $('#alias').val(this.value
        .toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
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