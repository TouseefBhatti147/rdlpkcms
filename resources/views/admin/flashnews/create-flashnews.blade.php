@extends('layouts.admin')

@section('css')
<!-- Add any custom CSS here -->
@endsection

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li><a href="{{ url('/admin/home') }}">Home</a><i class="fa fa-circle"></i></li>
    <li><a href="{{ url('/admin/flashnews') }}">Manage Flash News</a><i class="fa fa-circle"></i></li>
    <li><a href="#">{{ isset($AlertEdit) ? 'Edit' : 'New' }} Flash News</a></li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN FORM -->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($AlertEdit) ? 'Edit' : 'New' }} Flash
                News</span>
        </div>
        <div class="actions">
            <label class="btn btn-transparent light btn-outline btn-circle btn-sm">
                <a href="{{ url('/admin/flashnews') }}">
                    <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                </a>
            </label>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>
        <form action="{{ isset($AlertEdit) ? route('flashnews.update', $AlertEdit->id) : route('flashnews.store') }}"
            method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @if (isset($AlertEdit))
            @method('PUT')
            @endif
            <div class="form-body">
                <!-- Title starts here -->
                <div class="row">
                    <div class="form-group @error('title') has-error @enderror">
                        <label for="title" class="control-label col-md-2 col-lg-2">Title</label>
                        <div class="col-md-4 col-lg-4">
                            <div class="input-inline input-large">
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $AlertEdit->title ?? '') }}"
                                    class="form-control @error('title') is-invalid @enderror" autofocus
                                    placeholder="Enter Title Here">
                            </div>
                        </div>

                        <label for="link" class="control-label col-md-2 col-lg-2">Link</label>
                        <div class="col-md-4 col-lg-4 @error('link') has-error @enderror">
                            <div class="input-inline input-large">
                                <input type="text" name="link" id="link"
                                    value="{{ old('link', $AlertEdit->link ?? '') }}"
                                    class="form-control @error('link') is-invalid @enderror" placeholder="Enter Link">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Title ends here -->

                <div class="row">
                    <div class="form-group">
                        <label for="status" class="control-label col-md-2 col-lg-2">Status</label>
                        <div class="col-md-4">
                            <div class="input-inline input-large">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="1"
                                            {{ isset($AlertEdit) ? ($AlertEdit->status == 1 ? 'checked' : '') : 'checked' }}>
                                        Enable <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="0"
                                            {{ isset($AlertEdit) && $AlertEdit->status == 0 ? 'checked' : '' }}>
                                        Disable <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @if(isset($AlertEdit))
                        <label for="ordering" class="control-label col-md-2 col-lg-2">Ordering</label>
                        <div class="col-md-4 col-lg-4 @error('ordering') has-error @enderror">
                            <div class="input-inline input-large">
                                <input type="number" name="ordering" id="ordering"
                                    value="{{ old('ordering', $AlertEdit->ordering ?? '') }}"
                                    class="form-control input-inline input-small @error('ordering') is-invalid @enderror"
                                    placeholder="Order">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Description starts here -->
                <div class="row">
                    <div class="form-group @error('description') has-error @enderror">
                        <label for="description" class="control-label col-md-2 col-lg-2">Description</label>
                        <div class="col-md-9">
                            <textarea name="description" id="description" rows="2" cols="88" class="form-control"
                                style="resize:none">{{ old('description', $AlertEdit->description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
                <!-- Description ends here -->

                <!-- Date range picker starts here -->
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-2">Date</label>
                        <div class="col-md-4">
                            <div class="input-inline input-large">
                                <div class="input-group input-large date-picker input-daterange"
                                    data-date="{{ old('start_date', $AlertEdit->start_date ?? '2020-04-17') }}"
                                    data-date-format="yyyy-mm-dd">
                                    <input type="text" name="start_date"
                                        value="{{ old('start_date', isset($AlertEdit) ? \Carbon\Carbon::createFromFormat('Y-m-d', $AlertEdit->start_date)->format('Y-m-d') : null) }}"
                                        class="form-control">
                                    <span class="input-group-addon"> to </span>
                                    <input type="text" name="end_date"
                                        value="{{ old('end_date', isset($AlertEdit) ? \Carbon\Carbon::createFromFormat('Y-m-d', $AlertEdit->end_date)->format('Y-m-d') : null) }}"
                                        class="form-control">
                                </div>
                                <!-- /input-group -->
                                <span class="help-block"> Select date range </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Date range picker ends here -->

                <!-- Image upload starts here -->
                <div class="row">
                    <div class="form-group">
                        <label for="image" class="control-label col-md-2">Select image</label>
                        <div class="col-md-9">
                            <img id="preview"
                                src="{{ asset((isset($AlertEdit) && $AlertEdit->image != '') ? 'uploads/' . $AlertEdit->image : 'images/noimage.jpg') }}"
                                height="200px" width="200px" />
                            <input type="file" id="image" name="image" class="form-control" style="display: none;">
                            <br />
                            <a href="javascript:changeProfile();">{{ isset($AlertEdit) ? 'Change' : 'Add' }}</a> |
                            <a style="color: red" href="javascript:removeImage()">Remove</a>
                            <input type="hidden" name="remove" value="0">
                        </div>
                    </div>
                </div>
                <!-- Image upload ends here -->
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="btnSave" class="btn btn-sm red"><span
                                class="glyphicon glyphicon-save">&nbsp;Save</span></button>
                        <button type="button" onclick="window.location='{{ url('/admin/flashnews') }}'"
                            class="btn btn-sm default">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function changeProfile() {
    document.getElementById('image').click();
}

document.getElementById('image').addEventListener('change', function() {
    var imgPath = this.value;
    var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg") {
        readURL(this);
    } else {
        alert("Please select image file (jpg, jpeg, png).")
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.querySelector('input[name="remove"]').value = 0;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('preview').src = "{{ asset('images/noimage.jpg') }}";
    document.querySelector('input[name="remove"]').value = 1;
}
</script>

<!-- END FORM -->
@endsection

@section('scripts')
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace('description');
</script>
<script src="{{ asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
@endsection