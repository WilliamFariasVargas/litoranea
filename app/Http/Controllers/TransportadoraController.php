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
        $transportadoras = Transportadora::orderBy('nome', 'asc')->get();
        return view('main.transportadoras.table', compact('transportadoras'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nome'  => 'required|string|max:255',
                'cnpj'  => 'nullable|string|unique:transportadoras,cnpj',
                'email' => 'required|email|unique:transportadoras,email',
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
            // Verifica duplicidade para CNPJ e e-mail
            if (isset($request->cnpj)) {
                $exists = Transportadora::where('id', '!=', $id)
                    ->where('cnpj', $request->cnpj)
                    ->first();
                if ($exists) {
                    throw new \Exception("CNPJ já cadastrado. ID: " . $exists->id);
                }
            }
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
