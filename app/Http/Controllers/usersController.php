<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
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
        $users = Admin::orderBy('created_at', 'desc')->paginate(10); // Paginate by 10 items per page
        return view('admin.users.index-users', compact('users'));
    }

    // Show form to create a new user or handle form submission
    public function create()
    {
        $admin = Auth::guard('admin')->user();
        if ($admin && $admin->id == 5) {
            return view('admin.users.create-user');
        }else{
            return redirect('/admin/users');
        }


    }



    public function store(Request $request)
    {

            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password'
            ];
            $this->validate($request, $rules);

            $user = new Admin();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/admin/users')->with('success', 'User has been Added Successfully');

    }
    public function edit($id)
    {
        $user = Admin::findOrFail($id);
        return view('admin.users.edit-user', compact('user'));
    }
    // Show form to edit user or handle form submission

    public function update(Request $request, $id)
    {
        // Find the admin by ID
        $admin = Admin::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            // Optionally validate password fields if they are being updated
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the admin data
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Only update the password if it's provided
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        // Save the updated admin data
        $admin->save();

        // Redirect back with a success message
        return redirect('admin/users')->with('success', 'Admin has been updated successfully');
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
        $user = Admin::find($id);
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