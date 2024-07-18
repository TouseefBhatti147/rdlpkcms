@php
$layoutDirectory = Auth::user()->hasRole('admin') ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layoutDirectory)

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{ url(Auth::user()->hasRole('admin') ? '/admin/home' : '/user/home') }}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ url(Auth::user()->hasRole('admin') ? '/admin/files' : '/user/files') }}">Manage Files</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Edit File</span>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<!-- BEGIN PAGE BASE CONTENT -->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">Edit File</span>
        </div>
        <div class="caption" style="float: right;">
            <a class="btn btn-default"
                href="{{ url(Auth::user()->hasRole('admin') ? '/admin/files' : '/user/files') }}">
                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>

        <form action="{{ route('files.update', $file->id) }}" method="POST" class="form-horizontal"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-body">
                <div class="form-group form-md-line-input">
                    <label for="title" class="control-label col-md-2">Title</label>
                    <div class="col-md-6">
                        <input type="text" id="title" name="title" value="{{ old('title', $file->title) }}"
                            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            placeholder="Enter Title here" required autofocus>
                        @if ($errors->has('title'))
                        <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label for="title_first_line" class="control-label col-md-2">Title First Line</label>
                    <div class="col-md-6">
                        <input type="text" id="title_first_line" name="title_first_line"
                            value="{{ old('title_first_line', $file->title_first_line) }}"
                            class="form-control{{ $errors->has('title_first_line') ? ' is-invalid' : '' }}"
                            placeholder="Enter Title First Line here">
                        @if ($errors->has('title_first_line'))
                        <span class="invalid-feedback">{{ $errors->first('title_first_line') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label for="title_second_line" class="control-label col-md-2">Title Second Line</label>
                    <div class="col-md-6">
                        <input type="text" id="title_second_line" name="title_second_line"
                            value="{{ old('title_second_line', $file->title_second_line) }}"
                            class="form-control{{ $errors->has('title_second_line') ? ' is-invalid' : '' }}"
                            placeholder="Enter Title Second Line here">
                        @if ($errors->has('title_second_line'))
                        <span class="invalid-feedback">{{ $errors->first('title_second_line') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label for="alias" class="control-label col-md-2">Alias (URL)</label>
                    <div class="col-md-6">
                        <input type="text" id="alias" name="alias" value="{{ old('alias', $file->alias) }}"
                            class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}"
                            placeholder="Enter Alias here" required readonly>
                        @if ($errors->has('alias'))
                        <span class="invalid-feedback">{{ $errors->first('alias') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="category" class="control-label col-md-2">Category</label>
                    <div class="col-md-6">
                        <select id="category" name="category"
                            class="form-control @error('category') is-invalid @enderror">
                            <option value="">Select a category</option>
                            <option value="logo" {{ old('category', $file->category) === 'logo' ? 'selected' : '' }}>
                                Logo</option>
                            <option value="slider"
                                {{ old('category', $file->category) === 'slider' ? 'selected' : '' }}>Slider</option>
                            <option value="partnersandassociates"
                                {{ old('category', $file->category) === 'partnersandassociates' ? 'selected' : '' }}>
                                Partners & Associates</option>
                            <option value="broucher"
                                {{ old('category', $file->category) === 'broucher' ? 'selected' : '' }}>Brochure
                            </option>
                            <option value="newsletter"
                                {{ old('category', $file->category) === 'newsletter' ? 'selected' : '' }}>Newsletter
                            </option>
                            <option value="ourgroup"
                                {{ old('category', $file->category) === 'ourgroup' ? 'selected' : '' }}>Our Group
                            </option>
                            <option value="isocertificates"
                                {{ old('category', $file->category) === 'isocertificates' ? 'selected' : '' }}>ISO
                                Certificates</option>
                            <option value="others"
                                {{ old('category', $file->category) === 'others' ? 'selected' : '' }}>Others</option>
                        </select>
                        @error('category')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>




                <div class="form-group">
                    <label for="status" class="control-label col-md-2">Status</label>
                    <div class="col-md-6">
                        <div class="mt-radio-inline">
                            <label class="mt-radio">
                                <input type="radio" name="status" value="1"
                                    {{ old('status', $file->status) == 1 ? 'checked' : '' }}> Enable
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                <input type="radio" name="status" value="0"
                                    {{ old('status', $file->status) == 0 ? 'checked' : '' }}> Disable
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image" class="control-label col-md-2">Select Image</label>
                    <div class="col-md-9">
                        <img id="preview"
                            src="{{ asset($file->image ? 'uploads/' . $file->image : 'images/noimage.jpg') }}"
                            height="200" width="200">
                        <input type="file" id="image" name="image" class="form-control" style="display: none;">
                        <br />
                        <a href="javascript:changeProfile();">Change</a> |
                        <a style="color: red" href="javascript:removeImage()">Remove</a>
                        <input type="hidden" name="remove" value="0">
                    </div>
                </div>

                <div class="form-group">
                    <label for="file" class="control-label col-md-2">Select File</label>
                    <div class="col-md-9">
                        <input type="file" id="file" name="file" class="form-control">
                        @if ($errors->has('file'))
                        <span class="invalid-feedback">{{ $errors->first('file') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-actions">
                    <div class="caption">
                        <h4><strong class="caption-subject font-dark sbold uppercase">SEO</strong></h4>
                    </div>
                    <br>
                    <div class="form-group form-md-line-input">
                        <label for="meta_title" class="control-label col-md-2">Meta Title</label>
                        <div class="col-md-6">
                            <input type="text" id="meta_title" name="meta_title"
                                value="{{ old('meta_title', $file->meta_title) }}"
                                class="form-control{{ $errors->has('meta_title') ? ' is-invalid' : '' }}"
                                placeholder="Enter Meta Title here">
                            @if ($errors->has('meta_title'))
                            <span class="invalid-feedback">{{ $errors->first('meta_title') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <label for="meta_description" class="control-label col-md-2">Meta Description</label>
                        <div class="col-md-6">
                            <textarea id="meta_description" name="meta_description" rows="2" class="form-control"
                                style="resize: none;"
                                placeholder="Enter Meta Description">{{ old('meta_description', $file->meta_description) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <label for="meta_keywords" class="control-label col-md-2">Meta Keywords</label>
                        <div class="col-md-6">
                            <textarea id="meta_keywords" name="meta_keywords" rows="2" class="form-control"
                                style="resize: none;"
                                placeholder="Enter Meta Keywords">{{ old('meta_keywords', $file->meta_keywords) }}</textarea>
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
                        <button type="button"
                            onclick="window.location='{{ url(Auth::user()->hasRole('admin') ? '/admin/files' : '/user/files') }}'"
                            class="btn default btn-sm">Cancel</button>
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

const specialCharacters = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;';
const replacementCharacters = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------';
const pattern = new RegExp(specialCharacters.split('').join('|'), 'g');

document.getElementById('title').addEventListener('keyup', function() {
    document.getElementById('alias').value = this.value
        .toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(pattern, c => replacementCharacters.charAt(specialCharacters.indexOf(
            c))) // Replace special characters
        .replace(/&/g, '-and-') // Replace & with 'and'
        .replace(/[^\w\-]+/g, '') // Remove all non-word characters
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
        .replace(/^-+/, ''); // Trim - from start of text
});
</script>
@endsection