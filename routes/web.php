<?php

use App\Http\Controllers\RegisteredUserController;
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

Route::middleware(['guest'])->get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/busca-de-bilhetes', function () {
        return view('show-info');
    })->name('show.info');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard-list', [App\Http\Controllers\PassengerController::class, 'listStore'])->name('show.info.list-dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\PassengerController::class, 'listStore'])->name('show.info.list-partner');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware(['auth', 'isAdmin'])
        ->name('register');


Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware(['auth', 'isAdmin']);


Route::get('/info', [App\Http\Controllers\PassengerController::class, 'getPassanger'])->name('getPassanger.get');

//Route::get('/ticket/{id}', [App\Http\Controllers\PassengerController::class, 'getPassanger'])->name('ticket.ticket.get');
