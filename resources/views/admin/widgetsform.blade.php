@php
if(Auth::user()->hasRole('admin')){
$layoutDirectory = 'layouts.admin';
}elseif(Auth::user()->hasRole('user')){
$layoutDirectory = 'layouts.app';}
@endphp
@extends($layoutDirectory)

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        @if(Auth::user()->hasRole('admin'))
        <a href="{{url('/admin/home')}}">Home</a>
        @elseif(Auth::user()->hasRole('user'))
        <a href="{{url('/user/home')}}">Home</a>
        @endif
        <i class="fa fa-circle"></i>
    </li>
    <li>
        @if(Auth::user()->hasRole('admin'))
        <a href="{{url('/admin/widgets')}}">Manage Widgets</a>
        @elseif(Auth::user()->hasRole('user'))
        <a href="{{url('/user/widgets')}}">Manage Widgets</a>
        @endif

        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">{{isset($WidgetEdit)?'Edit':'New'}} Widget</a>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<!-- BEGIN SAMPLE FORM PORTLET-->
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{isset($WidgetEdit)?'Edit':'New'}} Widget </span>
        </div>
        <div style="float: right;" class="caption">

            @if(Auth::user()->hasRole('admin'))
            <a class="btn btn-default" href="{{url('/admin/widgets')}}">
                @elseif(Auth::user()->hasRole('user'))
                <a class="btn btn-default" href="{{url('/user/widgets')}}">
                    @endif

                    <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
                </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>
        @if(Auth::user()->hasRole('admin'))
        @if(isset($WidgetEdit))
        <form method="POST" action="{{ route('widgets.update', $WidgetEdit->id) }}" enctype="multipart/form-data"
            class="form-horizontal">
            @method('PUT')
            @else
            <form method="POST" action="{{ route('widgets.create') }}" enctype="multipart/form-data"
                class="form-horizontal">
                @endif
                @elseif(Auth::user()->hasRole('user'))
                @if(isset($WidgetEdit))
                <form method="POST" action="{{ route('user.widgets.update', $WidgetEdit->id) }}"
                    enctype="multipart/form-data" class="form-horizontal">
                    @method('PUT')
                    @else
                    <form method="POST" action="{{ route('user.widgets.create') }}" enctype="multipart/form-data"
                        class="form-horizontal">
                        @endif
                        @endif
                        @csrf
                        <div class="form-body">

                            @if(Auth::user()->hasRole('admin'))
                            @if(isset($WidgetEdit))
                            <form method="POST" action="{{ route('widgets.update', $WidgetEdit->id) }}"
                                enctype="multipart/form-data" class="form-horizontal">
                                @method('PUT')
                                @else
                                <form method="POST" action="{{ route('widgets.create') }}" enctype="multipart/form-data"
                                    class="form-horizontal">
                                    @endif
                                    @elseif(Auth::user()->hasRole('user'))
                                    @if(isset($WidgetEdit))
                                    <form method="POST" action="{{ route('user.widgets.update', $WidgetEdit->id) }}"
                                        enctype="multipart/form-data" class="form-horizontal">
                                        @method('PUT')
                                        @else
                                        <form method="POST" action="{{ route('user.widgets.create') }}"
                                            enctype="multipart/form-data" class="form-horizontal">
                                            @endif
                                            @endif

                                            @csrf

                                            <div class="form-group form-md-line-input">
                                                <label for="title" class="control-label col-md-2">Title</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="title"
                                                        class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                        autofocus placeholder="Enter Title here" required
                                                        value="{{ isset($WidgetEdit) ? $WidgetEdit->title : '' }}">
                                                </div>
                                            </div>

                                            <!-- Other form fields go here -->

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" name="btnSave" class="btn red btn-sm">
                                                            <span class="glyphicon glyphicon-save">&nbsp;Save</span>
                                                        </button>
                                                        @if(Auth::user()->hasRole('admin'))
                                                        <button type="button"
                                                            onclick="window.location='{{ url('/admin/widgets') }}'"
                                                            class="btn default btn-sm">Cancel</button>
                                                        @elseif(Auth::user()->hasRole('user'))
                                                        <button type="button"
                                                            onclick="window.location='{{ url('/user/widgets') }}'"
                                                            class="btn default btn-sm">Cancel</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                        </div>

                    </form>
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection

@section('scripts')
@if(isset($WidgetEdit))
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