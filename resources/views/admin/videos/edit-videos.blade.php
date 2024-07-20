@extends('layouts.admin')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li><a href="{{url('/admin/home')}}">Home</a><i class="fa fa-circle"></i></li>
    <li><a href="{{url('/admin/videos')}}">Manage Videos</a> <i class="fa fa-circle"></i></li>
    <li><a href="#">{{isset($videosEdit) ? 'Edit' : 'New'}} Project</a></li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($videosEdit) ? 'Edit' : 'New' }}
                Project</span>
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

        @if(isset($videosEdit))
        <form method="POST" action="{{ route('videos.update', $videosEdit->id) }}" class="form-horizontal"
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
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title', isset($videosEdit) ? $videosEdit->title : '') }}"
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
                                name="alias" value="{{ old('alias', isset($videosEdit) ? $videosEdit->alias : '') }}"
                                autofocus placeholder="Enter Alias here" required>
                            @error('alias')

                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Status</label>
                        <div class="col-md-6">
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="status" value="1"
                                        {{ old('status', isset($videosEdit) && $videosEdit->status == 1 ? 'checked' : '') }}>
                                    Enable <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="status" value="0"
                                        {{ old('status', isset($videosEdit) && $videosEdit->status == 0 ? 'checked' : '') }}>
                                    Disable <span></span>
                                </label>
                            </div>
                        </div>
                    </div>









                    <div class="form-actions">

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn red btn-sm">
                                        <span class="glyphicon glyphicon-save"></span> Save
                                    </button>
                                    <button type="button" onclick="window.location='{{ url('/admin/videos') }}'"
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



@endsection