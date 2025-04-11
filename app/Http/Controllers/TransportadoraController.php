<?php

namespace App\Http\Controllers;

use App\Models\Transportadora;
use Illuminate\Http\Request;

class TransportadoraController extends Controller
{
    public function index()
    {
        return view('main.transportadoras.index');
    }

    public function form(Request $request, $id = '')
    {
        $transportadora = ($id != '') ? Transportadora::find($id) : null;
        return view('main.transportadoras.form', compact('transportadora'));
    }

    public function show()
    {
        // Ordena pela razão social em ordem alfabética
        $transportadoras = Transportadora::orderBy('razao_social', 'asc')->get();
        return view('main.transportadoras.table', compact('transportadoras'));
    }

    public function store(Request $request)
    {
        try {
            // Validação dos dados com base no model
            $this->validate($request, [
                'razao_social' => 'required|string|max:255',
                'cpf_cnpj'     => 'nullable|string|unique:transportadoras,cpf_cnpj',
                'email'        => 'required|email|unique:transportadoras,email',
            ]);

            $transportadora = Transportadora::create($request->all());

            return response()->json([
                'id_transportadora' => $transportadora->id,
                'message'           => "Registro salvo com sucesso"
            ], 201);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function update(Request $request, $id = '')
    {
        try {
            $transportadora = Transportadora::find($id);
            if (!$transportadora) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }

            // Verifica duplicidade de CPF/CNPJ
            if (isset($request->cpf_cnpj)) {
                $exists = Transportadora::where('id', '!=', $id)
                    ->where('cpf_cnpj', $request->cpf_cnpj)
                    ->first();
                if ($exists) {
                    throw new \Exception("CPF/CNPJ já cadastrado. ID: " . $exists->id);
                }
            }

            // Verifica duplicidade de E-mail
            if (isset($request->email)) {
                $exists = Transportadora::where('id', '!=', $id)
                    ->where('email', $request->email)
                    ->first();
                if ($exists) {
                    throw new \Exception("E-mail já cadastrado. ID: " . $exists->id);
                }
            }

            $transportadora->update($request->all());

            return response()->json([
                'id_transportadora' => $id,
                'message'           => "Registro atualizado com sucesso"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id = '')
    {
        try {
            $transportadora = Transportadora::find($id);
            if (!$transportadora) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }

            $transportadora->delete();

            return response()->json(['message' => "Registro excluído com sucesso"], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}
