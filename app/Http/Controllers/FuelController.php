<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fuel;
use App\Models\Vehicle;
use App\Models\Generator;
use App\Models\Receiving;
class FuelController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::where('status', 0)->get();
        $generators = Generator::where('status', 0)->get();
        $fuels = Fuel::all();
        
        return view('Fuel.index',compact('fuels', 'vehicles', 'generators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fuels = Fuel::all();
        $vehicles = Vehicle::where('status', 0)->get();
        $generators = Generator::where('status', 0)->get();
        return view('Fuel.index',compact('fuels','vehicles', 'generators'));
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
            'previous_odometer' => 'required',
            'current_odometer' => 'required',
            'issued' => 'required',
            'requested' => 'required',
            'activity' => 'required',
            'date' => 'required',    
            'cost' => 'required',   
        ]); 
        $fuel = new Fuel();
        $fuel->previous_odometer = $request['previous_odometer'];
        $fuel->current_odometer = $request['current_odometer'];
        $fuel->issued = $request['issued'];
        $fuel->requested = $request['requested'];
        $fuel->activity = $request['activity'];
        $fuel->date = $request['date'];
        $fuel->cost = $request['cost'];
        
        $fuel->generator_id = $request['generator_id'];
        $fuel->vehicle_id = $request['vehicle_id'];
        if($file = $request -> file('attachments'))
        {
        $name = $file -> getClientOriginalName();
        if($file -> move('image', $name))
        {
            $fuel ->attachments = $name;
            $fuel -> save();
        }
        
        }else{}
        $fuel->total_vat = $request['total_vat'];
        $fuel->save();
        activity()->log('Added fuel information of '.$request['date'].' for '.$request['activity']);
        return redirect()->route('vehicle.index')->with('success','Fuel Information added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receivings = Receiving::all();
        $fuels = Fuel::find($id);
        $generators = Generator::all();
        $receivedId = $fuels->receiving_id;
        $vehicles = Vehicle::all();
        return view('Fuel.show',compact('fuels', 'vehicles', 'generators','receivings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fuel = Fuel::find($id);
        $fuel_generator_id = $fuel->generator_id;
        $fuel_generator = Generator::find($fuel_generator_id);
        $generators = Generator::all();

        $fuel_vehicle_id = $fuel->vehicle_id;
        $fuel_vehicle = Vehicle::find($fuel_vehicle_id);
        $vehicles = Vehicle::all();
        return view('Fuel.edit',compact('fuel','fuel_generator','generators','vehicles', 'fuel_vehicle'));
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
            'previous_odometer' => 'required',
            'current_odometer' => 'required',
            'issued' => 'required',
            'requested' => 'required',
            'activity' => 'required',
            'date' => 'required',
           
        ]);

        $fuel = Fuel::find($id);
        
        $fuel->previous_odometer = $request['previous_odometer'];
        $fuel->current_odometer = $request['current_odometer'];
        $fuel->issued = $request['issued'];
        $fuel->requested = $request['requested'];
        $fuel->activity = $request['activity'];
        $fuel->date = $request['date'];
        $fuel->cost = $request['cost'];
        $fuel->total_vat = $request['total_vat'];
        if($request -> hasfile('attachments')){
            $file = $request->file('attachments');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('image/',$filename);
            $fuel ->attachments = $filename;
        }
        
        $fuel->save();
        activity()->log('Edited fuel information of '.$request['date'].' for '.$request['activity']);

        return redirect()->route('fuel.index')->with('success', 'Fuel updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fuels = Fuel::find($id);
        activity()->log('Deleted fuel information of '.$fuels->date.' for '.$fuels->activity);
        $fuels->delete();
        return redirect()->route('fuel.index')->with('success', 'Fuel information deleted successfully');
    }
}
