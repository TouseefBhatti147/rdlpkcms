@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li><a href="{{url('/admin/home')}}">Home</a><i class="fa fa-circle"></i></li>
    <li><a href="{{url('/admin/events')}}">Manage Events</a><i class="fa fa-circle"></i></li>
    <li><a href="#">{{isset($EventEdit)?'Edit':'New'}} Event</a></li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($EventEdit) ? 'Edit' : 'New' }}
                Event</span>
        </div>
        <div style="float: right;" class="caption">
            <a class="btn btn-default" href="{{ url('/admin/events') }}">
                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>
        @if(isset($EventEdit))
        <form method="POST" action="{{ route('events.update', $EventEdit->id) }}" class="form-horizontal"
            enctype="multipart/form-data">
            @method('PUT')
            @else
            <form method="POST" action="{{ route('events.store') }}" class="form-horizontal"
                enctype="multipart/form-data">
                @endif
                @csrf
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label for="title" class="control-label col-md-2">Title</label>
                        <div class="col-md-6">
                            <input type="text" name="title" id="title"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                value="{{ old('title', isset($EventEdit) ? $EventEdit->title : '') }}"
                                placeholder="Enter Title here" required maxlength="61" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label for="alias" class="control-label col-md-2">Alias (URL)</label>
                        <div class="col-md-6">
                            <input type="text" name="alias" id="alias"
                                class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}"
                                value="{{ old('alias', isset($EventEdit) ? $EventEdit->alias : '') }}"
                                placeholder="Enter alias here" required {{ isset($EventEdit) ? 'readonly' : '' }}>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label for="event_date" class="control-label col-md-2">Event Date</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" name="event_date" id="datetimepicker" class="form-control"
                                    value="{{ old('event_date', isset($EventEdit) ? $EventEdit->event_date : '') }}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <script type="text/javascript">
                            $('#datetimepicker').datetimepicker({
                                format: 'yyyy-mm-dd'
                            });
                            </script>
                            <span class="help-block">Select date</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="control-label col-md-3 col-lg-2">Status</label>
                        <div class="col-md-6">
                            <div class="input-inline input-large">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="1"
                                            {{ old('status', isset($EventEdit) ? $EventEdit->status : 1) == 1 ? 'checked' : '' }}>
                                        Enable
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="0"
                                            {{ old('status', isset($EventEdit) ? $EventEdit->status : 1) == 0 ? 'checked' : '' }}>
                                        Disable
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label for="short_description" class="control-label col-md-2">Enter Short Description</label>
                        <div class="col-md-6">
                            <textarea name="short_description" id="short_description" class="form-control" rows="2"
                                cols="88" maxlength="60" style="resize:none"
                                placeholder="Enter Short Description">{{ old('short_description', isset($EventEdit) ? $EventEdit->short_description : '') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label col-md-2">Enter Description</label>
                        <div class="col-md-8">
                            <textarea name="description" id="description" rows="2" cols="88" style="resize:none"
                                placeholder="Enter Description">{{ old('description', isset($EventEdit) ? $EventEdit->description : '') }}</textarea>
                            <script>
                            CKEDITOR.replace('description');
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label col-md-2">Select image</label>
                        <div class="col-md-9">
                            <img id="preview"
                                src="{{ asset(isset($EventEdit) && $EventEdit->image != '' ? 'uploads/' . $EventEdit->image : 'images/noimage.jpg') }}"
                                height="200px" width="200px" />
                            <input type="file" name="image" class="form-control" style="display:none;">
                            <br />
                            <a href="javascript:changeProfile();">{{ isset($EventEdit) ? 'Change' : 'Add' }}</a> |
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
                                <input type="text" name="meta_title" id="meta_title"
                                    class="form-control{{ $errors->has('meta_title') ? ' is-invalid' : '' }}"
                                    value="{{ old('meta_title', isset($EventEdit) ? $EventEdit->meta_title : '') }}"
                                    placeholder="Enter meta Title here">
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label for="meta_description" class="control-label col-md-2">Meta Description</label>
                            <div class="col-md-6">
                                <textarea name="meta_description" id="meta_description" class="form-control" rows="2"
                                    cols="88" style="resize:none"
                                    placeholder="Enter Meta Description">{{ old('meta_description', isset($EventEdit) ? $EventEdit->meta_description : '') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label for="meta_keywords" class="control-label col-md-2">Meta Keywords</label>
                            <div class="col-md-6">
                                <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="2"
                                    cols="88" style="resize:none"
                                    placeholder="Enter Meta Keywords">{{ old('meta_keywords', isset($EventEdit) ? $EventEdit->meta_keywords : '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn red btn-sm"><span
                                        class="glyphicon glyphicon-save">&nbsp;Save</span></button>
                                <button type="button" onclick="window.location='{{ url('/admin/events') }}'"
                                    class="btn default btn-sm">Cancel</button>
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
<script type="text/javascript">
$('#datetimepicker').datetimepicker({
    format: 'yyyy-mm-dd'
});
</script>
@if(isset($EventEdit))
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