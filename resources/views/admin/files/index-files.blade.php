@extends('layouts.admin')

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{ url('/admin/home') }}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Manage Files</span>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> Manage Files</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="page-title">
                    @include('inc.messages')
                </div>
                <form method="GET" action="{{ route('files.index') }}">
                    <div class="row" id="search">
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input">
                                <input type="text" name="file_title" id="file_title"
                                    class="form-control{{ $errors->has('file_title') ? ' is-invalid' : '' }}"
                                    placeholder="File Title" value="{{ request('file_title') }}" />
                                <label for="file_title">Title</label>
                                @if($errors->has('file_title'))
                                <span class="invalid-feedback">{{ $errors->first('file_title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input">
                                <select name="file_category" id="file_category" class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="logo" {{ request('file_category') == 'logo' ? 'selected' : '' }}>Logo
                                    </option>
                                    <option value="slider" {{ request('file_category') == 'slider' ? 'selected' : '' }}>
                                        Slider</option>
                                    <option value="partnersandassociates"
                                        {{ request('file_category') == 'partnersandassociates' ? 'selected' : '' }}>
                                        Partners & Associates</option>
                                    <option value="broucher"
                                        {{ request('file_category') == 'broucher' ? 'selected' : '' }}>Brochure</option>
                                    <option value="newsletter"
                                        {{ request('file_category') == 'newsletter' ? 'selected' : '' }}>Newsletter
                                    </option>
                                    <option value="ourgroup"
                                        {{ request('file_category') == 'ourgroup' ? 'selected' : '' }}>Our Group
                                    </option>
                                    <option value="isocertificates"
                                        {{ request('file_category') == 'isocertificates' ? 'selected' : '' }}>ISO
                                        Certificates</option>
                                    <option value="others" {{ request('file_category') == 'others' ? 'selected' : '' }}>
                                        Others</option>
                                </select>
                                <label for="file_category">File Category</label>
                            </div>
                        </div>
                        <div class="form-group col-md-2" style="margin-top: 32px;">
                            <div class="controls">
                                <button type="submit" class="btn red btn-circle form-control">
                                    <span class="glyphicon glyphicon-search"></span> Search
                                </button>
                            </div>
                        </div>
                        <div class="form-group col-md-2" style="margin-top: 32px;">
                            <div class="controls">
                                <a href="{{ route('files.index') }}" class="btn red btn-circle form-control">
                                    <span class="glyphicon glyphicon-refresh"></span> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="{{ url('admin/files/create') }}"
                                    class="btn btn-sm red btn-circle form-control">
                                    Add New <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-bordered table-hover table-checkable order-column no-footer">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                        <tr>
                            <td>{{ $file->title }}</td>
                            <td>{{ $file->category }}</td>
                            <td>{{ $file->status ? 'Enabled' : 'Disabled' }}</td>

                            <td><a href="{{ url('admin/files/show/'.$file->id) }}">View File</a></td>
                            <td>
                                <a href="{{ url('admin/files/edit/'.$file->id) }}" class="btn blue btn-md">
                                    <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                </a>
                                <button type="button" class="btn btn-danger btn-md" data-toggle="modal"
                                    data-target="#deleteModal{{ $file->id }}">
                                    <span class="glyphicon glyphicon-remove-circle">&nbsp;Delete</span>
                                </button>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $file->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete file</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this file?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <form action="{{ url('admin/files/delete/'.$file->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination justify-content-end">
                    {{ $files->links() }}
                </div>
            </div> <!-- Portlet Body ends here -->
        </div><!-- Portlet ends here -->
    </div><!-- Column ends here -->
</div><!-- Row ends here -->
@endsection

@section('scripts')
<!-- You can add custom scripts here if needed -->
@endsection