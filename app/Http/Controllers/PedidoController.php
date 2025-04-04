<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return view('main.pedidos.index');
    }

    public function form(Request $request, $id = '')
    {
        $pedido = ($id != '') ? Pedido::find($id) : null;
        return view('main.pedidos.form', compact('pedido'));
    }

    public function show()
    {
        $pedidos = Pedido::orderBy('data_pedido', 'desc')->get();
        return view('main.pedidos.table', compact('pedidos'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'cliente_id'  => 'required|integer',
                'data_pedido' => 'required|date',
                'status'      => 'required|string',
                'valor_total' => 'required|numeric'
            ]);

            // Regras de negócio e verificações adicionais podem ser implementadas aqui

            $pedido = Pedido::create($request->all());

            return response()->json([
                'id_pedido' => $pedido->id,
                'message'   => "Registro salvo com sucesso"
            ], 201);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function update(Request $request, $id = '')
    {
        try {
            $pedido = Pedido::find($id);
            if (!$pedido) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }
            $pedido->update($request->all());

            return response()->json([
                'id_pedido' => $id,
                'message'   => "Registro atualizado com sucesso"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id = '')
    {
        try {
            $pedido = Pedido::find($id);
            if (!$pedido) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }
            $pedido->delete();

            return response()->json(['message' => "Registro excluído com sucesso"], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}
