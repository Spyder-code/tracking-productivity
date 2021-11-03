<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[App\Http\Controllers\Api\LoginController::class,'login']);
Route::post('tracking-start/{employee_project}',[App\Http\Controllers\Api\DataController::class,'startTracking']);
Route::post('tracking-stop',[App\Http\Controllers\Api\DataController::class,'stopTracking']);
Route::post('tracking-cancel',[App\Http\Controllers\Api\DataController::class,'cancelTracking']);
Route::get('project/{id}',[App\Http\Controllers\Api\DataController::class,'project']);
Route::get('total-time-today/{id}',[App\Http\Controllers\Api\DataController::class,'getTotalTimeToday']);
Route::get('task/{id}',[App\Http\Controllers\Api\DataController::class,'task']);
Route::get('dataset',[App\Http\Controllers\Api\DataController::class,'getDataset']);
Route::post('update-dataset',[App\Http\Controllers\Api\DataController::class,'updateDataset']);
Route::post('app-tracking',[App\Http\Controllers\Api\DataController::class,'appTracking']);
Route::post('capture-tracking',[App\Http\Controllers\Api\DataController::class,'capture']);
Route::put('task/{task}',[App\Http\Controllers\Api\DataController::class,'taskStatus']);
