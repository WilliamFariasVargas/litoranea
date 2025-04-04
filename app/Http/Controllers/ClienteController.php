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
        $cliente = ($id != '') ? Cliente::find($id) : null;
        return view('main.clientes.form', compact('cliente'));
    }

    public function show()
    {
        $clientes = Cliente::orderBy('nome','asc')->get();
        return view('main.clientes.table', compact('clientes'));
    }


    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nome'      => 'required|string|max:255',
                'sobrenome' => 'required|string|max:255',
                'cpf'       => 'required|string|unique:clientes,cpf',
                'email'     => 'required|email|unique:clientes,email',
            ]);

            $cliente = Cliente::create($request->all());

            return response()->json([
                'id_cliente' => $cliente->id,
                'message'    => "Registro salvo com sucesso"
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
                return response()->json(['message' => "Registro não encontrado"], 404);
            }
            // Verifica duplicidade para CPF e e-mail
            if (isset($request->cpf) && $request->cpf) {
                $exists = Cliente::where('id', '!=', $id)
                    ->where('cpf', $request->cpf)
                    ->first();
                if ($exists) {
                    throw new \Exception("CPF já cadastrado. ID: " . $exists->id);
                }
            }
            if (isset($request->email) && $request->email) {
                $exists = Cliente::where('id', '!=', $id)
                    ->where('email', $request->email)
                    ->first();
                if ($exists) {
                    throw new \Exception("E-mail já cadastrado. ID: " . $exists->id);
                }
            }
            $cliente->update($request->all());

            return response()->json([
                'id_cliente' => $id,
                'message'    => "Registro atualizado com sucesso"
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
                return response()->json(['message' => "Registro não encontrado"], 404);
            }
            $cliente->delete();

            return response()->json(['message' => "Registro excluído com sucesso"], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}
