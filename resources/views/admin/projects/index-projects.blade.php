@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> Manage Projects</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="page-title">
                    @include('inc.messages')
                </div>
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="{{ url('admin/projects/create') }}">
                                    <button class="btn btn-sm red btn-circle form-control">
                                        Add New <i class="fa fa-plus"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Website</th>
                            <th>Project Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->short_description }}</td>
                            <td>
                                {{ $project->website }}
                            </td>
                            <td>
                                {{ $project->project_status }}
                            </td>
                            <td>
                                <a href="{{ url('admin/projects/edit/'.$project->id) }}" class="btn blue btn-md">
                                    <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                </a>
                                <button type="button" class="btn btn-danger btn-md" data-toggle="modal"
                                    data-target="#deleteModal{{ $project->id }}">
                                    <span class="glyphicon glyphicon-remove-circle">&nbsp;Delete</span>
                                </button>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $project->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Widget</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this project?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <form action="{{ url('admin/projects/delete/'.$project->id) }}" method="POST">
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
                    {{ $projects->links() }}
                </div>
            </div> <!-- Column ends here -->
        </div><!-- Row ends here -->
    </div>
</div>
@endsection

@section('scripts')
<!-- You can add custom scripts here if needed -->
@endsection