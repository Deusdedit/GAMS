<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Receiving;
use App\Models\Vehicle;
use App\Models\Disposal;
use App\Models\Accident;
use App\Models\Driver;
use App\Models\Generator;
use App\Models\Maintenance;
use App\Models\Service;
use App\Models\Fuel;
Use \Carbon\Carbon;
Use \Carbon\CarbonImmutable;
use PDF;
use DB;

class PrintReportController extends Controller
{
    
    public function asset() {
        
        $assets = Asset::where('status', 0)->get();
        $receivings = Receiving::all();
        $pdf = PDF::loadView('Reports.print_asset', compact('assets','receivings'));
        
        return ($pdf->stream('asset Report.pdf'));
    }

    public function accident() {
        
        $vehicles = Vehicle::where('status', 0)->get();
        $drivers = Driver::all();
        $accidents = Accident::all();
        $pdf = PDF::loadView('Reports.print_accident', compact('vehicles','drivers','accidents'));
        
        return ($pdf->stream('Accident Report.pdf'));
    }

    public function disposal() {
        
        $assets = Asset::where('status', 1)->get();
        $disposals = Disposal::all();
        $pdf = PDF::loadView('Reports.print_disposal', compact('assets','disposals'));
        
        return ($pdf->stream('Disposal Report.pdf'));
    }

    public function maintenance() {
        
        $maintenances = Maintenance::all();
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();

        $pdf = PDF::loadView('Reports.print_maintenance', compact('maintenances','generators', 'vehicles'));
        
        return ($pdf->stream('Maintenance Report.pdf'));
    }

    public function service() {
        
        $services = Service::all();
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();

        $pdf = PDF::loadView('Reports.print_service', compact('services','generators', 'vehicles'));
        
        return ($pdf->stream('Services Report.pdf'));
    }

    public function asseti(Request $request, $days) {
        
        $receivings = Receiving::all();
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $todays_date = CarbonImmutable::now('Africa/Dar_es_Salaam');
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');

        if($days == 'today'){
            
            $heading = 'OF '.Carbon::parse($today)->toFormattedDateString();
            $assets = DB::table('assets')->whereDate('purchased_date', '=', $today)
                        ->where('status', 0)->get(); 
            $pdf = PDF::loadView('Reports.print_asset', compact('assets', 'heading', 'receivings', 'today'));
            
        }elseif($days == 'yesterday'){

            $yesterday = Carbon::yesterday('Africa/Dar_es_Salaam')->format('Y-m-d');
            $heading = 'OF '.Carbon::parse($yesterday)->toFormattedDateString();
            $assets = DB::table('assets')->whereDate('purchased_date', '=', $yesterday)
                        ->where('status', 0)->get();
                            
            $pdf = PDF::loadView('Reports.print_asset', compact('assets', 'heading', 'receivings', 'today', 'yesterday'));

        }elseif($days == 'thisweek'){
            
            $weekStartDate = $todays_date->startOfWeek()->format('Y-m-d');
            $weekEndDate = $todays_date->endOfWeek()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($weekStartDate)->toFormattedDateString().' TO '.Carbon::parse($weekEndDate)->toFormattedDateString();
            
            $assets = DB::table('assets')->whereDate('purchased_date', '>=', $weekStartDate)
                        ->whereDate('purchased_date', '<=', $weekEndDate)
                        ->where('status', 0)->get();
                 
            $pdf = PDF::loadView('Reports.print_asset', compact('assets', 'heading', 'receivings', 'weekStartDate', 'weekEndDate', 'today'));
            
        }elseif($days == 'thismonth'){

            $monthStartDate = $todays_date->startOfMonth()->format('Y-m-d');
            $monthEndDate = $todays_date->endOfMonth()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($monthStartDate)->toFormattedDateString().' TO '.Carbon::parse($monthEndDate)->toFormattedDateString();

            $assets = DB::table('assets')->whereDate('purchased_date', '>=', $monthStartDate)
                        ->whereDate('purchased_date', '<=', $monthEndDate)
                        ->where('status', 0)->get();
             
            $pdf = PDF::loadView('Reports.print_asset', compact('assets', 'heading', 'receivings', 'monthStartDate', 'monthEndDate', 'today'));

        }elseif($days == 'thisyear'){

            $yearStartDate = $todays_date->startOfYear()->format('Y-m-d');
            $yearEndDate = $todays_date->endOfYear()->format('Y-m-d'); 
            $heading = 'FROM '.Carbon::parse($yearStartDate)->toFormattedDateString().' TO '.Carbon::parse($yearEndDate)->toFormattedDateString();
                            
            $assets = DB::table('assets')->whereDate('purchased_date', '>=', $yearStartDate)
                        ->whereDate('purchased_date', '<=', $yearEndDate)
                        ->where('status', 0)->get();  
            $pdf = PDF::loadView('Reports.print_asset', compact('assets', 'heading', 'receivings', 'yearStartDate', 'yearEndDate', 'today'));

        }else{
        }
        return ($pdf->stream('Asset Report.pdf'));
    }
    public function assetc(Request $request, $days) {
        
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startingDate = $request['start_date'];
        $endingDate = $request['end_date'];
        $startingDateformated = Carbon::createFromFormat('Y-m-d', $startingDate)->toDateString();
        $endingDateformated = Carbon::createFromFormat('Y-m-d', $endingDate)->toDateString();
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');
        $receivings = Receiving::all();
        $heading = 'FROM '.Carbon::parse($startingDateformated)->toFormattedDateString().' TO '.Carbon::parse($endingDateformated)->toFormattedDateString();

        if($days == 'custom'){
                            
            $assets = DB::table('assets')->whereDate('purchased_date', '>=', $startingDateformated)
                        ->whereDate('purchased_date', '<=', $endingDateformated)
                        ->where('status', 0)->get();
                            
            $pdf = PDF::loadView('Reports.print_asset', compact('assets', 'receivings', 'heading','startingDateformated', 'endingDateformated', 'today'));
        }else{
        }
        return ($pdf->stream('Activity Report.pdf'));
        
    }

