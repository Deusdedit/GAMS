<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Generator;
use App\Models\Vehicle;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenances = Maintenance::all();
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        return view('Maintenance.index',compact('maintenances', 'generators', 'vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maintenances = Maintenance::all();
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        return view('Maintenance.index',compact('maintenances', 'generators', 'vehicles'));
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
            'date' => 'required',
            'garage' => 'required',
            'supervisor' => 'required',
            'material' => 'required',
            'description' => 'required',
            'cost' => 'required',
            
        ]);

        $maintained = new Maintenance();
        $maintained->vehicle_id = $request['vehicle_id'];
        $maintained->generator_id = $request['generator_id'];
        $maintained->previous_odometer = $request['previous_odometer'];
        $maintained->current_odometer = $request['current_odometer'];
        $maintained->date = $request['date'];
        $maintained->garage = $request['garage'];
        $maintained->material = $request['material'];
        $maintained->supervisor = $request['supervisor'];
        $maintained->description = $request['description'];
        $maintained->cost = $request['cost'];
        $maintained->total_vat = $request['total_vat'];
        if($file = $request -> file('attachments')){
        $name = $file -> getClientOriginalName();
        if($file -> move('image', $name))
        {
            $maintained ->attachments = $name;
            $maintained -> save();
        }
    }else{}
       

        $maintained->save();
        activity()->log('Added Maintenance information of '.$request['date'].' supervised by '.$request['supervisor']);
        return redirect()->route('maintenance.index')->with('success','Maintenance details added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintenanced = Maintenance::find($id);
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        return view('Maintenance.show',compact('maintenanced', 'generators', 'vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mainted = Maintenance::find($id);
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        return view('Maintenance.edit',compact('mainted','vehicles','generators'));
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
        $maintained = Maintenance::find($id);
        $maintained->previous_odometer = $request['previous_odometer'];
        $maintained->current_odometer = $request['current_odometer'];
        $maintained->date = $request['date'];
        $maintained->garage = $request['garage'];
        $maintained->material = $request['material'];
        $maintained->supervisor = $request['supervisor'];
        $maintained->description = $request['description'];
        $maintained->cost = $request['cost'];
        $maintained->total_vat = $request['total_vat'];
        if($request -> hasfile('attachments')){
            $file = $request->file('attachments');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('image/',$filename);
            $maintained ->attachments = $filename;
        }
        

        $maintained->save();
        activity()->log('Edited Maintenance information of '.$request['date'].' supervised by '.$request['supervisor']);
        return redirect()->route('maintenance.index')->with('success','Maintenance information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maintenanced = Maintenance::find($id);
        activity()->log('Deleted Maintenance information of '.$maintenanced->date.' supervised by '.$maintenanced->supervisor);
        $maintenanced->delete();
        return redirect()->route('maintenance.index')->with('success', 'Deleted successfully');
    }
}
