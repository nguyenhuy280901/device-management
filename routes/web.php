<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes(['register' => false, 'reset' => false, 'confirm' => false]);

Route::get('/hash/{text}', function() {
    echo Hash::make(request()->text);
});

Route::middleware('auth')->group(function() {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
});
