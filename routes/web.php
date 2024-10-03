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

Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');

Route::get('/cliente/get', [ClienteController::class, 'getAll'])->name('cliente.tabela');

Route::get('/cliente/add', [ClienteController::class, 'formCliente'])->name('cliente.add');

Route::post('/cliente/add', [ClienteController::class, 'add'])->name('cliente.add');

Route::get('/cliente/{id}/edit', [ClienteController::class, 'edit'])->name('cliente.edit');

Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');

Route::delete('/cliente/{id}', [ClienteController::class, 'delete'])->name('cliente.delete');

Route::get('/checkin', [CheckinoutController::class, 'checkin'])->name('checkin.index');

Route::get('/checkout', [CheckinoutController::class, 'checkout'])->name('checkout.index');

Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');

Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');

Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

Route::get('/reservas/{id}', [ReservaController::class, 'show'])->name('reservas.show');

Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');

Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('reservas.update');

Route::delete('/reservas/{id}', [ReservaController::class, 'delete'])->name('reservas.delete');

