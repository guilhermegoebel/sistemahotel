<?php

use App\Http\Controllers\ClienteController;
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
