@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li><a href="{{url('/admin/home')}}">Home</a><i class="fa fa-circle"></i></li>
    <li><a href="{{url('/admin/news')}}">Manage News</a> <i class="fa fa-circle"></i></li>
    <li><a href="#">{{isset($newsEdit) ? 'Edit' : 'New'}} Project</a></li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($newsEdit) ? 'Edit' : 'New' }}
                Project</span>
        </div>
        <div style="float: right;" class="caption">
            <a class="btn btn-default" href="{{ url('/admin/news') }}">
                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>

        @if(isset($newsEdit))
        <form method="POST" action="{{ route('news.update', $newsEdit->id) }}" class="form-horizontal"
            enctype="multipart/form-data">
            @method('PUT')
            @else
            <form method="POST" action="{{ route('news.store') }}" class="form-horizontal"
                enctype="multipart/form-data">
                @endif
                @csrf

                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label for="title" class="control-label col-md-2">Title</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title', isset($newsEdit) ? $newsEdit->title : '') }}"
                                autofocus placeholder="Enter Title here" required>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <label for="alias" class="control-label col-md-2">Alias (URL)</label>
                        <div class="col-md-6">
                            <input id="alias" type="text" class="form-control @error('alias') is-invalid @enderror"
                                name="alias" value="{{ old('alias', isset($newsEdit) ? $newsEdit->alias : '') }}"
                                autofocus placeholder="Enter Alias here" required
                                {{ isset($newsEdit) ? 'readonly' : '' }}>
                            @error('alias')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Status</label>
                        <div class="col-md-6">
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="status" value="1"
                                        {{ old('status', isset($newsEdit) && $newsEdit->status == 1 ? 'checked' : '') }}>
                                    Enable <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="status" value="0"
                                        {{ old('status', isset($newsEdit) && $newsEdit->status == 0 ? 'checked' : '') }}>
                                    Disable <span></span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group form-md-line-input">
                        <label for="short_description" class="control-label col-md-2">Short Description</label>
                        <div class="col-md-6">
                            <input id="short_description" type="text"
                                class="form-control @error('short_description') is-invalid @enderror"
                                name="short_description"
                                value="{{ isset($newsEdit) ? $newsEdit->short_description : old('short_description') }}"
                                autofocus placeholder="Enter short description here" required>
                            @error('short_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label col-md-2">Description</label>
                        <div class="col-md-9">
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                                name="description" rows="4" cols="54"
                                style="resize: none">{{ old('description', isset($newsEdit) ? $newsEdit->description : '') }}</textarea>
                            <script>
                            CKEDITOR.replace('description');
                            </script>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image" class="control-label col-md-2">Select image</label>
                        <div class="col-md-9">
                            <img id="preview"
                                src="{{ asset((isset($newsEdit) && $newsEdit->image != '') ? 'uploads/' . $newsEdit->image : 'images/noimage.jpg') }}"
                                height="200px" width="200px" />
                            <input type="file" id="image" name="image" class="form-control" style="display: none;">
                            <br />
                            <a href="javascript:changeProfile();">{{ isset($widget) ? 'Change' : 'Add' }}</a> |
                            <a style="color: red" href="javascript:removeImage()">Remove</a>
                            <input type="hidden" name="remove" value="0">
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
                            <label for="meta_title" class="control-label col-md-2">Meta Title</label>
                            <div class="col-md-6">
                                <input id="meta_title" type="text"
                                    class="form-control @error('meta_title') is-invalid @enderror" name="meta_title"
                                    value="{{ old('meta_title', isset($newsEdit) ? $newsEdit->meta_title : '') }}"
                                    autofocus placeholder="Enter Meta Title here">
                                @error('meta_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label for="meta_description" class="control-label col-md-2">Meta Description</label>
                            <div class="col-md-6">
                                <textarea id="meta_description"
                                    class="form-control @error('meta_description') is-invalid @enderror"
                                    name="meta_description" rows="2" cols="88" style="resize: none"
                                    placeholder="Enter Meta Description">{{ old('meta_description', isset($newsEdit) ? $newsEdit->meta_description : '') }}</textarea>
                                @error('meta_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label for="meta_keywords" class="control-label col-md-2">Meta Keywords</label>
                            <div class="col-md-6">
                                <textarea id="meta_keywords"
                                    class="form-control @error('meta_keywords') is-invalid @enderror"
                                    name="meta_keywords" rows="2" cols="88" style="resize: none"
                                    placeholder="Enter Meta Keywords">{{ old('meta_keywords', isset($newsEdit) ? $newsEdit->meta_keywords : '') }}</textarea>
                                @error('meta_keywords')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn red btn-sm">
                                    <span class="glyphicon glyphicon-save"></span> Save
                                </button>
                                <button type="button" onclick="window.location='{{ url('/admin/news') }}'"
                                    class="btn default btn-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>

<!-- END SAMPLE FORM PORTLET-->
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