    public function accidents(Request $request, $days) {
        

        $vehicles = Vehicle::where('status', 0)->get();
        $drivers = Driver::all();
        
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $todays_date = CarbonImmutable::now('Africa/Dar_es_Salaam');
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');

        if($days == 'today'){
            
            $heading = 'OF '.Carbon::parse($today)->toFormattedDateString();
            $accidents = DB::table('accidents')->whereDate('date', '=', $today)->get();
            $pdf = PDF::loadView('Reports.print_accident', compact('accidents', 'heading','vehicles','drivers', 'today'));
            
        }elseif($days == 'yesterday'){

            $yesterday = Carbon::yesterday('Africa/Dar_es_Salaam')->format('Y-m-d');
            $heading = 'OF '.Carbon::parse($yesterday)->toFormattedDateString();
            $accidents = DB::table('accidents')->whereDate('date', '=', $yesterday)->get();
                            
            $pdf = PDF::loadView('Reports.print_accident', compact('accidents', 'heading', 'vehicles','drivers',  'today', 'yesterday'));

        }elseif($days == 'thisweek'){
            
            $weekStartDate = $todays_date->startOfWeek()->format('Y-m-d');
            $weekEndDate = $todays_date->endOfWeek()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($weekStartDate)->toFormattedDateString().' TO '.Carbon::parse($weekEndDate)->toFormattedDateString();
            
            $accidents = DB::table('accidents')->whereDate('date', '>=', $weekStartDate)
                            ->whereDate('date', '<=', $weekEndDate)->get();
                 
            $pdf = PDF::loadView('Reports.print_accident', compact('accidents', 'heading', 'vehicles','drivers', 'weekStartDate', 'weekEndDate', 'today'));
            
        }elseif($days == 'thismonth'){

            $monthStartDate = $todays_date->startOfMonth()->format('Y-m-d');
            $monthEndDate = $todays_date->endOfMonth()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($monthStartDate)->toFormattedDateString().' TO '.Carbon::parse($monthEndDate)->toFormattedDateString();

            $accidents = DB::table('accidents')->whereDate('date', '>=', $monthStartDate)
                            ->whereDate('date', '<=', $monthEndDate)->get();
             
            $pdf = PDF::loadView('Reports.print_accident', compact('accidents', 'heading', 'vehicles','drivers', 'monthStartDate', 'monthEndDate', 'today'));

        }elseif($days == 'thisyear'){

            $yearStartDate = $todays_date->startOfYear()->format('Y-m-d');
            $yearEndDate = $todays_date->endOfYear()->format('Y-m-d'); 
            $heading = 'FROM '.Carbon::parse($yearStartDate)->toFormattedDateString().' TO '.Carbon::parse($yearEndDate)->toFormattedDateString();
                            
            $accidents = DB::table('accidents')->whereDate('date', '>=', $yearStartDate)
                            ->whereDate('date', '<=', $yearEndDate)->get();

            $pdf = PDF::loadView('Reports.print_accident', compact('accidents', 'heading', 'vehicles', 'drivers', 'yearStartDate', 'yearEndDate', 'today'));

        }else{
        }
        return ($pdf->stream('Asset Report.pdf'));
    }

