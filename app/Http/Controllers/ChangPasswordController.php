<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangPasswordController extends Controller
{
    public function index()
    {

      return view('change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
          'current_password' => 'required',
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match!');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        activity()->log('Changed password'.$user->first_name.' '.$user->last_name.' with email '.$user->email);

        return back()->with('success', 'Password successfully changed!');
    }

}
