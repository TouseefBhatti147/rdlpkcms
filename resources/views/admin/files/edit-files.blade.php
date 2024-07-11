@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> Edit File</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="page-title">
                    @include('inc.messages')
                </div>
                <form action="{{ route('admin.files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            id="title" name="title" value="{{ old('title', $file->title) }}" required>
                        @if ($errors->has('title'))
                        <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" id="category"
                            name="category" required>
                            <option value="">Select Category</option>
                            <option value="logo" {{ old('category', $file->category) == 'logo' ? 'selected' : '' }}>Logo
                            </option>
                            <option value="slider" {{ old('category', $file->category) == 'slider' ? 'selected' : '' }}>
                                Slider</option>
                            <option value="partnersandassociates"
                                {{ old('category', $file->category) == 'partnersandassociates' ? 'selected' : '' }}>
                                Partners & Associates</option>
                            <option value="brochure"
                                {{ old('category', $file->category) == 'brochure' ? 'selected' : '' }}>Brochure</option>
                            <option value="newsletter"
                                {{ old('category', $file->category) == 'newsletter' ? 'selected' : '' }}>Newsletter
                            </option>
                            <option value="ourgroup"
                                {{ old('category', $file->category) == 'ourgroup' ? 'selected' : '' }}>Our Group
                            </option>
                            <option value="isocertificates"
                                {{ old('category', $file->category) == 'isocertificates' ? 'selected' : '' }}>ISO
                                Certificates</option>
                            <option value="others" {{ old('category', $file->category) == 'others' ? 'selected' : '' }}>
                                Others</option>
                        </select>
                        @if ($errors->has('category'))
                        <span class="invalid-feedback">{{ $errors->first('category') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control-file{{ $errors->has('file') ? ' is-invalid' : '' }}"
                            id="file" name="file">
                        @if ($errors->has('file'))
                        <span class="invalid-feedback">{{ $errors->first('file') }}</span>
                        @endif
                        @if ($file->file)
                        <p><a href="{{ asset('storage/' . $file->file) }}" target="_blank">Current File</a></p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" id="status"
                            name="status" required>
                            <option value="1" {{ old('status', $file->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $file->status) == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        @if ($errors->has('status'))
                        <span class="invalid-feedback">{{ $errors->first('status') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Update File</button>
                    <a href="{{ url('admin/files') }}" class="btn btn-default">Cancel</a>
                </form>
            </div> <!-- Portlet Body ends here -->
        </div><!-- Portlet ends here -->
    </div><!-- Column ends here -->
</div><!-- Row ends here -->
@endsection