    public function accidentc(Request $request, $days) {
        
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startingDate = $request['start_date'];
        $endingDate = $request['end_date'];
        $vehicles = Vehicle::where('status', 0)->get();
        $drivers = Driver::all();
        $startingDateformated = Carbon::createFromFormat('Y-m-d', $startingDate)->toDateString();
        $endingDateformated = Carbon::createFromFormat('Y-m-d', $endingDate)->toDateString();
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');
        $heading = 'FROM '.Carbon::parse($startingDateformated)->toFormattedDateString().' TO '.Carbon::parse($endingDateformated)->toFormattedDateString();

        if($days == 'custom'){
            $accidents = DB::table('accidents')->whereDate('date', '>=', $startingDateformated)
                            ->whereDate('date', '<=', $endingDateformated)->get();
                            
            $pdf = PDF::loadView('Reports.print_accident', compact('accidents', 'vehicles', 'drivers', 'heading','startingDateformated', 'endingDateformated', 'today'));
        }else{
        }
        return ($pdf->stream('Activity Report.pdf'));
        
    }

    public function disposals(Request $request, $days) {
                
        $assets = Asset::where('status', 1)->get();
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $todays_date = CarbonImmutable::now('Africa/Dar_es_Salaam');
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');

        if($days == 'today'){
            
            $heading = 'OF '.Carbon::parse($today)->toFormattedDateString();
            $disposals = DB::table('disposals')->whereDate('date', '=', $today)->get();
            $pdf = PDF::loadView('Reports.print_disposal', compact('disposals','assets', 'heading', 'today'));
            
        }elseif($days == 'yesterday'){

            $yesterday = Carbon::yesterday('Africa/Dar_es_Salaam')->format('Y-m-d');
            $heading = 'OF '.Carbon::parse($yesterday)->toFormattedDateString();
            $disposals = DB::table('disposals')->whereDate('date', '=', $yesterday)->get();
                            
            $pdf = PDF::loadView('Reports.print_disposal', compact('disposals','assets', 'heading',  'today', 'yesterday'));

        }elseif($days == 'thisweek'){
            
            $weekStartDate = $todays_date->startOfWeek()->format('Y-m-d');
            $weekEndDate = $todays_date->endOfWeek()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($weekStartDate)->toFormattedDateString().' TO '.Carbon::parse($weekEndDate)->toFormattedDateString();
            
            $disposals = DB::table('disposals')->whereDate('date', '>=', $weekStartDate)
                            ->whereDate('date', '<=', $weekEndDate)->get();
                 
            $pdf = PDF::loadView('Reports.print_disposal', compact('disposals','assets', 'heading', 'weekStartDate', 'weekEndDate', 'today'));
            
        }elseif($days == 'thismonth'){

            $monthStartDate = $todays_date->startOfMonth()->format('Y-m-d');
            $monthEndDate = $todays_date->endOfMonth()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($monthStartDate)->toFormattedDateString().' TO '.Carbon::parse($monthEndDate)->toFormattedDateString();

            $disposals = DB::table('disposals')->whereDate('date', '>=', $monthStartDate)
                            ->whereDate('date', '<=', $monthEndDate)->get();
             
            $pdf = PDF::loadView('Reports.print_disposal', compact('disposals','assets', 'heading', 'monthStartDate', 'monthEndDate', 'today'));

        }elseif($days == 'thisyear'){

            $yearStartDate = $todays_date->startOfYear()->format('Y-m-d');
            $yearEndDate = $todays_date->endOfYear()->format('Y-m-d'); 
            $heading = 'FROM '.Carbon::parse($yearStartDate)->toFormattedDateString().' TO '.Carbon::parse($yearEndDate)->toFormattedDateString();
                            
            $disposals = DB::table('disposals')->whereDate('date', '>=', $yearStartDate)
                            ->whereDate('date', '<=', $yearEndDate)->get();

            $pdf = PDF::loadView('Reports.print_disposal', compact('disposals','assets', 'heading', 'yearStartDate', 'yearEndDate', 'today'));

        }else{
        }
        return ($pdf->stream('Disposal Report.pdf'));
    }

