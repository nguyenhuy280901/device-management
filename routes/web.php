<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes(['register' => false, 'reset' => false, 'confirm' => false]);

Route::middleware('auth')->group(function() {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/category', \App\Http\Controllers\CategoryController::class);
    Route::resource('/equipment', \App\Http\Controllers\EquipmentController::class);
    Route::resource('/employee', \App\Http\Controllers\EmployeeController::class);
    Route::resource('/booking', \App\Http\Controllers\BookingController::class);
    Route::resource('/department', \App\Http\Controllers\DepartmentController::class);
});
