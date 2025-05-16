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
        $transportadora = Transportadora::find($id);
        return view('main.transportadoras.form', compact('transportadora'));
    }

    public function show()
    {
        $transportadoras = Transportadora::orderBy('razao_social', 'asc')->get();
        return view('main.transportadoras.table', compact('transportadoras'));
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

            $transportadora = Transportadora::create($request->all());

            return response()->json([
                'id'      => $transportadora->id,
                'message' => 'Registro salvo com sucesso'
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

            $transportadora->update($request->all());

            return response()->json([
                'id'      => $transportadora->id,
                'message' => 'Registro atualizado com sucesso'
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
                return response()->json(['message' => 'Registro não encontrado'], 404);
            }

            $transportadora->delete();

            return response()->json(['message' => 'Registro excluído com sucesso'], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $search = $request->q;
        $query = Transportadora::query();

        if (!empty($search)) {
            $query->where('razao_social', 'like', "%{$search}%");
        }

        $results = $query->orderBy('razao_social')->limit(20)->get()->map(function ($item) {
            return [
                'id'   => $item->id,
                'text' => $item->razao_social,
            ];
        });

        return response()->json(['results' => $results]);
    }
}
