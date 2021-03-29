<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Log;
use App\Models\Asset;
use App\Models\Disposal;
use App\Models\Receiving;
use App\Models\Vehicle;
use App\Models\Generator;
use App\Models\Driver;
use App\Models\Accident;
use App\Models\Fuel;
use Spatie\Activitylog\Models\Activity;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roleId = auth()->user()->role_id;
        $role = Role::find($roleId);

        // TO starts here
        if ($role->name_abbreviation == 'TO') {
            $vehicles = Vehicle::count();
            $generators = Generator::count();
            $drivers = Driver::count();
            
              /* get accident data of this year */
              $dataArr= [];
              for ($i=1; $i<=12; $i++) {
                    $data = Accident::whereYear('date', 2021);
                    $out = $data->whereMonth('date', $i)->count();
                    array_push($dataArr,$out);
                }
                $tatalAcc = Accident::whereYear('date', 2021)->count();

                /* get accident data of this Last year */
              $dataArrLast= [];
              for ($i=1; $i<=12; $i++) {
                    $dataL = Accident::whereYear('date', 2020);
                    $outL = $dataL->whereMonth('date', $i)->count();
                    array_push($dataArrLast,$outL);
                }

             /* get fuel consuption data of this year */
             $dataFuel= [];
                for ($j=1; $j<=12; $j++) {
                    $dataf = Fuel::whereYear('date', 2021);
                    $outf = $dataf->whereMonth('date', $j)->get()->sum('issued');
                    array_push($dataFuel,$outf);
                }
                    $totalFuel = Fuel::whereYear('date', 2021)->sum('issued');

                        /* get fuel consuption data of this year */
                $dataFuelLast= [];
                for ($j=1; $j<=12; $j++) {
                    $datafl = Fuel::whereYear('date', 2020);
                    $outfl = $datafl->whereMonth('date', $j)->get()->sum('issued');
                    array_push($dataFuelLast,$outfl);
                }

            activity()->log('Logged in ');
            return view('welcomes.to_welcome', compact('dataArr','tatalAcc','dataFuelLast','dataArrLast','totalFuel','vehicles','generators','drivers','dataFuel'));
        } 
        // PMU starts here
        elseif ($role->name_abbreviation == 'PMU') {
            $assets = Asset::where('status',0)->count();
            $receives = Receiving::count();
            $dispose = Disposal::count();

            $assetss = Asset::all();
            $receivess = Receiving::all();

            $counting = 0;
            foreach ($assetss as $asset){
                foreach($receivess as $receive){
                    if($asset->receiving_id == $receive->id){
                        $counting++;
                    }
                }
            }

             /* get Recieved data of this year */
             $dataArrRec= [];
             for ($i=1; $i<=12; $i++) {
                   $dataR = Receiving::whereYear('created_at', 2021);
                   $outR = $dataR->whereMonth('created_at', $i)->count();
                   array_push($dataArrRec,$outR);
               }
               $tatalRec = Receiving::whereYear('created_at', 2021)->count();


                   /* get Assets data of this year */
             $dataArrAsset= [];
             for ($i=1; $i<=12; $i++) {
                   $dataA = Asset::whereYear('created_at', 2021);
                   $outA = $dataA->whereMonth('created_at', $i)->count();
                   array_push($dataArrAsset,$outA);
               }
               $tatalAsse = Asset::whereYear('created_at', 2021)->count();
            activity()->log('Logged in ');
            return view('welcomes.pmu_welcome',compact('assets','counting','dataArrRec','tatalAsse','dataArrAsset','tatalRec','dispose','receives'));
        } 
        // Admin starts here
        elseif ($role->name_abbreviation == 'Admin') {
            $userCount = User::count();
            $log = Activity::count();
            $active = User::where('status',0)->count();
            $deactivated = User::where('status',1)->count();
            $all_logs = Activity::all();
            $all_user = User::orderBy('created_at', 'asc')->get();
            activity()->log('Logged in ');
            return view('welcomes.admin_welcome', compact('all_logs', 'all_user', 'userCount','log','active','deactivated'));
        
        } 
        // Manager here
        elseif ($role->name_abbreviation == 'MA') {

            $all_logs = Activity::all();
            $all_user = User::orderBy('created_at', 'asc')->get();

             /* get recievings data of this year */
             $dataRec= [];
             for ($i=1; $i<=12; $i++) {
                   $data = Receiving::whereYear('created_at', 2021);
                   $out = $data->whereMonth('created_at', $i)->count();
                   array_push($dataRec,$out);
               }
               $tatalRec = Receiving::whereYear('created_at', 2021)->count();

               /* get recievings data of this Last year */
             $dataRecLast= [];
             for ($i=1; $i<=12; $i++) {
                   $dataL = Receiving::whereYear('created_at', 2020);
                   $outL = $dataL->whereMonth('created_at', $i)->count();
                   array_push($dataRecLast,$outL);
               }

            /* get asset data of this year */
            $dataAsse= [];
               for ($j=1; $j<=12; $j++) {
                   $dataf = Asset::whereYear('created_at', 2021);
                   $outf = $dataf->whereMonth('created_at', $j)->count();
                   array_push($dataAsse,$outf);
               }
                   $totalAsse = Asset::whereYear('created_at', 2021)->count();

                       /* get asset data of last year */
               $dataAsseLast= [];
               for ($j=1; $j<=12; $j++) {
                   $datafl = Asset::whereYear('created_at', 2020);
                   $outfl = $datafl->whereMonth('created_at', $j)->count();
                   array_push($dataAsseLast,$outfl);
               }


            activity()->log('Logged in ');
            return view('welcomes.manager_welcome',compact('dataRec','tatalRec','dataRecLast','dataAsse','totalAsse','dataAsseLast'));
        } 

        elseif ($role->name_abbreviation == 'PDE') {
            $assets = Asset::where('status',0)->count();
            $receives = Receiving::count();
            $dispose = Disposal::count();

            $assetss = Asset::all();
            $receivess = Receiving::all();

            $counting = 0;
            foreach ($assetss as $asset){
                foreach($receivess as $receive){
                    if($asset->receiving_id == $receive->id){
                        $counting++;
                    }
                }
            }

             /* get Recieved data of this year */
             $dataArrRec= [];
             for ($i=1; $i<=12; $i++) {
                   $dataR = Receiving::whereYear('created_at', 2021);
                   $outR = $dataR->whereMonth('created_at', $i)->count();
                   array_push($dataArrRec,$outR);
               }
               $tatalRec = Receiving::whereYear('created_at', 2021)->count();


                   /* get Assets data of this year */
             $dataArrAsset= [];
             for ($i=1; $i<=12; $i++) {
                   $dataA = Asset::whereYear('created_at', 2021);
                   $outA = $dataA->whereMonth('created_at', $i)->count();
                   array_push($dataArrAsset,$outA);
               }
               $tatalAsse = Asset::whereYear('created_at', 2021)->count();
            activity()->log('Logged in ');
            return view('welcomes.pmu_welcome',compact('assets','counting','dataArrRec','tatalAsse','dataArrAsset','tatalRec','dispose','receives'));
        } 
        // Nothing
        else {

            auth()->logout();
            // return view('auth.logout');
        }
        // return view('home');
        
    }
}
