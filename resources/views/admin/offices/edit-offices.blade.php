@extends('layouts.app')

@section('content')
<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span
                        class="caption-subject bold uppercase">{{ isset($OfficeEdit) ? 'Edit Office' : 'Create Office' }}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="page-title">
                    @include('inc.messages')
                </div>
                <form method="post"
                    action="{{ isset($OfficeEdit) ? route('offices.update', $OfficeEdit->id) : route('offices.store') }}"
                    class="horizontal-form" enctype="multipart/form-data">
                    @csrf
                    @if(isset($OfficeEdit))
                    @method('PUT')
                    @endif
                    <div class="form-body">
                        {{-- First row starts here --}}
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="office_title" class="control-label">Enter office title</label>
                                    <input type="text" id="office_title" name="office_title"
                                        class="form-control @error('office_title') is-invalid @enderror"
                                        value="{{ old('office_title', $OfficeEdit->office_title ?? '') }}" autofocus
                                        required>
                                    @error('office_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="alias" class="control-label">Alias (Auto Generated)</label>
                                    <input type="text" id="alias" name="alias"
                                        class="form-control @error('alias') is-invalid @enderror"
                                        value="{{ old('alias', $OfficeEdit->alias ?? '') }}"
                                        {{ isset($OfficeEdit) ? 'readonly' : '' }}>
                                    @error('alias')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- First row ends here --}}

                        {{-- Second row starts here --}}
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label for="address" class="control-label">Enter Address</label>
                                    <textarea id="address" name="address" class="form-control" rows="2"
                                        style="resize:none"
                                        placeholder="Enter Address">{{ old('address', $OfficeEdit->address ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Second row ends here --}}

                        {{-- Third row starts here --}}
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="category" class="control-label">Select Office Category</label>
                                    <select id="category" name="category"
                                        class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Select Office category</option>
                                        <option value="head_office"
                                            {{ old('category', $OfficeEdit->category ?? '') == 'head_office' ? 'selected' : '' }}>
                                            Head Office</option>
                                        <option value="corporate_office"
                                            {{ old('category', $OfficeEdit->category ?? '') == 'corporate_office' ? 'selected' : '' }}>
                                            Corporate Office</option>
                                        <option value="sales_and_marketing"
                                            {{ old('category', $OfficeEdit->category ?? '') == 'sales_and_marketing' ? 'selected' : '' }}>
                                            Sales & Marketing Office</option>
                                        <option value="global_office"
                                            {{ old('category', $OfficeEdit->category ?? '') == 'global_office' ? 'selected' : '' }}>
                                            Global Office</option>
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="city" class="control-label">Enter City</label>
                                    <input type="text" id="city" name="city"
                                        class="form-control @error('city') is-invalid @enderror"
                                        value="{{ old('city', $OfficeEdit->city ?? '') }}">
                                    @error('city')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Third row ends here --}}

                        {{-- Fourth row starts here --}}
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="telephone_1" class="control-label">Enter First Telephone #</label>
                                    <input type="text" id="telephone_1" name="telephone_1"
                                        class="form-control @error('telephone_1') is-invalid @enderror"
                                        value="{{ old('telephone_1', $OfficeEdit->telephone_1 ?? '') }}">
                                    @error('telephone_1')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="telephone_2" class="control-label">Second Telephone #</label>
                                    <input type="text" id="telephone_2" name="telephone_2"
                                        class="form-control @error('telephone_2') is-invalid @enderror"
                                        value="{{ old('telephone_2', $OfficeEdit->telephone_2 ?? '') }}">
                                    @error('telephone_2')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Fourth row ends here --}}

                        {{-- Fifth row starts here --}}
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="telephone_3" class="control-label">Third Telephone #</label>
                                    <input type="text" id="telephone_3" name="telephone_3"
                                        class="form-control @error('telephone_3') is-invalid @enderror"
                                        value="{{ old('telephone_3', $OfficeEdit->telephone_3 ?? '') }}">
                                    @error('telephone_3')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="telephone_4" class="control-label">Fourth Telephone #</label>
                                    <input type="text" id="telephone_4" name="telephone_4"
                                        class="form-control @error('telephone_4') is-invalid @enderror"
                                        value="{{ old('telephone_4', $OfficeEdit->telephone_4 ?? '') }}">
                                    @error('telephone_4')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Fifth row ends here --}}

                        {{-- Sixth row starts here --}}
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="email_1" class="control-label">Enter first Email</label>
                                    <input type="email" id="email_1" name="email_1"
                                        class="form-control @error('email_1') is-invalid @enderror"
                                        value="{{ old('email_1', $OfficeEdit->email_1 ?? '') }}">
                                    @error('email_1')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="email_2" class="control-label">Enter second Email</label>
                                    <input type="email" id="email_2" name="email_2"
                                        class="form-control @error('email_2') is-invalid @enderror"
                                        value="{{ old('email_2', $OfficeEdit->email_2 ?? '') }}">
                                    @error('email_2')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Sixth row ends here --}}

                        {{-- Seventh row starts here --}}
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="uan_number" class="control-label">Enter UAN #</label>
                                    <input type="text" id="uan_number" name="uan_number"
                                        class="form-control @error('uan_number') is-invalid @enderror"
                                        value="{{ old('uan_number', $OfficeEdit->uan_number ?? '') }}">
                                    @error('uan_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="fax_number" class="control-label">Enter Fax #</label>
                                    <input type="text" id="fax_number" name="fax_number"
                                        class="form-control @error('fax_number') is-invalid @enderror"
                                        value="{{ old('fax_number', $OfficeEdit->fax_number ?? '') }}">
                                    @error('fax_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Seventh row ends here --}}

                        {{-- Eighth row starts here --}}
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="status" class="control-label">Select Status</label>
                                    <select id="status" name="status"
                                        class="form-control @error('status') is-invalid @enderror">
                                        <option value="1"
                                            {{ old('status', $OfficeEdit->status ?? '') == '1' ? 'selected' : '' }}>
                                            Enable</option>
                                        <option value="0"
                                            {{ old('status', $OfficeEdit->status ?? '') == '0' ? 'selected' : '' }}>
                                            Disable</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Eighth row ends here --}}
                    </div>

                    <div class="form-actions right">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('/admin/offices') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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