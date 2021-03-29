<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        
        $roles = Role::all();
        return view('User.index',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('User.index',compact('users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ]);

        $firstName = ucwords($request['first_name']);
        $secondName = ucwords($request['middle_name']);
        $lastName = ucwords($request['last_name']);
        $passcode = strtoupper($request['last_name']);

        $user = new User();
        $user->first_name = $firstName;
        $user->middle_name = $secondName;
        $user->last_name = $lastName;
        $user->email = $request['email'];
        $user->password = Hash::make($passcode);
        $user->role_id = $request['role_id'];

        $user->save();
        activity()->log('Added new user '.$firstName.' '.$lastName.' email '.$request['email']);
        return redirect()->route('user.index')->with('success','User added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('User.show',compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('User.edit',compact('user','roles'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ]);

        $firstName = ucwords($request['first_name']);
        $secondName = ucwords($request['middle_name']);
        $lastName = ucwords($request['last_name']);

        $user = User::find($id);
        $user->first_name = $firstName;
        $user->middle_name = $secondName;
        $user->last_name = $lastName;
        $user->email = $request['email'];
        $user->role_id = $request['role_id'];

        $user->save();
        activity()->log('Edited user information '.$firstName.' '.$lastName.' email '.$request['email']);

        return redirect()->route('user.index')->with('success','User information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        activity()->log('Deleted user '.$user->first_name.' '.$user->last_name.' email '.$user->email);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'user Deleted successfully');
    }

    public function reset($id)
    {
        $user = User::find($id);
        $passcode = $user->last_name;
        $user->password = Hash::make($passcode);
        return redirect()->route('user.index')->with('success', 'user password reseted successfully');
    }
}
