<?php

namespace App\Http\Controllers;

use App\Models\CadastroDePedido;
use Illuminate\Http\Request;
use App\Exports\CadastroDePedidoExport;
use Maatwebsite\Excel\Facades\Excel;

public function export(Request $request)
{
    return Excel::download(new CadastroDePedidoExport($request), 'pedidos.xlsx');
}

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

    public function update(Request $request, $id)
    {
        $pedido = CadastroDePedido::findOrFail($id);
        $pedido->update($request->all());

        return response()->json(['message' => 'Pedido atualizado com sucesso!']);
    }

    public function destroy($id)
    {
        $pedido = CadastroDePedido::findOrFail($id);
        $pedido->delete();

        return response()->json(['message' => 'Pedido excluído com sucesso!']);
    }
}
