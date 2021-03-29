<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fuel;
use App\Models\Vehicle;
use App\Models\Generator;
use App\Models\Receiving;

class FuelReportController extends Controller
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
         
        return view('Reports.fuel',compact('fuels', 'vehicles', 'generators'));
        // return view('filters.fuel_filter');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAsset($id)
    {
        $assetType = $id;
        $generators['data'] = Vehicle::all();
        return response()->json($generators);
        //vehicle
        if($assetType == "1"){
            $generators['data'] = Vehicle::all();
            return response()->json($generators);
        }
        //cycle
        elseif($assetType == "2"){}
        //generator
        elseif($assetType == "3"){
            $generators['data'] = Generator::all();
            return response()->json($generators);
        }
        //all
        else{
            $generators['data'] = Generator::all();
            return response()->json($generators);
        }
    }

}
