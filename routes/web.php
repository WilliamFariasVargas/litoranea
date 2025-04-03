<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/' , [\App\Http\Controllers\UserController::class, 'logged'])->name('main.index');
});

Auth::routes();


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