@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{url('/admin/home')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">{{isset($VideoEdit)?'Edit':'New'}} Video</a>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($VideoEdit) ? 'Edit' : 'New' }}
                Video</span>
        </div>
        <div style="float: right;" class="caption">
            <a class="btn btn-default" href="{{ url('/admin/videos') }}">
                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>
        @if(isset($VideoEdit))
        <form method="POST" action="{{ route('videos.update', $VideoEdit->id) }}" class="form-horizontal"
            enctype="multipart/form-data">
            @method('PUT')
            @else
            <form method="POST" action="{{ route('videos.store') }}" class="form-horizontal"
                enctype="multipart/form-data">
                @endif
                @csrf
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label for="title" class="control-label col-md-2">Title</label>
                        <div class="col-md-6">
                            <input type="text" name="title" id="title"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                value="{{ old('title', isset($VideoEdit) ? $VideoEdit->title : '') }}"
                                placeholder="Enter Title Here" required maxlength="61" autofocus>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label for="alias" class="control-label col-md-2">Alias (URL)</label>
                        <div class="col-md-6">
                            <input type="text" name="alias" id="alias"
                                class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}"
                                value="{{ old('alias', isset($VideoEdit) ? $VideoEdit->alias : '') }}"
                                placeholder="Enter Alias Here" required {{ isset($VideoEdit) ? 'readonly' : '' }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="control-label col-md-3 col-lg-2">Status</label>
                        <div class="col-md-6">
                            <div class="input-inline input-large">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="1"
                                            {{ old('status', isset($VideoEdit) ? $VideoEdit->status : 1) == 1 ? 'checked' : '' }}>
                                        Enable
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="0"
                                            {{ old('status', isset($VideoEdit) ? $VideoEdit->status : 1) == 0 ? 'checked' : '' }}>
                                        Disable
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name="btnSave" class="btn red btn-sm"><span
                                        class="glyphicon glyphicon-save">&nbsp;Save</span></button>
                                <button type="button" onclick="window.location='{{ url('/admin/videos') }}'"
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
@if(isset($VideoEdit))
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