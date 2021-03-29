<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Accident;
use App\Models\Driver;
use App\Models\Log;
use Auth;

class AccidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::where('status', 0)->get();
        $drivers = Driver::all();
        $accidents = Accident::all();
        return view('Accident.index',compact('vehicles','drivers','accidents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::where('status', 0)->get();
        $drivers = Driver::all();
        $accidents = Accident::all();
        return view('Accident.index',compact('drivers','accidents'));
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
            'location' => 'required',
            'description' => 'required',
            'date' => 'required',
            'passenger' => 'required',
            'type' => 'required',
            'vehicle_status' => 'required',
            
            
        ]);

        $acciden = new Accident();
       
        $acciden->vehicle_id = $request['vehicle_id'];
        $acciden->location = $request['location'];
        $acciden->description = $request['description'];
        $acciden->date = $request['date'];
        $acciden->passenger = $request['passenger'];
        $acciden->type = $request['type'];
        $acciden->vehicle_status = $request['vehicle_status'];
        $acciden_driver_id = $request['driver_id'];

        if($acciden_driver_id == NULL){
            $acciden_driver_id = Vehicle::find($request['vehicle_id'])->driver_id;
            $acciden->driver_id =  $acciden_driver_id ;
        }
        else{
            $acciden->driver_id = $acciden_driver_id;
        }
        $acciden->save();

        $logged = new Log();
        $logged->log_text = "Add new accident";
        $logged->user_id = Auth::user()->id;
        $logged->save();

        $acciden_vehicle = Vehicle::find($request['vehicle_id']);


        activity()->log('Added accident record of  '.$acciden_vehicle->reg_number.' occurred on '.$request['date']);
        return redirect()->route('vehicle.index')->with('success','Accident details added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acciden = Accident::find($id);
        $drivers = Driver::all();
        $vehicles = Vehicle::where('status', 0)->get();
        return view('accident.show',compact('acciden', 'drivers', 'vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acciden = Accident::find($id);
        $drivers = Driver::all();
        $vehicles = Vehicle::where('status', 0)->get();

        $vehicled_driver_id = $acciden->driver_id;
        $vehicled_driver = Driver::find($vehicled_driver_id);

        return view('accident.edit',compact('acciden','drivers','vehicles','vehicled_driver'));
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
        $acciden = Accident::find($id);

       
        $acciden->location = $request['location'];
        $acciden->description = $request['description'];
        $acciden->date = $request['date'];
        $acciden->passenger = $request['passenger'];
        $acciden->type = $request['type'];
        $acciden->vehicle_status = $request['vehicle_status'];
        $acciden_vehicle = Vehicle::find($acciden->vehicle_id);
        $acciden_driver_id = $acciden->driver_id;
        $acciden_driver_id = $request['driver_id'];

        if($acciden_driver_id !=NULL){
            $acciden->driver_id = $acciden_driver_id;
        }

        $acciden->save();
        
        activity()->log('Edited accident record of  '.$acciden_vehicle->reg_number.' occurred on '.$request['date']);
        return redirect()->route('accident.index')->with('success','Accident information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acciden = Accident::find($id);

        $acciden_vehicle = Vehicle::find($acciden->vehicle_id);
        activity()->log('Deleted accident record of  '.$acciden_vehicle->reg_number.' occurred on '.$acciden->date);
        $acciden->delete();
        return redirect()->route('accident.index')->with('success', 'Deleted successfully');
    }
    
}
