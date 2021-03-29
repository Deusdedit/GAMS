<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceivingController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\DisposalController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AccidentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ActivateController;
use App\Http\Controllers\AssetReportController;
use App\Http\Controllers\DisposalReportController;
use App\Http\Controllers\AccidentReportController;
use App\Http\Controllers\FuelReportController;
use App\Http\Controllers\MaintenanceReportController;
use App\Http\Controllers\ServiceReportController;
use App\Http\Controllers\Accident_printController;
use App\Http\Controllers\ChangPasswordController;  

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::patch('editReason/{id}',[App\Http\Controllers\AssetController::class, 'editReason'])->name('editReason');
Route::patch('editReasonRec/{id}',[App\Http\Controllers\ReceivingController::class, 'editReason'])->name('editReasonRec');
Route::resource('receiving', ReceivingController::class);
Route::resource('asset', AssetController::class);
Route::resource('disposal', DisposalController::class);
Route::resource('vehicle', VehicleController::class);
Route::resource('generator', GeneratorController::class);
Route::resource('driver', DriverController::class);
Route::resource('maintenance', MaintenanceController::class);
Route::resource('fuel', FuelController::class);
Route::resource('service', ServiceController::class);
Route::resource('accident', AccidentController::class);
Route::resource('user', UserController::class);
Route::resource('reset', ResetController::class);
Route::resource('activate', ActivateController::class);
Route::resource('assetReport', AssetReportController::class);
Route::resource('disposalReport', DisposalReportController::class);
Route::resource('accidentReport', AccidentReportController::class);
Route::resource('fuelReport', FuelReportController::class);
Route::resource('maintenanceReport', MaintenanceReportController::class);
Route::resource('serviceReport', ServiceReportController::class);
Route::resource('update-password',SettingsController::class);
Route::get('change-password', [App\Http\Controllers\ChangPasswordController::class, 'index'])->name('change');
Route::post('change-password', [App\Http\Controllers\ChangPasswordController::class, 'changePassword']);

Route::get('printReportAssetsi/{days}',[App\Http\Controllers\PrintReportController::class, 'asseti'])->name('printReportAssetsi');
Route::post('printReportAssetsc/{days}',[App\Http\Controllers\PrintReportController::class, 'assetc'])->name('printReportAssetsc');

Route::get('printReportAccidents/{days}',[App\Http\Controllers\PrintReportController::class, 'accidents'])->name('printReportAccidents');
Route::post('printReportAccidentsc/{days}',[App\Http\Controllers\PrintReportController::class, 'accidentc'])->name('printReportAccidentsc');

Route::get('printReportDisposals/{days}',[App\Http\Controllers\PrintReportController::class, 'disposals'])->name('printReportDisposals');
Route::post('printReportDisposalsc/{days}',[App\Http\Controllers\PrintReportController::class, 'disposalsc'])->name('printReportDisposalsc');

Route::get('printReportMaintenances/{days}',[App\Http\Controllers\PrintReportController::class, 'maintenances'])->name('printReportMaintenances');
Route::post('printReportMaintenancesc/{days}',[App\Http\Controllers\PrintReportController::class, 'maintenancesc'])->name('printReportMaintenancesc');

Route::get('printReportServices/{days}',[App\Http\Controllers\PrintReportController::class, 'servicesi'])->name('printReportServices');
Route::post('printReportServicesc/{days}',[App\Http\Controllers\PrintReportController::class, 'servicesc'])->name('printReportServicesc');

Route::get('printReportReceivings/{days}',[App\Http\Controllers\PrintReportController::class, 'receivings'])->name('printReportReceivings');
Route::post('printReportReceivingsc/{days}',[App\Http\Controllers\PrintReportController::class, 'receivingsc'])->name('printReportReceivingsc');

Route::get('printReportFuels/{days}',[App\Http\Controllers\PrintReportController::class, 'fuels'])->name('printReportFuels');
Route::post('printReportFuelsc/{days}',[App\Http\Controllers\PrintReportController::class, 'fuelsc'])->name('printReportFuelsc');

Route::post('printReportAssets/{days}',[App\Http\Controllers\PrintReportController::class, 'asseti'])->name('printReportAssets');
Route::get('receivingReport',[App\Http\Controllers\PrintReportController::class, 'receive'])->name('receivingReport');

Route::get('printReportAsset',[App\Http\Controllers\PrintReportController::class, 'asset'])->name('printReportasset');
Route::get('printReportAccident',[App\Http\Controllers\PrintReportController::class, 'accident'])->name('printReportAccident');
Route::get('printReportDisposal',[App\Http\Controllers\PrintReportController::class, 'disposal'])->name('printReportDisposal');
Route::get('printReportReceiving',[App\Http\Controllers\PrintReportController::class, 'receiving'])->name('printReportReceiving');
Route::get('printReportFuel',[App\Http\Controllers\PrintReportController::class, 'fuel'])->name('printReportFuel');
Route::get('printReportMaintenance',[App\Http\Controllers\PrintReportController::class, 'maintenance'])->name('printReportMaintenance');
Route::get('printReportService',[App\Http\Controllers\PrintReportController::class, 'service'])->name('printReportService');
Route::get('printReportLogs',[App\Http\Controllers\PrintLogController::class, 'log'])->name('printReportLogs');
Route::get('fuelAssetData/{id}',[App\Http\Controllers\FuelReportController::class, 'getAsset'])->name('fuelAssetData');


