<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    PedidoController,
    ComissaoController,
    FornecedorController,
    ClienteController,
    RepresentadaController,
    TransportadoraController
};

// Autenticação padrão
Auth::routes();

// Página principal (após login)
Route::middleware('auth')->get('/', [UserController::class, 'logged'])->name('main.index');

// Grupo com autenticação
Route::middleware('auth')->group(function () {

    /**
     * USUÁRIOS - Apenas administradores com permissão
     */
    Route::middleware('can:manage-users')->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/form/{id?}', [UserController::class, 'form'])->name('users.form');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::post('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    });

    /**
     * PEDIDOS
     */
    Route::prefix('pedidos')->group(function () {
        Route::get('/', [PedidoController::class, 'index'])->name('pedidos.index');
        Route::get('/form/{id?}', [PedidoController::class, 'form'])->name('pedidos.form');
        Route::post('/store', [PedidoController::class, 'store'])->name('pedidos.store');
        Route::post('/update/{id?}', [PedidoController::class, 'update'])->name('pedidos.update');
        Route::get('/show', [PedidoController::class, 'show'])->name('pedidos.show');
        Route::post('/delete/{id?}', [PedidoController::class, 'delete'])->name('pedidos.delete');

        // Funcionalidades extras
        Route::get('/{pedido}/pdf', [PedidoController::class, 'gerarPdf'])->name('pedidos.pdf');
        Route::get('/{pedido}/imprimir', [PedidoController::class, 'imprimir'])->name('pedidos.imprimir');
        Route::get('/{pedido}/whatsapp', [PedidoController::class, 'whatsapp'])->name('pedidos.whatsapp');
    });

    /**
     * COMISSÕES
     */
    Route::prefix('comissoes')->group(function () {
        Route::get('/', [ComissaoController::class, 'index'])->name('comissoes.index');
        Route::get('/form/{id?}', [ComissaoController::class, 'form'])->name('comissoes.form');
        Route::post('/store', [ComissaoController::class, 'store'])->name('comissoes.store');
        Route::post('/update/{id?}', [ComissaoController::class, 'update'])->name('comissoes.update');
        Route::get('/show', [ComissaoController::class, 'show'])->name('comissoes.show');
        Route::post('/delete/{id?}', [ComissaoController::class, 'delete'])->name('comissoes.delete');

        // Relatórios e exportação
        Route::get('/relatorio', [ComissaoController::class, 'relatorioMensal'])->name('comissoes.relatorio');
        Route::get('/export', [ComissaoController::class, 'export'])->name('comissoes.export');
    });

    /**
     * CLIENTES
     */
    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClienteController::class, 'index'])->name('clientes.index');
        Route::get('/form/{id?}', [ClienteController::class, 'form'])->name('clientes.form');
        Route::post('/store', [ClienteController::class, 'store'])->name('clientes.store');
        Route::post('/update/{id?}', [ClienteController::class, 'update'])->name('clientes.update');
        Route::get('/show', [ClienteController::class, 'show'])->name('clientes.show');
        Route::post('/delete/{id?}', [ClienteController::class, 'delete'])->name('clientes.delete');
    });

    /**
     * FORNECEDORES
     */
    Route::prefix('fornecedores')->group(function () {
        Route::get('/', [FornecedorController::class, 'index'])->name('fornecedores.index');
        Route::get('/form/{id?}', [FornecedorController::class, 'form'])->name('fornecedores.form');
        Route::post('/store', [FornecedorController::class, 'store'])->name('fornecedores.store');
        Route::post('/update/{id?}', [FornecedorController::class, 'update'])->name('fornecedores.update');
        Route::get('/show', [FornecedorController::class, 'show'])->name('fornecedores.show');
        Route::post('/delete/{id?}', [FornecedorController::class, 'delete'])->name('fornecedores.delete');
    });

    /**
     * REPRESENTADAS
     */
    Route::prefix('representadas')->group(function () {
        Route::get('/', [RepresentadaController::class, 'index'])->name('representadas.index');
        Route::get('/form/{id?}', [RepresentadaController::class, 'form'])->name('representadas.form');
        Route::post('/store', [RepresentadaController::class, 'store'])->name('representadas.store');
        Route::post('/update/{id?}', [RepresentadaController::class, 'update'])->name('representadas.update');
        Route::get('/show', [RepresentadaController::class, 'show'])->name('representadas.show');
        Route::post('/delete/{id?}', [RepresentadaController::class, 'delete'])->name('representadas.delete');
    });
/**
     * CRIANDO PEDIDOS
     */
    Route::middleware('auth')->group(function () {
        Route::resource('cadastrodepedido', CadastroDePedidoController::class);
    });

    // FILTROS FINAL
    Route::get('clientes/search', [ClienteController::class, 'search'])->name('clientes.search');
    Route::get('representadas/search', [RepresentadaController::class, 'search'])->name('representadas.search');
    Route::get('transportadoras/search', [TransportadoraController::class, 'search'])->name('transportadoras.search');


    /**
     * TRANSPORTADORAS
     */
    Route::prefix('transportadoras')->group(function () {
        Route::get('/', [TransportadoraController::class, 'index'])->name('transportadoras.index');
        Route::get('/form/{id?}', [TransportadoraController::class, 'form'])->name('transportadoras.form');
        Route::post('/store', [TransportadoraController::class, 'store'])->name('transportadoras.store');
        Route::post('/update/{id?}', [TransportadoraController::class, 'update'])->name('transportadoras.update');
        Route::get('/show', [TransportadoraController::class, 'show'])->name('transportadoras.show');
        Route::post('/delete/{id?}', [TransportadoraController::class, 'delete'])->name('transportadoras.delete');
    });

    Route::get('cadastrodepedido-export', [CadastroDePedidoController::class, 'export'])->name('cadastrodepedido.export');


});
