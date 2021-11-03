<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Models\Application;
use App\Models\Tracking;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

// Route::get('/dashboards', function () {
//     return view('layouts.dashboard');
// })->middleware('visitor');
Route::get('/', function () {
    return redirect()->route('login');
})->name('blank');

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('main',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('main/{date}',[DashboardController::class,'mainEmployee'])->name('dashboard.main.employee');
    Route::get('start',[DashboardController::class,'start'])->name('dashboard.start');
    Route::get('account',[DashboardController::class,'account'])->name('dashboard.account');
    Route::get('join',[DashboardController::class,'joinProject'])->name('dashboard.join');
    Route::get('monitoring',[DashboardController::class,'monitoring'])->name('dashboard.monitoring');
    Route::get('monitoring/{task}/{date}',[DashboardController::class,'monitoringEmployee'])->name('dashboard.monitoring.employee');
    Route::post('toProject',[DashboardController::class,'toProject'])->name('dashboard.toProject');
    Route::post('join',[ProjectController::class,'joinProject'])->name('dashboard.join.accept');
    Route::post('find',[ProjectController::class,'findProject'])->name('dashboard.join.find');
    Route::post('invite',[ProjectController::class,'inviteProject'])->name('dashboard.invite');
    Route::delete('destroy-employee-project/{employee_project}',[ProjectController::class,'destroyEmployeeProject'])->name('dashboard.destroy.employeeProject');
    Route::put('/profile/{id}', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('profile.update.password');
    Route::put('/profile/image/{id}', [App\Http\Controllers\UserController::class, 'updateImage'])->name('profile.update.image');
    Route::resource('/project', App\Http\Controllers\ProjectController::class);
    Route::resource('/task', App\Http\Controllers\TaskController::class);
});

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('/main', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('admin.user');
    Route::get('/room', [App\Http\Controllers\RoomController::class, 'index'])->name('admin.room');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::post('/svm', [App\Http\Controllers\ApplicationController::class, 'svm'])->name('svm');
    Route::resource('/game', App\Http\Controllers\GameController::class);
    Route::resource('/app', App\Http\Controllers\ApplicationController::class);
    Route::resource('/category', App\Http\Controllers\CategoryController::class);
});
