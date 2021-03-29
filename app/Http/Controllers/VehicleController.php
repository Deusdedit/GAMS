<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Asset;
use App\Models\Driver;
use App\Models\Receiving;
use App\Models\Maintenance;
use Auth;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::where('status', 0)->get();
        $assets = Asset::where('status', 0)->get();
        $drivers = Driver::all();
        $maintenaces = Maintenance::all();
        
        
        return view('Vehicle.index',compact('vehicles', 'assets', 'drivers','maintenaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::where('status', 0)->get();
        $assets = Asset::where('status', 0)->get();
        return view('Vehicle.index',compact('vehicles'));
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
            'reg_number' => 'required',
            'model' => 'required',
            'capacity' => 'required',
            'engine_number' => 'required',
            'chassis_number' => 'required',
            'manufacturing_date' => 'required',
            'first_used_date' => 'required',
            'first_odometer' => 'required',
            'asset_id' => 'required',
            
        ]);
        $vehicle = new Vehicle();
        $vehicle->reg_number = $request['reg_number'];
        $vehicle->model = $request['model'];
        $vehicle->capacity = $request['capacity'];
        $vehicle->engine_number = $request['engine_number'];
        $vehicle->chassis_number = $request['chassis_number'];
        $vehicle->manufacturing_date = $request['manufacturing_date'];
        $vehicle->first_used_date = $request['first_used_date'];
        $vehicle->first_odometer = $request['first_odometer'];
        $vehicle->asset_id = $request['asset_id'];
        $vehicle->driver_id = $request['driver_id'];
        $vehicle->save();
        activity()->log('Added new vehicle '.$request['model'].' registration number '.$request['reg_number']);

        return redirect()->route('vehicle.index')->with('success','Vehicle added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicles = Vehicle::find($id);
        $receivings = Receiving::all();
        $receivedId = $vehicles->receiving_id;
        return view('Vehicle.show',compact('vehicles', 'receivings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicled_asset_id = $vehicle->asset_id;
        $vehicled_asset = Asset::find($vehicled_asset_id);
        $assets = Asset::all();

        $vehicled_driver_id = $vehicle->driver_id;
        $vehicled_driver = Driver::find($vehicled_driver_id);
        $drivers = Driver::all();
        return view('Vehicle.edit',compact('vehicle','vehicled_asset','assets','drivers', 'vehicled_driver'));
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
            'reg_number' => 'required',
            'model' => 'required',
            'capacity' => 'required',
            'engine_number' => 'required',
            'chassis_number' => 'required',
            'manufacturing_date' => 'required',
            'first_odometer' => 'required',
            
           
        ]);
        $vehicle = Vehicle::find($id);
        $vehicled_asset_id = $vehicle->asset_id;
        $vehicled_asset = Asset::find($vehicled_asset_id);
        $assets = Asset::all();

        $vehicled_driver_id = $vehicle->driver_id;
        $vehicled_driver = Driver::find($vehicled_driver_id);
       /*  $drivers = Driver::all(); */
        $vehicle->reg_number = $request['reg_number'];
        $vehicle->model = $request['model'];
        $vehicle->capacity = $request['capacity'];
        $vehicle->engine_number = $request['engine_number'];
        $vehicle->chassis_number = $request['chassis_number'];
        $vehicle->manufacturing_date = $request['manufacturing_date'];
        $vehicle->first_odometer = $request['first_odometer'];
        $vehicled_asset_id = $request['asset_id'];
        $vehicled_driver_id = $request['driver_id'];
        
        if( $vehicled_asset_id != NULL){
          $vehicle->asset_id = $vehicled_asset_id;
        }
        if($vehicled_driver_id != NULL){
        $vehicle->driver_id = $vehicled_driver_id;
        }
        $vehicle->save();
        $vehicled_asset -> save();
        activity()->log('Edited vehicle information '.$request['model'].' registration number '.$request['reg_number']);

        return redirect()->route('vehicle.index')->with('success', 'vehicle updated successfully');
    



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicles = Vehicle::find($id);
        activity()->log('Deleted vehicle '.$vehicles->model.' registration number '.$vehicles->reg_number);
        $vehicles->delete();
        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully');
    }
}
