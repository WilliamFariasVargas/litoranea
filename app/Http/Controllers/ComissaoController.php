<?php

namespace App\Http\Controllers;

use App\Models\Comissao;
use Illuminate\Http\Request;

class ComissaoController extends Controller
{
    public function index()
    {
        return view('main.comissoes.index');
    }

    public function form(Request $request, $id = '')
    {
        $comissao = ($id != '') ? Comissao::find($id) : null;
        return view('main.comissoes.form', compact('comissao'));
    }

    public function show()
    {
        $comissoes = Comissao::orderBy('data', 'desc')->get();
        return view('main.comissoes.table', compact('comissoes'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'pedido_id'  => 'nullable|integer',
                'valor'      => 'required|numeric',
                'data'       => 'required|date'
            ]);

            // Verificações adicionais podem ser inseridas aqui, se necessário

            $comissao = Comissao::create($request->all());

            return response()->json([
                'id_comissao' => $comissao->id,
                'message'     => "Registro salvo com sucesso"
            ], 201);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function update(Request $request, $id = '')
    {
        try {
            $comissao = Comissao::find($id);
            if (!$comissao) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }
            $comissao->update($request->all());

            return response()->json([
                'id_comissao' => $id,
                'message'     => "Registro atualizado com sucesso"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id = '')
    {
        try {
            $comissao = Comissao::find($id);
            if (!$comissao) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }
            $comissao->delete();

            return response()->json(['message' => "Registro excluído com sucesso"], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}
