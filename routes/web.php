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
Route::get('/', function() {
    return to_route('my-equipment.index');
});

Route::middleware('auth')->group(function() {
    Route::resource('category', \App\Http\Controllers\CategoryController::class);
    Route::resource('department', \App\Http\Controllers\DepartmentController::class);
    Route::resource('role', \App\Http\Controllers\RoleController::class);
    Route::resource('authorize', \App\Http\Controllers\Auth\AuthorizeController::class);

    Route::resource('employee', \App\Http\Controllers\Employee\EmployeeController::class)->except('index', 'show');
    Route::resource('all-employee', \App\Http\Controllers\Employee\ViewAllEmployeeController::class)->only('index', 'show');
    Route::resource('department-employee', \App\Http\Controllers\Employee\ViewDepartmentEmployeeController::class)->only('index', 'show');
    
    Route::resource('equipment', \App\Http\Controllers\Equipment\EquipmentController::class)->except('index', 'show');
    Route::resource('my-equipment', \App\Http\Controllers\Equipment\ViewAlocatedEquipmentController::class)->only('index', 'show');
    Route::resource('department-equipment', \App\Http\Controllers\Equipment\ViewDepartmentEquipmentController::class)->only('index', 'show');
    Route::resource('all-equipment', \App\Http\Controllers\Equipment\ViewAllEquipmentController::class)->only('index', 'show');

    Route::prefix('booking')->group(function() {
        Route::resource('my-booking', \App\Http\Controllers\Booking\ViewSelfBookingController::class)->only('index', 'show');
        Route::resource('department-booking', \App\Http\Controllers\Booking\ViewDepartmentBookingController::class)->only('index', 'show');
        Route::resource('all-booking', \App\Http\Controllers\Booking\ViewAllBookingController::class)->only('index', 'show');
        
        Route::resource('approve-booking-manager', \App\Http\Controllers\Booking\ApproveBookingManagerController::class)->only('update');
        Route::resource('approve-booking-director', \App\Http\Controllers\Booking\ApproveBookingDirectorController::class)->only('update');
        
        Route::resource('allocate', \App\Http\Controllers\Booking\AllocateDeviceController::class)->only('update');
        Route::resource('recover', \App\Http\Controllers\Booking\RecoverController::class)->only('update');
        Route::resource('book-device', \App\Http\Controllers\Booking\BookDeviceController::class)->only('create', 'store');
    });

    Route::resource('my-information', \App\Http\Controllers\AccountController::class)->only('index');
    Route::resource('change-password', \App\Http\Controllers\Auth\ChangePasswordController::class)->only('index', 'update');
});