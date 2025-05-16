<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return view('main.clientes.index');
    }

    public function form(Request $request, $id = '')
    {
        $cliente = Cliente::find($id);
        return view('main.clientes.form', compact('cliente'));
    }

    public function show()
    {
        $clientes = Cliente::orderBy('razao_social', 'asc')->get();
        return view('main.clientes.table', compact('clientes'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'razao_social' => 'required|string|max:255',
                'cpf_cnpj'     => 'required|string',
                'email'        => 'nullable|email',
                'email_2'      => 'nullable|email',
                'email_3'      => 'nullable|email',
                'email_4'      => 'nullable|email',
            ]);

            $cliente = Cliente::create($request->all());

            return response()->json([
                'id_cliente' => $cliente->id,
                'message'    => 'Registro salvo com sucesso'
            ], 201);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function update(Request $request, $id = '')
    {
        try {
            $cliente = Cliente::find($id);
            if (!$cliente) {
                return response()->json(['message' => 'Registro não encontrado'], 404);
            }

            $this->validate($request, [
                'razao_social' => 'required|string|max:255',
                'cpf_cnpj'     => 'required|string',
                'email'        => 'nullable|email',
                'email_2'      => 'nullable|email',
                'email_3'      => 'nullable|email',
                'email_4'      => 'nullable|email',
            ]);

            $cliente->update($request->all());

            return response()->json([
                'id_cliente' => $id,
                'message'    => 'Registro atualizado com sucesso'
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id = '')
    {
        try {
            $cliente = Cliente::find($id);
            if (!$cliente) {
                return response()->json(['message' => 'Registro não encontrado'], 404);
            }

            $cliente->delete();

            return response()->json(['message' => 'Registro excluído com sucesso'], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $search = $request->q;
        $query = Cliente::query();

        if (!empty($search)) {
            $query->where('razao_social', 'like', "%{$search}%");
        }

        $clientes = $query->orderBy('razao_social')->limit(20)->get();

        $results = [];
        foreach ($clientes as $item) {
            $results[] = [
                'id'   => $item->id,
                'text' => $item->razao_social,
            ];
        }

        return response()->json(['results' => $results]);
    }
}