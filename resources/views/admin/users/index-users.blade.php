@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> Manage Users</span>
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
                                <a href="{{ url('admin/users/create') }}">
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Title</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->job_title }}</td>
                            <td>
                                {{ $user->created_at }}
                            </td>
                            <td>
                                {{ $user->updated_at }}
                            </td>
                            <td>
                                @if(auth()->check() && auth()->user()->id == 3)
                                <a href="{{ url('admin/users/edit/'.$user->id) }}" class="btn blue btn-md">
                                    <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                </a>
                                <button type="button" class="btn btn-danger btn-md" data-toggle="modal"
                                    data-target="#deleteModal{{ $user->id }}">
                                    <span class="glyphicon glyphicon-remove-circle">&nbsp;Delete</span>
                                </button>
                                @else
                                <button type="button" class="btn btn-default btn-md" disabled>
                                    <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                </button>
                                <button type="button" class="btn btn-default btn-md" disabled>
                                    <span class="glyphicon glyphicon-remove-circle">&nbsp;Delete</span>
                                </button>
                                @endif
                            </td>

                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog"
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
                                        Are you sure you want to delete this User?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <form action="{{ url('admin/users/delete/'.$user->id) }}" method="POST">
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
                    {{ $users->links() }}
                </div>
            </div> <!-- Column ends here -->
        </div><!-- Row ends here -->
    </div>
</div>
@endsection

@section('scripts')
<!-- You can add custom scripts here if needed -->
@endsection