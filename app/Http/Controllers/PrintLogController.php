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
use PDF;

class PrintLogController extends Controller
{
    public function log()
    {
        $userCount = User::count();
        $log = Activity::count();
        $active = User::where('status',0)->count();
        $deactivated = User::where('status',1)->count();
        $all_logs = Activity::all();
        $all_user = User::orderBy('created_at', 'asc')->get();
        
        
        $pdf = PDF::loadView('Reports.print_log', compact('userCount','log','active','deactivated','all_logs','all_user'));
        
        return ($pdf->stream('Activity Logs Report Report.pdf'));
    }
}
