<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Generator;
use App\Models\Receiving;
use App\Models\Fuel;


use Illuminate\Http\Request;

class GeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $fuels = Fuel::all();
         $generators = Generator::where('status', 0)->get();
        $assets = Asset::where('status', 0)->get();
        return view('Generator.index',compact('generators', 'assets', 'fuels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generators = Generator::where('status', 0)->get();
        $assets = Asset::where('status', 0)->get();
        return view('Generator.index',compact('generators'));
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
            'model' => 'required',
            'capacity' => 'required',
            'manufacturing_date' => 'required',
            'first_used_date' => 'required',
            'first_odometer' => 'required',
            'asset_id' => 'required',
            
        ]);
        $generator = new Generator();
        $generator->model = $request['model'];
        $generator->capacity = $request['capacity'];
        $generator->manufacturing_date = $request['manufacturing_date'];
        $generator->first_used_date = $request['first_used_date'];
        $generator->first_odometer = $request['first_odometer'];
        $generator->asset_id = $request['asset_id'];
        $generator->save();

        activity()->log('Added new Generator '.$request['model'].' capacity '.$request['capacity']);
        return redirect()->route('generator.index')->with('success','Generator added successfully.');

    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $generators = Generator::find($id);
        $receivings = Receiving::all();
        $receivedId = $generators->receiving_id;
        return view('Generator.show',compact('generators', 'receivings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $generator = Generator::find($id);
        $generator_asset_id = $generator->asset_id;
        $generator_asset = Asset::find($generator_asset_id);
        $assets = Asset::all();

        // $vehicled_driver_id = $vehicle->driver_id;
        // $vehicled_driver = Driver::find($vehicled_driver_id);
        // $drivers = Driver::all();
        return view('Generator.edit',compact('generator','generator_asset','assets','generator'));
   
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
            'model' => 'required',
            'capacity' => 'required',
            'manufacturing_date' => 'required',
            'first_used_date' => 'required',
            'first_odometer' => 'required',
            /* 'asset_id' => 'required', */
            
           
        ]);
        $generator = Generator::find($id);
        $generator_asset_id = $generator->asset_id;
        $generator->model = $request['model'];
        $generator->capacity = $request['capacity'];
        $generator->manufacturing_date = $request['manufacturing_date'];
        $generator->first_used_date = $request['first_used_date'];
        $generator->manufacturing_date = $request['manufacturing_date'];
        $generator->first_odometer = $request['first_odometer'];
        $generator_asset_id = $request['asset_id'];

        if($generator_asset_id !=NULL){
            $generator->asset_id = $generator_asset_id;
        }
        $generator->save();
        activity()->log('Edited Generator '.$request['model'].' informations with '.$request['capacity'].' capacity ');

        return redirect()->route('generator.index')->with('success', 'Generator updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $generator = Generator::find($id);
        activity()->log('Deleted Generator '.$generator->model.' with '.$generator->capacity.' capacity ');
        $generator->delete();
        return redirect()->route('generator.index')->with('success', 'Generator deleted successfully');
    }
}
