<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Generator;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        return view('Service.index',compact('services', 'generators', 'vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        return view('Service.index',compact('services', 'generators', 'vehicles'));
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
            'next_odometer' => 'required',
            'current_odometer' => 'required',
            'date' => 'required',
            'garage' => 'required',
            'supervisor' => 'required',
            'description' => 'required',
            'cost' => 'required',
            'material' => 'required',
            
        ]);

        $service = new Service();
        $service->vehicle_id = $request['vehicle_id'];
        $service->generator_id = $request['generator_id'];
        $service->next_odometer = $request['next_odometer'];
        $service->current_odometer = $request['current_odometer'];
        $service->date = $request['date'];
        $service->garage = $request['garage'];
        $service->supervisor = $request['supervisor'];
        $service->description = $request['description'];
        $service->material = $request['material'];
        $service->cost = $request['cost'];
        $service->total_vat = $request['total_vat'];
        if($file = $request -> file('attachments'))
        {
        $name = $file -> getClientOriginalName();
        if($file -> move('image', $name))
        {
            $service ->attachments = $name;
            $service -> save();
        }

    }else{}
      

        activity()->log('Added service information of '.$request['date'].' supervised by '.$request['supervisor']);
        $service->save();
        return redirect()->route('service.index')->with('success','service details added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serviced = Service::find($id);
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        return view('Service.show',compact('serviced', 'generators', 'vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviced = Service::find($id);
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        return view('Service.edit',compact('serviced','vehicles','generators'));
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
        $service = Service::find($id);
        $service->next_odometer = $request['next_odometer'];
        $service->current_odometer = $request['current_odometer'];
        $service->date = $request['date'];
        $service->garage = $request['garage'];
        $service->supervisor = $request['supervisor'];
        $service->description = $request['description'];
        $service->material = $request['material'];
        $service->cost = $request['cost'];
        $service->total_vat = $request['total_vat'];
        if($request -> hasfile('attachments')){
            $file = $request->file('attachments');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('image/',$filename);
            $service ->attachments = $filename;
        }

        $service->save();
        activity()->log('Edited service information of '.$request['date'].' supervised by '.$request['supervisor']);
        return redirect()->route('service.index')->with('success','Service information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviced = Service::find($id);
        activity()->log('Added service information of '.$serviced->date.' supervised by '.$serviced->supervisor);
        $serviced->delete();
        return redirect()->route('service.index')->with('success', 'Deleted successfully');
    }
}
