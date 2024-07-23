@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li><a href="{{url('/admin/home')}}">Home</a><i class="fa fa-circle"></i> </li>
    <li><a href="#">{{isset($SettingEdit)?'Edit':'New'}} Setting</a> </li>
</ul>

<!-- END PAGE BREADCRUMB -->

<!-- BEGIN PAGE BASE CONTENT -->

<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($SettingEdit) ? 'Edit' : 'New' }}
                Setting</span>
        </div>
        <div style="float: right;" class="caption">
            <a class="btn btn-default" href="{{ url('/admin/settings') }}">
                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>
        @if(isset($SettingEdit))
        <form method="POST" action="{{ route('settings.update', $SettingEdit->id) }}" class="form-horizontal"
            enctype="multipart/form-data">
            @method('PUT')
            @else
            <form method="POST" action="{{ route('settings.store') }}" class="form-horizontal"
                enctype="multipart/form-data">
                @endif
                @csrf
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label for="name" class="control-label col-md-2">Title</label>
                        <div class="col-md-6">
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $SettingEdit->name ?? '') }}" autofocus placeholder="Enter Name"
                                required>
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <label for="alias" class="control-label col-md-2">Alias (URL)</label>
                        <div class="col-md-6">
                            <input type="text" id="alias" name="alias"
                                class="form-control @error('alias') is-invalid @enderror"
                                value="{{ old('alias', $SettingEdit->alias ?? '') }}" placeholder="Enter Alias" required
                                {{ isset($SettingEdit) ? 'readonly' : '' }}>
                            @error('alias')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <label for="value" class="control-label col-md-2">Enter Value</label>
                        <div class="col-md-6">
                            <input type="text" id="value" name="value"
                                class="form-control @error('value') is-invalid @enderror"
                                value="{{ old('value', $SettingEdit->value ?? '') }}" placeholder="Enter Value"
                                required>
                            @error('value')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="control-label col-md-3 col-lg-2">Status</label>
                        <div class="col-md-6">
                            <div class="input-inline input-large">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="1"
                                            {{ old('status', $SettingEdit->status ?? 1) == 1 ? 'checked' : '' }}>
                                        Enable
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="status" value="0"
                                            {{ old('status', $SettingEdit->status ?? '') == 0 ? 'checked' : '' }}>
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
                                <button type="submit" name="btnSave" class="btn red btn-sm">
                                    <span class="glyphicon glyphicon-save"></span>&nbsp;Save
                                </button>
                                <button type="button" onclick="window.location='{{ url('/admin/settings') }}'"
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
@endsection
@section('scripts')
@if(!isset($SettingEdit))
<script>
const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
const p = new RegExp(a.split('').join('|'), 'g')
$('#name').keyup(function() {
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