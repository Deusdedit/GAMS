<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::all();
        
        return view('Driver.index',compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drives = Driver::all();
        return view('Driver.index',compact('drives'));
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
            'fullname' => 'required',
            'license' => 'required',
            
        ]);
        Driver::create($validatedData);
        activity()->log('Added new Driver '.$request['fullname'].' license number '.$request['license']);
        
        return redirect()->route('driver.index')->with('success','Driver is successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drived = Driver::find($id);
        return view('Driver.edit',compact('drived'));
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
            'fullname' => 'required',
            'license' => 'required',
            
        ]);
        Driver::whereId($id)->update($validatedData);
        activity()->log('Edited Driver '.$request['fullname'].' license number '.$request['license']);
        return redirect()->route('driver.index')->with('success', 'Driver Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drived = Driver::find($id);
        activity()->log('Deleted Driver '.$drived->fullname.' license number '.$drived->license);
        $drived->delete();
        return redirect()->route('driver.index')->with('success', 'Driver deleted successfully');
    }
}