    public function disposalsc(Request $request, $days) {
        
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startingDate = $request['start_date'];
        $endingDate = $request['end_date'];
        $assets = Asset::where('status', 1)->get();
        $startingDateformated = Carbon::createFromFormat('Y-m-d', $startingDate)->toDateString();
        $endingDateformated = Carbon::createFromFormat('Y-m-d', $endingDate)->toDateString();
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');
        $heading = 'FROM '.Carbon::parse($startingDateformated)->toFormattedDateString().' TO '.Carbon::parse($endingDateformated)->toFormattedDateString();

        if($days == 'custom'){
            $disposals = DB::table('disposals')->whereDate('date', '>=', $startingDateformated)
                            ->whereDate('date', '<=', $endingDateformated)->get();
                            
            $pdf = PDF::loadView('Reports.print_disposal', compact('disposals','assets', 'heading','startingDateformated', 'endingDateformated', 'today'));
        }else{
        }
        return ($pdf->stream('Disposal Report.pdf'));
        
    }

    public function maintenances(Request $request, $days) {
        
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $todays_date = CarbonImmutable::now('Africa/Dar_es_Salaam');
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');

        if($days == 'today'){
            
            $heading = 'OF '.Carbon::parse($today)->toFormattedDateString();
            $maintenances = DB::table('maintenances')->whereDate('date', '=', $today)->get();
            $pdf = PDF::loadView('Reports.print_maintenance', compact('maintenances','generators', 'heading','vehicles', 'today'));
            
        }elseif($days == 'yesterday'){

            $yesterday = Carbon::yesterday('Africa/Dar_es_Salaam')->format('Y-m-d');
            $heading = 'OF '.Carbon::parse($yesterday)->toFormattedDateString();
            $maintenances = DB::table('maintenances')->whereDate('date', '=', $yesterday)->get();                            
            $pdf = PDF::loadView('Reports.print_maintenance', compact('maintenances','generators', 'heading', 'vehicles',  'today', 'yesterday'));

        }elseif($days == 'thisweek'){
            
            $weekStartDate = $todays_date->startOfWeek()->format('Y-m-d');
            $weekEndDate = $todays_date->endOfWeek()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($weekStartDate)->toFormattedDateString().' TO '.Carbon::parse($weekEndDate)->toFormattedDateString();
            
            $maintenances = DB::table('maintenances')->whereDate('date', '>=', $weekStartDate)
                            ->whereDate('date', '<=', $weekEndDate)->get(); 
                 
            $pdf = PDF::loadView('Reports.print_maintenance', compact('maintenances','generators', 'heading', 'vehicles', 'weekStartDate', 'weekEndDate', 'today'));
            
        }elseif($days == 'thismonth'){

            $monthStartDate = $todays_date->startOfMonth()->format('Y-m-d');
            $monthEndDate = $todays_date->endOfMonth()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($monthStartDate)->toFormattedDateString().' TO '.Carbon::parse($monthEndDate)->toFormattedDateString();

            $maintenances = DB::table('maintenances')->whereDate('date', '>=', $monthStartDate)
                            ->whereDate('date', '<=', $monthEndDate)->get(); 
             
            $pdf = PDF::loadView('Reports.print_maintenance', compact('maintenances','generators', 'heading', 'vehicles','monthStartDate', 'monthEndDate', 'today'));

        }elseif($days == 'thisyear'){

            $yearStartDate = $todays_date->startOfYear()->format('Y-m-d');
            $yearEndDate = $todays_date->endOfYear()->format('Y-m-d'); 
            $heading = 'FROM '.Carbon::parse($yearStartDate)->toFormattedDateString().' TO '.Carbon::parse($yearEndDate)->toFormattedDateString();
                            
            $maintenances = DB::table('maintenances')->whereDate('date', '>=', $yearStartDate)
                            ->whereDate('date', '<=', $yearEndDate)->get(); 

            $pdf = PDF::loadView('Reports.print_maintenance', compact('maintenances','generators', 'heading', 'vehicles', 'yearStartDate', 'yearEndDate', 'today'));

        }else{
        }
        return ($pdf->stream('Maintenance Report.pdf'));
    }

