<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportacoesController;
use App\Http\Controllers\HomeContentController;
use App\Http\Controllers\{
    UserController,
    PedidoController,
    ComissaoController,
    FornecedorController,
    ClienteController,
    RepresentadaController,
    TransportadoraController,
    CadastroDePedidoController
};

// Página institucional de boas-vindas
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Autenticação padrão
Auth::routes();

// Página principal (após login)
Route::middleware('auth')->get('/home', [UserController::class, 'logged'])->name('main.index');

// Rotas protegidas
Route::middleware('auth')->group(function () {

    /**
     * USUÁRIOS
     */
    Route::prefix('users')->middleware('can:manage-users')->group(function () {
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

        // Extras
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

        // Relatórios
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

        // Busca AJAX
        Route::get('/search', [ClienteController::class, 'search'])->name('clientes.search');
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

        // Busca AJAX
        Route::get('/search', [RepresentadaController::class, 'search'])->name('representadas.search');
    });

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

        // Busca AJAX
        Route::get('/search', [TransportadoraController::class, 'search'])->name('transportadoras.search');
    });

    /**
     * CADASTRO DE PEDIDOS
     */
    Route::prefix('cadastrodepedido')->group(function () {







        Route::get('/tabela', [CadastroDePedidoController::class, 'showTabela'])->name('cadastrodepedido.tabela');
        Route::get('/export', [CadastroDePedidoController::class, 'export'])->name('cadastrodepedido.export');
        Route::put('/cadastrodepedido/{cadastrodepedido}', [CadastroDePedidoController::class, 'update'])->name('cadastrodepedido.update');
        Route::get('cadastrodepedido/dashboard', [CadastroDePedidoController::class, 'dashboard'])->name('cadastrodepedido.dashboard');


    });


    // Rota do dashboard primeiro!
Route::get('cadastrodepedido/dashboard', [CadastroDePedidoController::class, 'dashboard'])->name('cadastrodepedido.dashboard');

// Depois registra o resource normal
Route::resource('cadastrodepedido', CadastroDePedidoController::class)->except(['show']);
    Route::get('transportadoras/search', [TransportadoraController::class, 'search'])->name('transportadoras.search');


    Route::get('cadastrodepedido/export-excel', [CadastroDePedidoController::class, 'exportExcel'])->name('cadastrodepedido.export.excel');
Route::get('cadastrodepedido/export-pdf', [CadastroDePedidoController::class, 'exportPdf'])->name('cadastrodepedido.export.pdf');




Route::get('/exportar-clientes', [ExportacoesController::class, 'exportarClientes'])->name('exportar.clientes');
Route::get('/exportar-representadas', [ExportacoesController::class, 'exportarRepresentadas'])->name('exportar.representadas');
Route::get('/exportar-transportadoras', [ExportacoesController::class, 'exportarTransportadoras'])->name('exportar.transportadoras');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/home', [HomeContentController::class, 'edit'])->name('admin.home.edit');
    Route::post('/home', [HomeContentController::class, 'update'])->name('admin.home.update');
});


});
