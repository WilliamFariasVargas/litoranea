<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PedidoController;



Route::get('/pedidos/{pedido}/whatsapp', [PedidoController::class, 'whatsapp'])->name('pedidos.whatsapp');
Route::get('/users/form/{id?}', [UserController::class, 'form'])->name('users.form');

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->middleware('can:manage-users');
});

Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::get('/users/form/{id?}', [UserController::class, 'form'])->name('users.form');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
});
Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/' , [\App\Http\Controllers\UserController::class, 'logged'])->name('main.index');
});

Auth::routes();


Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::get('/users/form/{id?}', [UserController::class, 'form'])->name('users.form');
});

Route::prefix('main')->middleware('auth')->group(function () {
    Route::get('/' , [\App\Http\Controllers\UserController::class, 'logged'])->name('main.index');
});

Route::prefix('fornecedores')->middleware('auth')->group(function () {
    Route::get('/' , [\App\Http\Controllers\FornecedorController::class, 'index'])->name('main.fornecedores');
    Route::get('/form/{id?}', [\App\Http\Controllers\FornecedorController::class, 'form'])->name('fornecedores.form');
    Route::post('/store', [\App\Http\Controllers\FornecedorController::class, 'store'])->name('fornecedores.store');
    Route::post('/update/{id?}', [\App\Http\Controllers\FornecedorController::class, 'update'])->name('fornecedores.update');
    Route::get('/show', [\App\Http\Controllers\FornecedorController::class, 'show'])->name('fornecedores.show');
    Route::post('/delete/{id?}', [\App\Http\Controllers\FornecedorController::class, 'delete'])->name('fornecedores.delete');
});

Route::prefix('clientes')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\ClienteController::class, 'index'])->name('main.clientes');
    Route::get('/form/{id?}', [\App\Http\Controllers\ClienteController::class, 'form'])->name('clientes.form');
    Route::post('/store', [\App\Http\Controllers\ClienteController::class, 'store'])->name('clientes.store');
    Route::post('/update/{id?}', [\App\Http\Controllers\ClienteController::class, 'update'])->name('clientes.update');
    Route::get('/show', [\App\Http\Controllers\ClienteController::class, 'show'])->name('clientes.show');
    Route::post('/delete/{id?}', [\App\Http\Controllers\ClienteController::class, 'delete'])->name('clientes.delete');
});

Route::prefix('comissoes')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\ComissaoController::class, 'index'])->name('main.comissoes');
    Route::get('/form/{id?}', [\App\Http\Controllers\ComissaoController::class, 'form'])->name('comissoes.form');
    Route::post('/store', [\App\Http\Controllers\ComissaoController::class, 'store'])->name('comissoes.store');
    Route::post('/update/{id?}', [\App\Http\Controllers\ComissaoController::class, 'update'])->name('comissoes.update');
    Route::get('/show', [\App\Http\Controllers\ComissaoController::class, 'show'])->name('comissoes.show');
    Route::post('/delete/{id?}', [\App\Http\Controllers\ComissaoController::class, 'delete'])->name('comissoes.delete');
});

Route::prefix('pedidos')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\PedidoController::class, 'index'])->name('main.pedidos');
    Route::get('/form/{id?}', [\App\Http\Controllers\PedidoController::class, 'form'])->name('pedidos.form');
    Route::post('/store', [\App\Http\Controllers\PedidoController::class, 'store'])->name('pedidos.store');
    Route::post('/update/{id?}', [\App\Http\Controllers\PedidoController::class, 'update'])->name('pedidos.update');
    Route::get('/show', [\App\Http\Controllers\PedidoController::class, 'show'])->name('pedidos.show');
    Route::post('/delete/{id?}', [\App\Http\Controllers\PedidoController::class, 'delete'])->name('pedidos.delete');
});

Route::prefix('representadas')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\RepresentadaController::class, 'index'])->name('main.representadas');
    Route::get('/form/{id?}', [\App\Http\Controllers\RepresentadaController::class, 'form'])->name('representadas.form');
    Route::post('/store', [\App\Http\Controllers\RepresentadaController::class, 'store'])->name('representadas.store');
    Route::post('/update/{id?}', [\App\Http\Controllers\RepresentadaController::class, 'update'])->name('representadas.update');
    Route::get('/show', [\App\Http\Controllers\RepresentadaController::class, 'show'])->name('representadas.show');
    Route::post('/delete/{id?}', [\App\Http\Controllers\RepresentadaController::class, 'delete'])->name('representadas.delete');
});

Route::prefix('transportadoras')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\TransportadoraController::class, 'index'])->name('main.transportadoras');
    Route::get('/form/{id?}', [\App\Http\Controllers\TransportadoraController::class, 'form'])->name('transportadoras.form');
    Route::post('/store', [\App\Http\Controllers\TransportadoraController::class, 'store'])->name('transportadoras.store');
    Route::post('/update/{id?}', [\App\Http\Controllers\TransportadoraController::class, 'update'])->name('transportadoras.update');
    Route::get('/show', [\App\Http\Controllers\TransportadoraController::class, 'show'])->name('transportadoras.show');
    Route::post('/delete/{id?}', [\App\Http\Controllers\TransportadoraController::class, 'delete'])->name('transportadoras.delete');
});


Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::resource('pedidos', PedidoController::class);
Route::get('pedidos/{pedido}/pdf', [PedidoController::class, 'gerarPdf'])->name('pedidos.pdf');
Route::get('pedidos/{pedido}/imprimir', [PedidoController::class, 'imprimir'])->name('pedidos.imprimir');

