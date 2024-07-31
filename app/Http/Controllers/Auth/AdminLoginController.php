<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AdminLoginController extends Controller
{
  public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

 public function showLoginForm()
 {
   return view('auth.admin-login');
 }
 public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login'); // Changed to /login1
    }
 public function login(Request $request)
 {
     // Validate the form data
     $this->validate($request, [
         'email'   => 'required|email',
         'password' => 'required|min:6',
     ]);

     // Attempt to log the user in
     if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
         // If successful, then redirect to their intended location
         return redirect()->intended(route('admin.dashboard'));
     }

     // If unsuccessful, then redirect back to the login with the form data
     return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'These credentials do not match our records.']);

 }

}