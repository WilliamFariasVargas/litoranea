<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('main.usuarios.index');
    }

    public function form(Request $request, $id = '')
    {
        $usuario = ($id != '') ? Usuario::find($id) : null;
        return view('main.usuarios.form', compact('usuario'));
    }

    public function show()
    {
        $usuarios = Usuario::orderBy('nome', 'asc')->get();
        return view('main.usuarios.table', compact('usuarios'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nome'   => 'required|string|max:255',
                'email'  => 'required|email|unique:usuarios,email',
                'senha'  => 'required|string|min:6',
                'perfil' => 'required|string',
            ]);

            $data = $request->all();
            $data['senha'] = Hash::make($data['senha']);

            $usuario = Usuario::create($data);

            return response()->json([
                'id_usuario' => $usuario->id,
                'message'    => "Registro salvo com sucesso"
            ], 201);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function update(Request $request, $id = '')
    {
        try {
            $usuario = Usuario::find($id);
            if (!$usuario) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }
            // Verifica duplicidade para e-mail
            if (isset($request->email)) {
                $exists = Usuario::where('id', '!=', $id)
                    ->where('email', $request->email)
                    ->first();
                if ($exists) {
                    throw new \Exception("E-mail já cadastrado. ID: " . $exists->id);
                }
            }
            $data = $request->all();
            if (isset($data['senha']) && $data['senha'] != '') {
                // Atualiza a senha apenas se for informada
                $data['senha'] = Hash::make($data['senha']);
            } else {
                unset($data['senha']);
            }
            $usuario->update($data);

            return response()->json([
                'id_usuario' => $id,
                'message'    => "Registro atualizado com sucesso"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id = '')
    {
        try {
            $usuario = Usuario::find($id);
            if (!$usuario) {
                return response()->json(['message' => "Registro não encontrado"], 404);
            }
            $usuario->delete();

            return response()->json(['message' => "Registro excluído com sucesso"], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}
