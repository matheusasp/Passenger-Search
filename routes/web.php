<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('show-info');
    })->name('dashboard');
});


Route::get('/info', [App\Http\Controllers\PassengerController::class, 'getPassanger'])->name('getPassanger.get');

//Route::get('/ticket/{id}', [App\Http\Controllers\PassengerController::class, 'getPassanger'])->name('ticket.ticket.get');