<?php

use App\Http\Controllers\CheckinoutController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReservaController;
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

// Rotas checkin/checkout
Route::get('/checkin', [CheckinoutController::class, 'checkinTela'])->name('checkin.index');
Route::get('/checkout', [CheckinoutController::class, 'checkoutTela'])->name('checkout.index');
Route::post('/reservas/{id}/checkin', [CheckinOutController::class, 'checkin'])->name('reservas.checkin');
Route::post('/reservas/{id}/checkout', [CheckinOutController::class, 'checkout'])->name('reservas.checkout');

// Rotas reservas
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::get('/reservas/add', [ReservaController::class, 'formReserva'])->name('reservas.add');
Route::post('/reservas/add', [ReservaController::class, 'add'])->name('reservas.add');
Route::get('/reservas/{id}', [ReservaController::class, 'getById'])->name('reservas.show');
Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('reservas.update');
Route::delete('/reservas/{id}', [ReservaController::class, 'delete'])->name('reservas.delete');

