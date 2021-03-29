<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Receiving;
use App\Models\Disposal;
use App\Models\Vehicle;
use App\Models\Generator;
use Auth;

class DisposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $assets = Asset::all();
        $assets = Asset::where('status', 1)->get();
        $receivings = Receiving::all();
        $disposals = Disposal::all();
        return view('Disposal.index',compact('assets','receivings','disposals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assets = Asset::where('status', 1)->get();
        $receivings = Receiving::all();
        return view('Disposal.index',compact('assets','receivings'));
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
            'reason' => 'required',
            'date' => 'required',
            'price' => 'required',
            
        ]);

        $disposed = new Disposal();
        $disposed->asset_id = $request['asset_id'];
        $disposed->reason = $request['reason'];
        $disposed->date = $request['date'];
        $disposed->price = $request['price'];

        $assetId = $request['asset_id'];

        $disposed_asset = Asset::find($assetId);
        $disposed_asset->status = 1;

        if (count(Vehicle::where('asset_id', $assetId)->get()) > 0 ){
            $disposed_vehicle = Vehicle::where('asset_id', $assetId)->get();
            $disposed_vehicle->status = 1;  

            $disposed->save();
            $disposed_asset->save();
            $disposed_vehicle->save();
            activity()->log('Disposed asset  '.$disposed_asset->name.' vehicle number '.$disposed_vehicle->reg_number);

        } elseif (count (Generator::where('asset_id', $assetId)->get()) > 0) {
            $disposed_generator = Generator::where('asset_id', $assetId)->get();
            $disposed_generator->status = 1;
            activity()->log('Disposed asset  '.$disposed_asset->name.' generator '.$disposed_generator->model);

            $disposed->save();
            $disposed_asset->save();
            $disposed_generator->save();
        } else {
            activity()->log('Disposed asset  '.$disposed_asset->name);
            $disposed->save();
            $disposed_asset->save();
        }
        return redirect()->route('asset.index')->with('success','Asset disposed successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disposed = Disposal::find($id);
        $disposed_asset_id = $disposed->asset_id;
        $assets = Asset::find($disposed_asset_id);
        // $assets = Asset::all();
        $vehicles = Vehicle::all();
        $generators = Generator::all();

        return view('Disposal.show',compact('disposed', 'assets','vehicles','generators'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disposed = Disposal::find($id);
        $disposed_asset_id = $disposed->asset_id;
        $disposed_asset = Asset::find($disposed_asset_id);
        return view('Disposal.edit',compact('disposed','disposed_asset'));
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
        $dispose = Disposal::find($id);
        $dispose->reason = $request['reason'];
        $dispose->date = $request['date'];
        $dispose->price = $request['price'];
        $dispose->save();

        $disposed_asset_id = $dispose->asset_id;
        $disposed_asset = Asset::find($disposed_asset_id);
        activity()->log('updated disposing information of '.$disposed_asset->name.' serial number '.$disposed_asset->serial_number);
        return redirect()->route('disposal.index')->with('success','Disposing information updated successfully.');
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
}