    public function maintenancesc(Request $request, $days) {
        
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startingDate = $request['start_date'];
        $endingDate = $request['end_date'];
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        $startingDateformated = Carbon::createFromFormat('Y-m-d', $startingDate)->toDateString();
        $endingDateformated = Carbon::createFromFormat('Y-m-d', $endingDate)->toDateString();
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');
        $heading = 'FROM '.Carbon::parse($startingDateformated)->toFormattedDateString().' TO '.Carbon::parse($endingDateformated)->toFormattedDateString();

        if($days == 'custom'){
            $maintenances = DB::table('maintenances')->whereDate('date', '>=', $startingDateformated)
                            ->whereDate('date', '<=', $endingDateformated)->get(); 
                            
            $pdf = PDF::loadView('Reports.print_maintenance', compact('maintenances','generators', 'vehicles', 'heading','startingDateformated', 'endingDateformated', 'today'));
        }else{
        }
        return ($pdf->stream('Maintenance Report.pdf'));
        
    }

    public function servicesi(Request $request, $days) {
        
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $todays_date = CarbonImmutable::now('Africa/Dar_es_Salaam');
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');

        if($days == 'today'){
            
            $heading = 'OF '.Carbon::parse($today)->toFormattedDateString();
            $services = DB::table('services')->whereDate('date', '=', $today)->get();
            $pdf = PDF::loadView('Reports.print_service', compact('services','generators', 'heading','vehicles', 'today'));
            
        }elseif($days == 'yesterday'){

            $yesterday = Carbon::yesterday('Africa/Dar_es_Salaam')->format('Y-m-d');
            $heading = 'OF '.Carbon::parse($yesterday)->toFormattedDateString();
            $services = DB::table('services')->whereDate('date', '=', $yesterday)->get();                            
            $pdf = PDF::loadView('Reports.print_service', compact('services','generators', 'heading', 'vehicles',  'today', 'yesterday'));

        }elseif($days == 'thisweek'){
            
            $weekStartDate = $todays_date->startOfWeek()->format('Y-m-d');
            $weekEndDate = $todays_date->endOfWeek()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($weekStartDate)->toFormattedDateString().' TO '.Carbon::parse($weekEndDate)->toFormattedDateString();
            
            $services = DB::table('services')->whereDate('date', '>=', $weekStartDate)
                            ->whereDate('date', '<=', $weekEndDate)->get(); 
                 
            $pdf = PDF::loadView('Reports.print_service', compact('services','generators', 'heading', 'vehicles', 'weekStartDate', 'weekEndDate', 'today'));
            
        }elseif($days == 'thismonth'){

            $monthStartDate = $todays_date->startOfMonth()->format('Y-m-d');
            $monthEndDate = $todays_date->endOfMonth()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($monthStartDate)->toFormattedDateString().' TO '.Carbon::parse($monthEndDate)->toFormattedDateString();

            $services = DB::table('services')->whereDate('date', '>=', $monthStartDate)
                            ->whereDate('date', '<=', $monthEndDate)->get(); 
             
            $pdf = PDF::loadView('Reports.print_service', compact('services','generators', 'heading', 'vehicles','monthStartDate', 'monthEndDate', 'today'));

        }elseif($days == 'thisyear'){

            $yearStartDate = $todays_date->startOfYear()->format('Y-m-d');
            $yearEndDate = $todays_date->endOfYear()->format('Y-m-d'); 
            $heading = 'FROM '.Carbon::parse($yearStartDate)->toFormattedDateString().' TO '.Carbon::parse($yearEndDate)->toFormattedDateString();
                            
            $services = DB::table('services')->whereDate('date', '>=', $yearStartDate)
                            ->whereDate('date', '<=', $yearEndDate)->get(); 

            $pdf = PDF::loadView('Reports.print_service', compact('services','generators', 'heading', 'vehicles', 'yearStartDate', 'yearEndDate', 'today'));

        }else{
        }
        return ($pdf->stream('Services Report.pdf'));
    }

