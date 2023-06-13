<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EssController;
use App\Http\Controllers\PerformaController;


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
Route::resource('ess', EssController::class);
Route::post('self-service',  [EssController::class , 'login'])->name('ess.login');
Route::post("performa-data", [PerformaController::class , 'getData'])->name('performa.getdata');
Route::post("total-data", [PerformaController::class , 'getTotal'])->name('performa.gettotal');

