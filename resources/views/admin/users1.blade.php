@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Users</h1>

    @include('inc.messages')
    <!-- Include messages for success or error handling -->

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ url('/admin/users/update/'.$user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
    <!-- Pagination links -->

</div>
@endsection

@section('scripts')
<script>
function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // AJAX call to delete user
        $.ajax({
            url: '/admin/users/delete/' + userId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Reload page or update UI as needed
                alert(response.message);
                location.reload(); // eExample: Reload page after deletion
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error deleting user. Please try again.');
            }
        });
    }
}
</script>
@endsection