    public function servicesc(Request $request, $days) {
        
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startingDate = $request['start_date'];
        $endingDate = $request['end_date'];
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        $startingDateformated = Carbon::createFromFormat('Y-m-d', $startingDate)->toDateString();
        $endingDateformated = Carbon::createFromFormat('Y-m-d', $endingDate)->toDateString();
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');
        $heading = 'FROM '.Carbon::parse($startingDateformated)->toFormattedDateString().' TO '.Carbon::parse($endingDateformated)->toFormattedDateString();

        if($days == 'custom'){
            $services = DB::table('services')->whereDate('date', '>=', $startingDateformated)
                            ->whereDate('date', '<=', $endingDateformated)->get(); 
                            
            $pdf = PDF::loadView('Reports.print_service', compact('services','generators', 'vehicles', 'heading','startingDateformated', 'endingDateformated', 'today'));
        }else{
        }
        return ($pdf->stream('Services Report.pdf'));
        
    }

    public function receivings(Request $request, $days) {
        
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $todays_date = CarbonImmutable::now('Africa/Dar_es_Salaam');
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');

        if($days == 'today'){
            
            $heading = 'OF '.Carbon::parse($today)->toFormattedDateString();
            $receivings = DB::table('receivings')->whereDate('date', '=', $today)
                        ->get(); 
            $pdf = PDF::loadView('Reports.print_receiving', compact('heading', 'receivings', 'today'));
            
        }elseif($days == 'yesterday'){

            $yesterday = Carbon::yesterday('Africa/Dar_es_Salaam')->format('Y-m-d');
            $heading = 'OF '.Carbon::parse($yesterday)->toFormattedDateString();
            $receivings = DB::table('receivings')->whereDate('date', '=', $yesterday)
                        ->get();
                            
            $pdf = PDF::loadView('Reports.print_receiving', compact('heading', 'receivings', 'today', 'yesterday'));

        }elseif($days == 'thisweek'){
            
            $weekStartDate = $todays_date->startOfWeek()->format('Y-m-d');
            $weekEndDate = $todays_date->endOfWeek()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($weekStartDate)->toFormattedDateString().' TO '.Carbon::parse($weekEndDate)->toFormattedDateString();
            
            $receivings = DB::table('receivings')->whereDate('date', '>=', $weekStartDate)
                        ->whereDate('date', '<=', $weekEndDate)
                        ->get();
                 
            $pdf = PDF::loadView('Reports.print_receiving', compact('heading', 'receivings', 'weekStartDate', 'weekEndDate', 'today'));
            
        }elseif($days == 'thismonth'){

            $monthStartDate = $todays_date->startOfMonth()->format('Y-m-d');
            $monthEndDate = $todays_date->endOfMonth()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($monthStartDate)->toFormattedDateString().' TO '.Carbon::parse($monthEndDate)->toFormattedDateString();

            $receivings = DB::table('receivings')->whereDate('date', '>=', $monthStartDate)
                        ->whereDate('date', '<=', $monthEndDate)
                        ->get();
             
            $pdf = PDF::loadView('Reports.print_receiving', compact('heading', 'receivings', 'monthStartDate', 'monthEndDate', 'today'));

        }elseif($days == 'thisyear'){

            $yearStartDate = $todays_date->startOfYear()->format('Y-m-d');
            $yearEndDate = $todays_date->endOfYear()->format('Y-m-d'); 
            $heading = 'FROM '.Carbon::parse($yearStartDate)->toFormattedDateString().' TO '.Carbon::parse($yearEndDate)->toFormattedDateString();
                            
            $receivings = DB::table('receivings')->whereDate('date', '>=', $yearStartDate)
                        ->whereDate('date', '<=', $yearEndDate)
                        ->get();  
            $pdf = PDF::loadView('Reports.print_receiving', compact('heading', 'receivings', 'yearStartDate', 'yearEndDate', 'today'));

        }else{
        }
        return ($pdf->stream('Receiving Report.pdf'));
    }
    public function receivingsc(Request $request, $days) {
        
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startingDate = $request['start_date'];
        $endingDate = $request['end_date'];
        $startingDateformated = Carbon::createFromFormat('Y-m-d', $startingDate)->toDateString();
        $endingDateformated = Carbon::createFromFormat('Y-m-d', $endingDate)->toDateString();
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');
        $heading = 'FROM '.Carbon::parse($startingDateformated)->toFormattedDateString().' TO '.Carbon::parse($endingDateformated)->toFormattedDateString();

        if($days == 'custom'){
                            
            $receivings = DB::table('receivings')->whereDate('date', '>=', $startingDateformated)
                        ->whereDate('date', '<=', $endingDateformated)
                        ->get();
                            
            $pdf = PDF::loadView('Reports.print_receiving', compact('receivings', 'heading','startingDateformated', 'endingDateformated', 'today'));
        }else{
        }
        return ($pdf->stream('Receiving Report.pdf'));
        
    }

