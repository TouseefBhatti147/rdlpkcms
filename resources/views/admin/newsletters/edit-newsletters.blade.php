@extends('layouts.admin')

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{ url('/admin/home') }}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ url('/admin/newsletters') }}">Manage Newsletters</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">{{ isset($NewsEdit) ? 'Edit' : 'New' }} Newsletter</a>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($NewsEdit) ? 'Edit' : 'New' }}
                Newsletter</span>
        </div>
        <div style="float: right;" class="caption">
            <a class="btn btn-default" href="{{ url('/admin/newsletters') }}">
                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>
        <form method="POST"
            action="{{ isset($NewsEdit) ? route('newsletters.update', $NewsEdit->id) : route('newsletters.store') }}"
            enctype="multipart/form-data" class="form-horizontal">
            @csrf
            @if(isset($NewsEdit))
            @method('PUT')
            @endif
            <div class="form-body">
                <div class="form-group form-md-line-input">
                    <label class="control-label col-md-2" for="title">Title</label>
                    <div class="col-md-6">
                        <input type="text" name="title" id="title"
                            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            placeholder="Enter Title here" maxlength="61" required
                            value="{{ old('title', isset($NewsEdit) ? $NewsEdit->title : '') }}">
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="control-label col-md-2" for="link">Link</label>
                    <div class="col-md-6">
                        <input type="text" name="link" id="link"
                            class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}"
                            placeholder="Enter Link here" maxlength="61" required
                            value="{{ old('link', isset($NewsEdit) ? $NewsEdit->link : '') }}">
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="control-label col-md-2" for="alias">Alias (URL)</label>
                    <div class="col-md-6">
                        <input type="text" name="alias" id="alias"
                            class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}"
                            placeholder="Enter Alias here" required
                            value="{{ old('alias', isset($NewsEdit) ? $NewsEdit->alias : '') }}"
                            {{ isset($NewsEdit) ? 'readonly' : '' }}>
                    </div>
                </div>
                @if(isset($NewsEdit))
                <div class="form-group form-md-line-input">
                    <label class="control-label col-md-2" for="link">Flipbook Path</label>
                    <div class="col-md-6">
                        <input type="text" name="link" id="link"
                            class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}"
                            placeholder="Enter Flipbook Path" required
                            value="{{ old('link', isset($NewsEdit) ? $NewsEdit->link : '') }}">
                    </div>
                </div>
                @endif
                <div class="form-group form-md-line-input">
                    <label class="control-label col-md-2" for="pdf_file">PDF File</label>
                    <div class="col-md-6">
                        <input type="file" name="pdf_file" id="pdf_file" class="form-control">
                        <p class="help-block">
                            {{ isset($NewsEdit) ? 'Please select a new file to replace the existing one' : 'Please select a PDF file' }}
                        </p>
                    </div>
                </div>
                @if(isset($NewsEdit))
                <div class="form-group form-md-line-input">
                    <label class="control-label col-md-2" for="current_pdf_file">Current PDF File</label>
                    <div class="col-md-6">
                        <embed
                            src="{{ asset($NewsEdit->pdf_file ? 'uploads/'.$NewsEdit->pdf_file : 'images/nofile.png') }}"
                            width="200px" height="200px" />
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-md-2" for="status">Status</label>
                    <div class="col-md-6">
                        <div class="input-inline input-large">
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="status" value="1"
                                        {{ old('status', isset($NewsEdit) ? $NewsEdit->status : 1) == 1 ? 'checked' : '' }}>
                                    Enable <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="status" value="0"
                                        {{ old('status', isset($NewsEdit) ? $NewsEdit->status : 0) == 0 ? 'checked' : '' }}>
                                    Disable <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="image" class="control-label col-md-2">Select image</label>
                        <div class="col-md-9">
                            <img id="preview"
                                src="{{ asset((isset($NewsEdit) && $NewsEdit->image != '') ? 'uploads/' . $NewsEdit->image : 'images/noimage.jpg') }}"
                                height="200px" width="200px" />
                            <input type="file" id="image" name="image" class="form-control" style="display: none;">
                            <br />
                            <a href="javascript:changeProfile();">{{ isset($NewsEdit) ? 'Change' : 'Add' }}</a> |
                            <a style="color: red" href="javascript:removeImage()">Remove</a>
                            <input type="hidden" name="remove" value="0">
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="caption">
                        <h4>
                            <strong class="caption-subject font-dark sbold uppercase">SEO</strong>
                        </h4>
                    </div>
                    <br>
                    <div class="form-group form-md-line-input">
                        <label class="control-label col-md-2" for="meta_title">Meta Title</label>
                        <div class="col-md-6">
                            <input type="text" name="meta_title" id="meta_title"
                                class="form-control{{ $errors->has('meta_title') ? ' is-invalid' : '' }}"
                                placeholder="Enter meta Title here"
                                value="{{ old('meta_title', isset($NewsEdit) ? $NewsEdit->meta_title : '') }}">
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="control-label col-md-2" for="meta_description">Meta Description</label>
                        <div class="col-md-6">
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="2"
                                placeholder="Enter Meta Description">{{ old('meta_description', isset($NewsEdit) ? $NewsEdit->meta_description : '') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="control-label col-md-2" for="meta_keywords">Meta Keywords</label>
                        <div class="col-md-6">
                            <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="2"
                                placeholder="Enter Meta Keywords">{{ old('meta_keywords', isset($NewsEdit) ? $NewsEdit->meta_keywords : '') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn red btn-sm">
                                <span class="glyphicon glyphicon-save"></span> &nbsp;Save
                            </button>
                            <button type="button" onclick="window.location='{{ url('/admin/newsletters') }}'"
                                class="btn default btn-sm">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
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
@endsection