<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Receiving;
use App\Models\Role;
use Auth;

class AssetController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $assets = Asset::all();
        $assets = Asset::where('status', 0)->get();
        $receivings = Receiving::all();
        $roles = Role::all();
        return view('Asset.index',compact('assets','receivings','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $assets = Asset::all();
        $assets = Asset::where('status', 0)->get();
        $receivings = Receiving::all();
        return view('Asset.index',compact('assets','receivings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $condition_test = $request['condition'];
        if($condition_test == 'New'){
            $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'purchased_date' => 'required',
            'condition' => 'required',
            'receiving_id'=> 'required',
            'location' => 'required',
            'ledger_folio' => 'required',
            'cost' => 'required',
            'activity' => 'required',
            ]);
        } else{
            $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'purchased_date' => 'required',
            'condition' => 'required',
            'ledger_folio' => 'required',
            'cost' => 'required',
            'location' => 'required',
            'activity' => 'required',
            ]);
        }
        
        $asseted = new Asset();
        $asseted->name = $request['name'];
        $asseted->category = $request['category'];
        $asseted->purchased_date = $request['purchased_date'];
        $asseted->condition = $request['condition'];
        $asseted->serial_number = $request['serial_number'];
        $asseted->product_number = $request['product_number'];
        $asseted->ledger_folio = $request['ledger_folio'];
        $asseted->cost = $request['cost'];
        $asseted->location = $request['location'];
        $asseted->activity = $request['activity'];
        $asseted->receiving_id = $request['receiving_id'];
        $asseted->user_id = Auth::user()->id;
        $asseted->save();
        activity()->log('Added new asset  '.$request['name'].' serial number '.$request['serial_number']);
        
        return redirect()->route('asset.index')->with('success','Asset successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assets = Asset::find($id);
        $receivings = Receiving::all();
        $receivedId = $assets->receiving_id;

        return view('Asset.show',compact('assets', 'receivings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assets = Asset::find($id);
        $received_asset_id = $assets->receiving_id;
        $received_asset = Receiving::find($received_asset_id);
        $receivings = Receiving::all();
        return view('Asset.edit',compact('assets','receivings','received_asset'));
    }

    public function editReason(Request $request, $id)
    {

        $validatedData = $request->validate([
            'reason' => 'required',
        ]);
        $asseted = Asset::find($id);
        $asseted->reason = Auth::user()->first_name." ".Auth::user()->last_name." edited because ".$request['reason'];
        $asseted->save();
        activity()->log('Reason to edit asset  '.$asseted->name.' serial number '.$asseted->serial_number);
        return redirect()->route('asset.edit', $id)->with('success', 'Reason added successfully');
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
            'name' => 'required',
            'category' => 'required',
            'purchased_date' => 'required',
            /* 'condition' => 'required', */
            'serial_number' => 'required',
            'product_number' => 'required',
            'location' => 'required',
            'activity' => 'required',
            'cost' => 'required',
        ]);

        $asseted = Asset::find($id);
        // $asseted = new Asset();
        $asset_reciving_id = $asseted->receiving_id;
        /* $asset_condition =$asseted->condition; */
        $asseted->name = $request['name'];
        $asseted->category = $request['category'];
        $asseted->purchased_date = $request['purchased_date'];
        $asset_condition = $request['condition'];
        $asseted->serial_number = $request['serial_number'];
        $asseted->product_number = $request['product_number'];
        $asseted->location = $request['location'];
        $asseted->activity = $request['activity'];
        $asset_reciving_id = $request['receiving_id'];
        $asseted->cost=$request['cost'];
        
        if($asset_condition !=NULL){
            $asseted->condition =$asset_condition;
        }
        if($asset_reciving_id !=NULL){
            $asseted->receiving_id = $asset_reciving_id;
        }


    
        $asseted->user_id = Auth::user()->id;
        $asseted->save();
        activity()->log('Edited asset  '.$request['name'].' serial number '.$request['serial_number']);
        // Asset::whereId($id)->update($validatedData);

        return redirect()->route('asset.index')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assets = Asset::find($id);
        activity()->log('Deleted asset  '.$assets->name.' serial number '.$assets->serial_number);
        $assets->delete();
        return redirect()->route('asset.index')->with('success', 'Item deleted successfully');
    }
}
