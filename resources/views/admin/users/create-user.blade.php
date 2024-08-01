@extends('layouts.admin')

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{ url('/admin/home') }}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="#">{{ isset($UserEdit) ? 'Edit' : 'New' }} User</a>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<!-- BEGIN PAGE BASE CONTENT -->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($UserEdit) ? 'Edit' : 'New' }} User</span>
        </div>
        <div style="float: right;" class="caption">
            <a class="btn btn-default" href="{{ url('/admin/users') }}">
                <span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>

        @if(isset($UserEdit))
        <form method="POST" action="{{ route('users.update', $UserEdit->id) }}" class="form-horizontal"
            enctype="multipart/form-data">
            @method('PUT')
            @else
            <form method="POST" action="{{ route('users.store') }}" class="form-horizontal"
                enctype="multipart/form-data">
                @endif
                @csrf
                <div class="form-body">
                    <div class="form-group form-md-line-input{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label col-md-2">Enter Name</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $UserEdit->name ?? '') }}"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" autofocus
                                    placeholder="Enter Name Here" required>
                            </div>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group form-md-line-input{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label col-md-2">Enter Email</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $UserEdit->email ?? '') }}"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="Enter Email here" required>
                            </div>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    @if(!isset($UserEdit))
                    <!-- Only show password fields for new user creation -->
                    <div class="form-group form-md-line-input{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label col-md-2">Enter Password</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="password" id="password" name="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    placeholder="Enter Password here" required>
                            </div>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div
                        class="form-group form-md-line-input{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                        <label for="confirm_password" class="control-label col-md-2">Confirm Password</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}"
                                    placeholder="Confirm Password here" required>
                            </div>
                            @if ($errors->has('confirm_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" name="btnSave" class="btn red btn-sm">
                                    <span class="glyphicon glyphicon-save"></span>&nbsp;Save
                                </button>
                                <button type="button" onclick="window.location='{{ url('/admin/users') }}'"
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
<!-- END PAGE BASE CONTENT -->
@endsection