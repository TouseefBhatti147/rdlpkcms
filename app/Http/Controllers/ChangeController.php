<?php

namespace App\Http\Controllers;


use Auth;
use Hash;
use App\Admin;
use Illuminate\Http\Request;


class ChangeController extends Controller
{
     public function __construct()
      {
       $this->middleware('auth:admin');
      }


    public function changepassword(Request $request)
    {
      if ($request->isMethod('get')){
               return view('auth.changepassword');
      }else{

            if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                 return redirect()->back()->withErrors("Your current password does not matches with the password you provided. Please try again.");}

             if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
                 return redirect()->back()->withErrors("New Password cannot be same as your current password. Please choose a different password.");}

             $this->validate($request, [
               'current_password' => 'required',
               'new_password' => 'required',
               'new_confirm_password' => 'required|same:new_password',
             ]);
          
             //Change Password
             $admin = Auth::user();
             $admin->password = bcrypt($request->get('new_password'));
             $admin->save();
             return redirect()->back()->with("success","Password changed successfully !");

      }
    }
}