    public function fuels(Request $request, $days) {
        
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        $now_date = Carbon::now();
        $now_date = Carbon::now('Africa/Dar_es_Salaam');
        $todays_date = CarbonImmutable::now('Africa/Dar_es_Salaam');
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');

        if($days == 'today'){
            
            $heading = 'OF '.Carbon::parse($today)->toFormattedDateString();
            $fuels = DB::table('fuels')->whereDate('date', '=', $today)->get();
            $pdf = PDF::loadView('Reports.print_fuel', compact('fuels','generators', 'heading','vehicles', 'today'));
            
        }elseif($days == 'yesterday'){

            $yesterday = Carbon::yesterday('Africa/Dar_es_Salaam')->format('Y-m-d');
            $heading = 'OF '.Carbon::parse($yesterday)->toFormattedDateString();
            $fuels = DB::table('fuels')->whereDate('date', '=', $yesterday)->get();                            
            $pdf = PDF::loadView('Reports.print_fuel', compact('fuels','generators', 'heading', 'vehicles',  'today', 'yesterday'));

        }elseif($days == 'thisweek'){
            
            $weekStartDate = $todays_date->startOfWeek()->format('Y-m-d');
            $weekEndDate = $todays_date->endOfWeek()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($weekStartDate)->toFormattedDateString().' TO '.Carbon::parse($weekEndDate)->toFormattedDateString();
            
            $fuels = DB::table('fuels')->whereDate('date', '>=', $weekStartDate)
                            ->whereDate('date', '<=', $weekEndDate)->get(); 
                 
            $pdf = PDF::loadView('Reports.print_fuel', compact('fuels','generators', 'heading', 'vehicles', 'weekStartDate', 'weekEndDate', 'today'));
            
        }elseif($days == 'thismonth'){

            $monthStartDate = $todays_date->startOfMonth()->format('Y-m-d');
            $monthEndDate = $todays_date->endOfMonth()->format('Y-m-d');
            $heading = 'FROM '.Carbon::parse($monthStartDate)->toFormattedDateString().' TO '.Carbon::parse($monthEndDate)->toFormattedDateString();

            $fuels = DB::table('fuels')->whereDate('date', '>=', $monthStartDate)
                            ->whereDate('date', '<=', $monthEndDate)->get(); 
             
            $pdf = PDF::loadView('Reports.print_fuel', compact('fuels','generators', 'heading', 'vehicles','monthStartDate', 'monthEndDate', 'today'));

        }elseif($days == 'thisyear'){

            $yearStartDate = $todays_date->startOfYear()->format('Y-m-d');
            $yearEndDate = $todays_date->endOfYear()->format('Y-m-d'); 
            $heading = 'FROM '.Carbon::parse($yearStartDate)->toFormattedDateString().' TO '.Carbon::parse($yearEndDate)->toFormattedDateString();
                            
            $fuels = DB::table('fuels')->whereDate('date', '>=', $yearStartDate)
                            ->whereDate('date', '<=', $yearEndDate)->get(); 

            $pdf = PDF::loadView('Reports.print_fuel', compact('fuels','generators', 'heading', 'vehicles', 'yearStartDate', 'yearEndDate', 'today'));

        }else{
        }
        return ($pdf->stream('Fuels Report.pdf'));
    }

