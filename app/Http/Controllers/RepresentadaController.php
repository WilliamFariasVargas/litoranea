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

    /**
     * Exibe o formulário de criação/edição de representadas.
     *
     * @param Request $request
     * @param string $id (opcional) O identificador da representada para edição, vazio para criação.
     * @return \Illuminate\View\View
     */
    public function form(Request $request, $id = '')
    {
        $representada = Representada::find($id);
        return view('main.representadas.form', compact('representada'));
    }

    /**
     * Exibe a tabela de representadas ordenada por razão social.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $representadas = Representada::orderBy('razao_social', 'asc')->get();
        return view('main.representadas.table', compact('representadas'));
    }

    /**
     * Armazena uma nova representada.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nome'       => 'required|string|max:255',
                'cpf_cnpj'   => 'required|string|unique:representadas,cpf_cnpj',
                'email'      => 'required|email|unique:representadas,email',
            ]);

            $representada = Representada::create($request->all());

            return response()->json([
                'id_representada' => $representada->id,
                'message'         => "Registro salvo com sucesso"
            ], 201);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma representada existente.
     *
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id = '')
    {
        try {
            $representada = Representada::find($id);
            if (!$representada) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }

            // Verifica duplicidade para CPF/CNPJ e e-mail
            if (isset($request->cpf_cnpj)) {
                $exists = Representada::where('id', '!=', $id)
                    ->where('cpf_cnpj', $request->cpf_cnpj)
                    ->first();
                if ($exists) {
                    throw new \Exception("CPF/CNPJ já cadastrado. ID: " . $exists->id);
                }
            }

            if (isset($request->email)) {
                $exists = Representada::where('id', '!=', $id)
                    ->where('email', $request->email)
                    ->first();
                if ($exists) {
                    throw new \Exception("E-mail já cadastrado. ID: " . $exists->id);
                }
            }

            $representada->update($request->all());

            return response()->json([
                'id_representada' => $id,
                'message'         => "Registro atualizado com sucesso"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Exclui uma representada.
     *
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id = '')
    {
        try {
            $representada = Representada::find($id);
            if (!$representada) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }

            $representada->delete();

            return response()->json(['message' => "Registro excluído com sucesso"], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}
