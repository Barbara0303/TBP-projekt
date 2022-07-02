<?php

use App\Http\Controllers\TrudnocaController;
use App\Http\Controllers\TrudnicaController;
use App\Http\Controllers\BolestiController;
use App\Http\Controllers\KontrolaController;
use App\Http\Controllers\UltrazvukController;
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


/* 

// Welcome
Route::get('/', function() {
    return view('welcome');
})->name('welcome');

// Airlines
Route::get('/airlines', [AirlineController::class, 'index'])->name('airlines');
Route::get('/airlines/{id}', [AirlineController::class, 'destroy'])->name('destroy.airlines');
Route::post('/airlines/update', [AirlineController::class, 'update'])->name('update.airlines');
Route::post('/airlines/store', [AirlineController::class, 'store'])->name('store.airlines');
*/

Route::get('/', function() {
    return view('welcome');
})->name('welcome');


// Trudnice
Route::get('/trudnice', [TrudnicaController::class, 'index'])->name('trudnice');
Route::post('/trudnice/store', [TrudnicaController::class, 'store'])->name('store.trudnice');
Route::get('/trudnice/details/{id}', [TrudnicaController::class, 'details'])->name('details.trudnice');

// Bolesti
Route::post('/trudnice/bolesti', [BolestiController::class, 'store'])->name('store.bolesti');


// Pregledi
Route::post('/trudnice/pregled', [KontrolaController::class, 'store'])->name('store.pregled');
Route::post('/trudnice/kontrola', [KontrolaController::class, 'update'])->name('update.pregled');

// Trudnoca
Route::post('/trudnice/trudnoca', [TrudnocaController::class, 'store'])->name('store.trudnoca');

// Bebe
Route::get('/trudnice/trudnoca/details/{id}', [Trudnocacontroller::class, 'index'])->name('trudnoca');
Route::post('/trudnice/trudnoca/details/add', [Trudnocacontroller::class, 'add'])->name('add.bebe');
Route::post('/trudnice/trudnoca/details/edit', [TrudnocaController::class, 'update'])->name('update.bebe');

// UZ
Route::post('/trudnice/ultrazvuk', [UltrazvukController::class, 'store'])->name('store.ultrazvuk');