    public function fuelsc(Request $request, $days) {
        
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startingDate = $request['start_date'];
        $endingDate = $request['end_date'];
        $generators = Generator::where('status', 0)->get();
        $vehicles = Vehicle::where('status', 0)->get();
        $startingDateformated = Carbon::createFromFormat('Y-m-d', $startingDate)->toDateString();
        $endingDateformated = Carbon::createFromFormat('Y-m-d', $endingDate)->toDateString();
        $today = Carbon::today('Africa/Dar_es_Salaam')->format('Y-m-d');
        $heading = 'FROM '.Carbon::parse($startingDateformated)->toFormattedDateString().' TO '.Carbon::parse($endingDateformated)->toFormattedDateString();

        if($days == 'custom'){
            $fuels = DB::table('fuels')->whereDate('date', '>=', $startingDateformated)
                            ->whereDate('date', '<=', $endingDateformated)->get(); 
                            
            $pdf = PDF::loadView('Reports.print_fuel', compact('fuels','generators', 'vehicles', 'heading','startingDateformated', 'endingDateformated', 'today'));
        }else{
        }
        return ($pdf->stream('Fuels Report.pdf'));
        
    }
    
    public function fuel() {
        
        $vehicles = Vehicle::where('status', 0)->get();
        $generators = Generator::where('status', 0)->get();
        $fuels = Fuel::all();

        $pdf = PDF::loadView('Reports.print_fuel', compact('vehicles','generators', 'fuels'));
        
        return ($pdf->stream('Fuels Report.pdf'));
    }

    public function receive()
    {
        $receivings = Receiving::all();
        
        return view('Reports.receiving',compact('receivings'));
    }

    public function receiving() {
        
        $receivings = Receiving::all();

        $pdf = PDF::loadView('Reports.print_receiving', compact('receivings'));
        
        return ($pdf->stream('Receiving Report.pdf'));
    }
}
