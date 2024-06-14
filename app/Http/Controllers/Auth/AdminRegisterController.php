<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;  // Make sure this line is correct

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminRegisterController extends Controller
{
use RegistersUsers;

protected $redirectTo = '/admin/home';

public function __construct()
{
$this->middleware('guest:admin');
}

public function showRegistrationForm()
{
return view('auth.admin-register');
}

protected function validator(array $data)
{
return Validator::make($data, [
'name' => ['required', 'string', 'max:255'],
'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
'password' => ['required', 'string', 'min:8', 'confirmed'],
]);
}

protected function create(array $data)
{
return Admin::create([
'name' => $data['name'],
'email' => $data['email'],
'password' => Hash::make($data['password']),
'job_title' => $data['job_title'] ?? '',  // Provide a default value or get it from the form data
]);
}
}