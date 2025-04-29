<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;

class clienteController extends Controller
{
    public function index()
    {
        return view('main.clientes.index');
    }

    /**
     * Exibe o formulário de criação/edição de clientes.
     */
    public function form(Request $request, $id = '')
    {
        $cliente = cliente::find($id);
        return view('main.clientes.form', compact('cliente'));
    }

    /**
     * Exibe a tabela de clientes ordenada por razão social.
     */
    public function show()
    {
        $clientes = cliente::orderBy('razao_social', 'asc')->get();
        return view('main.clientes.table', compact('clientes'));
    }

    /**
     * Armazena uma nova cliente.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'razao_social' => 'required|string|max:255',
                'cpf_cnpj'     => 'required|string|unique:clientes,cpf_cnpj',
                'email'        => 'required|email|unique:clientes,email',
            ]);

            $cliente = cliente::create($request->all());

            return response()->json([
                'id_cliente' => $cliente->id,
                'message'         => "Registro salvo com sucesso"
            ], 201);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma cliente existente.
     */
    public function update(Request $request, $id = '')
    {
        try {
            $cliente = cliente::find($id);
            if (!$cliente) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }

            // Verifica duplicidade para CPF/CNPJ e e-mail
            if (isset($request->cpf_cnpj)) {
                $exists = cliente::where('id', '!=', $id)
                    ->where('cpf_cnpj', $request->cpf_cnpj)
                    ->first();
                if ($exists) {
                    throw new \Exception("CPF/CNPJ já cadastrado. ID: " . $exists->id);
                }
            }

            if (isset($request->email)) {
                $exists = cliente::where('id', '!=', $id)
                    ->where('email', $request->email)
                    ->first();
                if ($exists) {
                    throw new \Exception("E-mail já cadastrado. ID: " . $exists->id);
                }
            }

            $cliente->update($request->all());

            return response()->json([
                'id_cliente' => $id,
                'message'         => "Registro atualizado com sucesso"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Exclui uma cliente.
     */
    public function delete(Request $request, $id = '')
    {
        try {
            $cliente = cliente::find($id);
            if (!$cliente) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }

            $cliente->delete();

            return response()->json(['message' => "Registro excluído com sucesso"], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }


    public function search(Request $request)
{
    $search = $request->q;

    $query = \App\Models\Cliente::query();

    if (!empty($search)) {
        $query->where('razao_social', 'like', "%{$search}%");
    }

    $clientes = $query->orderBy('razao_social')->limit(20)->get();

    $results = [];

    foreach ($clientes as $item) {
        $results[] = [
            'id' => $item->id,
            'text' => $item->razao_social,
        ];
    }

    return response()->json(['results' => $results]);
}



}
