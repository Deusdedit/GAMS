<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receiving;
use Auth;
use DB;
class ReceivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receivings = Receiving::all();
        
        return view('Receiving.index',compact('receivings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receivings = Receiving::all();
        return view('Receiving.index',compact('receivings'));
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
            'receipt_vocher' => 'required|unique:receivings,receipt_vocher',
            'quantity' => 'required',
            'item' => 'required',
            'supplier' => 'required',
            'condition' => 'required'
        ]);
         
        $received = new Receiving();
        $received->receipt_vocher = $request['receipt_vocher'];
        $received->item = $request['item'];
        $received->quantity = $request['quantity'];
        $received->supplier = $request['supplier'];
        $received->condition = $request['condition'];
        $received->date = $request['date'];
        $received->total_cost = $request['total_cost'];
        
        $received -> save();
        activity()->log('Added information of received item '.$request['item'].' on receipt number '.$request['receipt_vocher']);
        return redirect()->route('receiving.index')->with('success','Receiving is successfully saved.');
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

    public function editReason(Request $request, $id)
    {

        $validatedData = $request->validate([
            'reason' => 'required',
        ]);
        $received = Receiving::find($id);
        $received->reason = Auth::user()->first_name." ".Auth::user()->last_name." edited because ".$request['reason'];
        $received->save();
        activity()->log('Reason to edit received item  '.$received->name.' serial number '.$received->serial_number);
        return redirect()->route('receiving.edit', $id)->with('success', 'Reason added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $received = Receiving::find($id);
        return view('Receiving.edit',compact('received'));
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
            'receipt_vocher' => 'required',
            'quantity' => 'required',
            'item' => 'required',
            'supplier' => 'required',
        ]);

        $received = Receiving::find($id);
        $received_receipt_voucher = $request['receipt_vocher'];

        $received->item = $request['item'];
        $received->quantity = $request['quantity'];
        $received->supplier = $request['supplier'];
        $received->condition = $request['condition'];
        $received->date = $request['date'];
        $received->total_cost = $request['total_cost'];

        $available_reveiving = DB::table('receivings')->where('id', '!=', $id)
                        ->where('receipt_vocher', $received_receipt_voucher)->count();
        if($available_reveiving > 0){
            return redirect()->route('receiving.edit', $id)->withErrors('Receipt voucher entered already exists.');
        } 
        $received->save();
        // Receiving::whereId($id)->update($validatedData);
        activity()->log('Edited information of received item '.$request['item'].' on receipt number '.$request['receipt_vocher']);
        return redirect()->route('receiving.index')->with('success', 'Item Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $received = Receiving::find($id);
        activity()->log('Deleted received item information of '.$received->item.' on ledger number '.$received->ledger_number);
        $received->delete();
        return redirect()->route('receiving.index')->with('success', 'Item deleted successfully');
    }
}
