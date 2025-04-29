<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CadastroDePedido;

class CadastroDePedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = CadastroDePedido::with(['cliente', 'representada', 'transportadora']);

        if ($request->cliente_id) {
            $query->where('cliente_id', $request->cliente_id);
        }
        if ($request->representada_id) {
            $query->where('representada_id', $request->representada_id);
        }
        if ($request->transportadora_id) {
            $query->where('transportadora_id', $request->transportadora_id);
        }
        if ($request->mes) {
            $query->whereMonth('data_pedido', $request->mes);
        }
        if ($request->ano) {
            $query->whereYear('data_pedido', $request->ano);
        }

        $pedidos = $query->get();
        $valor_total = $pedidos->sum('valor_pedido');

        return view('cadastrodepedido.index', compact('pedidos', 'valor_total'));
    }

    public function create()
    {
        return view('cadastrodepedido.create');
    }

    public function store(Request $request)
    {
        CadastroDePedido::create($request->all());

        return response()->json(['message' => 'Pedido cadastrado com sucesso!']);
    }

    public function edit($id)
    {
        $pedido = CadastroDePedido::findOrFail($id);

        return view('cadastrodepedido.edit', compact('pedido'));
    }

    public function update(Request $request, CadastroDePedido $pedido)
{
    // Função interna para converter valores monetários do formato brasileiro para americano
    $convertDecimal = function ($value) {
        if (!$value) return null;
        return str_replace(',', '.', str_replace('.', '', $value));
    };

    $pedido->update([
        'data_pedido'             => $request->data_pedido,
        'cliente_id'              => $request->cliente_id,
        'representada_id'         => $request->representada_id,
        'transportadora_id'       => $request->transportadora_id,
        'valor_pedido'            => $convertDecimal($request->valor_pedido),
        'valor_faturado'          => $convertDecimal($request->valor_faturado),
        'data_faturamento'        => $request->data_faturamento,
        'valor_comissao_parcial'  => $convertDecimal($request->valor_comissao_parcial),
        'valor_comissao_faturada' => $convertDecimal($request->valor_comissao_faturada),
    ]);

    return response()->json([
        'message' => 'Pedido atualizado com sucesso!'
    ]);
}

    public function destroy($id)
    {
        $pedido = CadastroDePedido::findOrFail($id);
        $pedido->delete();

        return response()->json(['message' => 'Pedido excluído com sucesso!']);
    }
    public function show()
    {
        $query = CadastroDePedido::with(['cliente', 'representada', 'transportadora']);

        if (request('cliente_id')) {
            $query->where('cliente_id', request('cliente_id'));
        }

        if (request('representada_id')) {
            $query->where('representada_id', request('representada_id'));
        }

        if (request('transportadora_id')) {
            $query->where('transportadora_id', request('transportadora_id'));
        }

        if (request('mes')) {
            $query->whereMonth('data_pedido', request('mes'));
        }

        if (request('ano')) {
            $query->whereYear('data_pedido', request('ano'));
        }

        $pedidos = $query->get();
        $valor_total = $pedidos->sum('valor_pedido');

        return view('cadastrodepedido.table', compact('pedidos', 'valor_total'));
    }

    public function showTabela()
{
    $query = CadastroDePedido::with(['cliente', 'representada', 'transportadora']);

    if (request('cliente_id')) {
        $query->where('cliente_id', request('cliente_id'));
    }
    if (request('representada_id')) {
        $query->where('representada_id', request('representada_id'));
    }
    if (request('transportadora_id')) {
        $query->where('transportadora_id', request('transportadora_id'));
    }
    if (request('mes')) {
        $query->whereMonth('data_pedido', request('mes'));
    }
    if (request('ano')) {
        $query->whereYear('data_pedido', request('ano'));
    }

    $pedidos = $query->get();
    $valor_total = $pedidos->sum('valor_pedido');

    return view('cadastrodepedido.table', compact('pedidos', 'valor_total'));
}


}
