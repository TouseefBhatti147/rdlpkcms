<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Display paginated list of users
    public function index()
    {
        // Retrieve users with pagination
        $users = User::orderBy('created_at', 'desc')->paginate(10); // Paginate by 10 items per page
        return view('admin.users.index-users', compact('users'));
    }

    // Show form to create a new user or handle form submission
    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.usersform');
        } else {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password'
            ];
            $this->validate($request, $rules);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/admin/users')->with('success', 'User has been Added Successfully');
        }
    }
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.users.edit-user', compact('users'));
    }
    // Show form to edit user or handle form submission
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ];
        $this->validate($request, $rules);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('admin/users')->with('success', 'User has been Added Successfully');
    }
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Optionally validate password fields if they are being updated
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the user data
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update the password if it's provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Save the updated user data
        $user->save();

        // Redirect back with a success message
        return redirect('admin/users')->with('success','User has been Updated Successfully');
    }
    // Get all users for DataTables
    public function getAllUsers()
    {
        $data = User::query();
        return DataTables::eloquent($data)
            ->addColumn('action', 'inc.useractions')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    // Delete user
    public function delete($id)
    {
        $user = User::find($id);
        if ($user !== null) {
            try {
                $user->delete();
                $message = "User Deleted Successfully";
                return redirect('admin/users')->with('success', $message);

                return response()->json([
                    'status' => 200,
                    'message' => $message
                ]);

            } catch (\Exception $e) {
                $message =  $e->getMessage();
                return back()->withErrors($message);
            }
        } else {
            return back()->withErrors('User not found');
        }
    }
}