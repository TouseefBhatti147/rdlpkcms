@extends('layouts.admin')

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li><a href="{{ url('/admin/home') }}">Home</a><i class="fa fa-circle"></i></li>
    <li><a href="{{ url('/admin/offices') }}">Manage Offices</a><i class="fa fa-circle"></i></li>
    <li><a href="#">{{ isset($OfficeEdit) ? 'Edit' : 'New' }} Office</a></li>
</ul>
<!-- END PAGE BREADCRUMB -->

<!-- BEGIN PAGE BASE CONTENT -->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ isset($OfficeEdit) ? 'Edit' : 'New' }}
                Office</span>
        </div>
        <div style="float: right;" class="caption">
            <a href="{{ url('/admin/offices') }}" class="btn btn-default">
                <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="page-title">
            @include('inc.messages')
        </div>
        @if(isset($OfficeEdit))
        <form method="post" action="{{ route('offices.update', $OfficeEdit->id) }}" class="horizontal-form"
            enctype="multipart/form-data">
            @method('PUT')
            @else
            <form method="post" action="{{ route('offices.create') }}" class="horizontal-form"
                enctype="multipart/form-data">
                @endif
                @csrf
                <div class="form-body">
                    {{-- First row starts here --}}
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group {{ $errors->has('office_title') ? 'has-error' : '' }}">
                                <label for="office_title" class="control-label">Enter office title</label>
                                <input type="text" id="office_title" name="office_title"
                                    class="form-control{{ $errors->has('office_title') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->office_title : '' }}" autofocus
                                    required>
                                @if($errors->has('office_title'))
                                <span class="invalid-feedback">{{ $errors->first('office_title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('alias') ? 'has-error' : '' }}">
                                <label for="alias" class="control-label">Alias (Auto Generated)</label>
                                <input type="text" id="alias" name="alias"
                                    class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->alias : '' }}"
                                    {{ isset($OfficeEdit) ? 'readonly' : '' }}>
                                @if($errors->has('alias'))
                                <span class="invalid-feedback">{{ $errors->first('alias') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- First row ends here --}}

                    {{-- Second row starts here --}}
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="address" class="control-label">Enter Address</label>
                                <textarea id="address" name="address" class="form-control" rows="2" style="resize:none"
                                    placeholder="Enter Address">{{ isset($OfficeEdit) ? $OfficeEdit->address : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    {{-- Second row ends here --}}

                    {{-- Third row starts here --}}
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                <label for="category" class="control-label">Select Office Category</label>
                                <select id="category" name="category" class="form-control">
                                    <option value="">Select Office category</option>
                                    <option value="head_office"
                                        {{ isset($OfficeEdit) && $OfficeEdit->category == 'head_office' ? 'selected' : '' }}>
                                        Head Office</option>
                                    <option value="corporate_office"
                                        {{ isset($OfficeEdit) && $OfficeEdit->category == 'corporate_office' ? 'selected' : '' }}>
                                        Corporate Office</option>
                                    <option value="sales_and_marketing"
                                        {{ isset($OfficeEdit) && $OfficeEdit->category == 'sales_and_marketing' ? 'selected' : '' }}>
                                        Sales & Marketing Office</option>
                                    <option value="global_office"
                                        {{ isset($OfficeEdit) && $OfficeEdit->category == 'global_office' ? 'selected' : '' }}>
                                        Global Office</option>
                                </select>
                                @if($errors->has('category'))
                                <span class="invalid-feedback">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                <label for="city" class="control-label">Enter City</label>
                                <input type="text" id="city" name="city"
                                    class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->city : '' }}" autofocus>
                                @if($errors->has('city'))
                                <span class="invalid-feedback">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Third row ends here --}}

                    {{-- Fourth row starts here --}}
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group {{ $errors->has('telephone_1') ? 'has-error' : '' }}">
                                <label for="telephone_1" class="control-label">Enter First Telephone #</label>
                                <input type="text" id="telephone_1" name="telephone_1"
                                    class="form-control{{ $errors->has('telephone_1') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->telephone_1 : '' }}" autofocus>
                                @if($errors->has('telephone_1'))
                                <span class="invalid-feedback">{{ $errors->first('telephone_1') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('telephone_2') ? 'has-error' : '' }}">
                                <label for="telephone_2" class="control-label">Second Telephone #</label>
                                <input type="text" id="telephone_2" name="telephone_2"
                                    class="form-control{{ $errors->has('telephone_2') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->telephone_2 : '' }}" autofocus>
                                @if($errors->has('telephone_2'))
                                <span class="invalid-feedback">{{ $errors->first('telephone_2') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Fourth row ends here --}}

                    {{-- Fifth row starts here --}}
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group {{ $errors->has('telephone_3') ? 'has-error' : '' }}">
                                <label for="telephone_3" class="control-label">Third Telephone #</label>
                                <input type="text" id="telephone_3" name="telephone_3"
                                    class="form-control{{ $errors->has('telephone_3') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->telephone_3 : '' }}" autofocus>
                                @if($errors->has('telephone_3'))
                                <span class="invalid-feedback">{{ $errors->first('telephone_3') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('telephone_4') ? 'has-error' : '' }}">
                                <label for="telephone_4" class="control-label">Fourth Telephone #</label>
                                <input type="text" id="telephone_4" name="telephone_4"
                                    class="form-control{{ $errors->has('telephone_4') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->telephone_4 : '' }}" autofocus>
                                @if($errors->has('telephone_4'))
                                <span class="invalid-feedback">{{ $errors->first('telephone_4') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Fifth row ends here --}}

                    {{-- Sixth row starts here --}}
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group {{ $errors->has('email_1') ? ' has-error' : '' }}">
                                <label for="email_1" class="control-label">Enter first Email</label>
                                <input type="email" id="email_1" name="email_1"
                                    class="form-control{{ $errors->has('email_1') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->email_1 : '' }}" autofocus>
                                @if($errors->has('email_1'))
                                <span class="invalid-feedback">{{ $errors->first('email_1') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('email_2') ? ' has-error' : '' }}">
                                <label for="email_2" class="control-label">Enter second Email</label>
                                <input type="email" id="email_2" name="email_2"
                                    class="form-control{{ $errors->has('email_2') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->email_2 : '' }}" autofocus>
                                @if($errors->has('email_2'))
                                <span class="invalid-feedback">{{ $errors->first('email_2') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Sixth row ends here --}}

                    {{-- Seventh row starts here --}}
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group {{ $errors->has('uan_number') ? ' has-error' : '' }}">
                                <label for="uan_number" class="control-label">Enter Uan #</label>
                                <input type="text" id="uan_number" name="uan_number"
                                    class="form-control{{ $errors->has('uan_number') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->uan_number : '' }}" autofocus>
                                @if($errors->has('uan_number'))
                                <span class="invalid-feedback">{{ $errors->first('uan_number') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('fax_number') ? ' has-error' : '' }}">
                                <label for="fax_number" class="control-label">Enter Fax #</label>
                                <input type="text" id="fax_number" name="fax_number"
                                    class="form-control{{ $errors->has('fax_number') ? ' is-invalid' : '' }}"
                                    value="{{ isset($OfficeEdit) ? $OfficeEdit->fax_number : '' }}" autofocus>
                                @if($errors->has('fax_number'))
                                <span class="invalid-feedback">{{ $errors->first('fax_number') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Seventh row ends here --}}

                    {{-- Eighth row starts here --}}
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="control-label">Select Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="1"
                                        {{ isset($OfficeEdit) && $OfficeEdit->status == '1' ? 'selected' : '' }}>Enable
                                    </option>
                                    <option value="0"
                                        {{ isset($OfficeEdit) && $OfficeEdit->status == '0' ? 'selected' : '' }}>Disable
                                    </option>
                                </select>
                                @if($errors->has('status'))
                                <span class="invalid-feedback">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Eighth row ends here --}}

                    <br><br><br>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn red btn-sm">
                                    <span class="glyphicon glyphicon-save">&nbsp;Save</span>
                                </button>
                                <button type="button" onclick="window.location='{{ url('/admin/offices') }}'"
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
@if(!isset($OfficeEdit))
<script>
const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
const p = new RegExp(a.split('').join('|'), 'g')
$('#office_title').keyup(function() {
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