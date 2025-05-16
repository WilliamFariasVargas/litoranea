<?php

namespace App\Http\Controllers;

use App\Models\Representada;
use Illuminate\Http\Request;

class RepresentadaController extends Controller
{
    public function index()
    {
        return view('main.representadas.index');
    }

    public function form(Request $request, $id = '')
    {
        $representada = Representada::find($id);
        return view('main.representadas.form', compact('representada'));
    }

    public function show()
    {
        $representadas = Representada::orderBy('razao_social', 'asc')->get();
        return view('main.representadas.table', compact('representadas'));
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

            $representada = Representada::create($request->all());

            return response()->json([
                'id' => $representada->id,
                'message' => 'Registro salvo com sucesso'
            ], 201);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function update(Request $request, $id = '')
    {
        try {
            $representada = Representada::find($id);
            if (!$representada) {
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

            $representada->update($request->all());

            return response()->json([
                'id' => $id,
                'message' => 'Registro atualizado com sucesso'
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id = '')
    {
        try {
            $representada = Representada::find($id);
            if (!$representada) {
                return response()->json(['message' => 'Registro não encontrado'], 404);
            }

            $representada->delete();

            return response()->json(['message' => 'Registro excluído com sucesso'], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $search = $request->q;
        $query = Representada::query();

        if (!empty($search)) {
            $query->where('razao_social', 'like', "%{$search}%");
        }

        $representadas = $query->orderBy('razao_social')->limit(20)->get();

        $results = [];
        foreach ($representadas as $item) {
            $results[] = [
                'id'   => $item->id,
                'text' => $item->razao_social,
            ];
        }

        return response()->json(['results' => $results]);
    }
}