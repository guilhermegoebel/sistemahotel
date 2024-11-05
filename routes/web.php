<?php

use App\Http\Controllers\CheckinoutController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\QuartoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AcompanhanteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Rotas cliente
Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/add', [ClienteController::class, 'formCliente'])->name('cliente.add');
Route::post('/cliente/add', [ClienteController::class, 'add'])->name('cliente.add');
Route::get('/cliente/{id}/edit', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/cliente/{id}', [ClienteController::class, 'delete'])->name('cliente.delete');

// Rotas quarto
Route::get('/quartos', [QuartoController::class, 'index'])->name('quarto.index');
Route::get('/quartos/create', [QuartoController::class, 'formQuarto'])->name('quarto.add');
Route::post('/quartos', [QuartoController::class, 'add'])->name('quarto.create');
Route::get('/quartos/{id}/edit', [QuartoController::class, 'edit'])->name('quarto.edit');
Route::put('/quartos/{id}', [QuartoController::class, 'update'])->name('quarto.update');
Route::delete('/quartos/{id}', [QuartoController::class, 'delete'])->name('quarto.delete');

//Rotas novas checkin/checkout (historico, para os de reservas ja realizadas)
Route::get('/historico', [CheckinoutController::class, 'historico'])->name('historico.index');

// Rotas reservas
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::get('/reservas/add', [ReservaController::class, 'formReserva'])->name('reservas.add');
Route::post('/reservas/add', [ReservaController::class, 'add'])->name('reservas.add');
Route::get('/reservas/{id}', [ReservaController::class, 'getById'])->name('reservas.show');
Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('reservas.update');
Route::delete('/reservas/{id}', [ReservaController::class, 'delete'])->name('reservas.delete');
Route::put('/reservas/{id}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');


// Rotas CheckInOut (para os de reservas ainda pendentes)
Route::post('/reservas/{id}/checkin', [CheckinOutController::class, 'checkin'])->name('reservas.checkin');
Route::post('/reservas/{id}/checkout', [CheckinOutController::class, 'checkout'])->name('reservas.checkout');
