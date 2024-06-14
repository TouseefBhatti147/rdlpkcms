<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Display paginated list of users
    public function index()
    {
        // Retrieve users with pagination
        $users = User::orderBy('created_at', 'desc')->paginate(10); // Adjust the pagination limit as needed

        return view('admin.users', compact('users')); // Pass $users to the view
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

    // Show form to edit user or handle form submission
    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $user = User::findOrFail($id);
            return view('admin.usersform', ['UserEdit' => $user]);
        } else {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6',
                'confirm_password' => 'nullable|same:password'
            ];
            $this->validate($request, $rules);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return redirect('/admin/users')->with('success', 'User has been updated Successfully');
        }
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