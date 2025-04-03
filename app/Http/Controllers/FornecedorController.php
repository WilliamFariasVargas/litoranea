<?php

namespace App\Http\Controllers;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Exibe a página principal para fornecedores.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(){
        return view('main.fornecedores.index');
    }

    /**
     * Exibe o formulário de criação/edição de fornecedores.
     *
     * @param Request $request
     * @param string $id (opcional) O identificador da licença para edição, vazio para criação.
     * @return \Illuminate\View\View
     */
    public function form(Request $request, $id=''){
        $fornecedor = Fornecedor::find($id);
        return view('main.fornecedores.form',compact('fornecedor'));
    }

    /**
     * Exibe a tabela de fornecedores ordenada por id.
     *
     * @return \Illuminate\View\View
     */
    public function show(){
        $fornecedores = Fornecedor::orderBy('razao_social','asc')->get();
        return view('main.fornecedores.table',compact('fornecedores'));
    }

    /**
     * Armazena um novo fornecedor ou lança uma exceção se já existir um fornecedor com o mesmo cnpj.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        try {
            // Verifica se já existe
            if(isset($request->cpf_cnpj) && $request->cpf_cnpj != null){
                $fornecedor = Fornecedor::where('cpf_cnpj', $request->cpf_cnpj)->where('nome_fantasia', $request->nome_fantasia)->first();

                if ($fornecedor != null) {
                    // Se o fornecedor já existir, atualize-o
                    throw new \Exception('Fornecedor ja existe. ID: ' . $fornecedor->id);
                }
            }


            $request->merge(['ip' => $request->ip()]);

            $fornecedor = Fornecedor::create($request->all());

            //Systemlog::log('ADD FORNECEDOR', User::getUserCode() . ' cadastrou o fornecedor ' . $fornecedor->id . ' - ' . $request->cnpj . ' - ' . $request->empresa . ' - ' . $request->nomecompleto);

            return response()->json(['id_fornecedor'=>$fornecedor->id, 'message' => "Registro Salvo"], 201);

        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     *  Atualiza um fornecedor ou lança uma exceção se já existir um fornecedor com o mesmo cnpj em outro código
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function update(Request $request, $id = "") {
        try {
            // Verifica se já existe
            $consumer = Fornecedor::find($id);

            if ($consumer == null) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }

            if(isset($request->cpf_cnpj) && $request->cpf_cnpj != null){
                $fornecedor =  Fornecedor::where('id', '!=', $id)
                            ->where('cpf_cnpj', $request->cpf_cnpj)
                            ->where('nome_fantasia', $request->nome_fantasia)
                            ->first();

                if ($fornecedor != null) {
                    // Se o fornecedor já existir, atualize-o
                    throw new \Exception('Fornecedor ja existe. ID: ' . $fornecedor->id);
                }
            }


            $request->merge(['ip' => $request->ip()]);

            //Systemlog::log('UPDATE FORNECEDOR', User::getUserCode() . ' atualizou o fornecedor ' . $id . ' - ' . $request->cnpj . ' - ' . $request->empresa . ' - ' . $request->nomecompleto);

            $consumer->update($request->all());

            return response()->json(['id_fornecedor'=> $id, 'message' => "Registro salvo"], 200);

        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }


    public function delete(Request $request, $id=""){
        try{
            //verifica se já existe
            $fornecedor = Fornecedor::find($id);

            if($fornecedor==null){
                return response()->json(['message' => "Registro não encontrado"],404);
            }

            $fornecedor_name = $id.'-'.$fornecedor->cnpj.'-'.$fornecedor->empresa.'-'.$fornecedor->nomecompleto;

            $fornecedor->delete();

            //Systemlog::log('DELETE FORNECEDOR', User::getUserCode(). ' excluiu o fornecedor '.$fornecedor_name);

            return response()->json(['message' => "Excluído com sucesso"],200);

        }catch (\Exception $ex){
            return response()->json(['message' => $ex->getMessage()],500);
        }
    }
}
