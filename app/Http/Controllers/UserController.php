<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function logged(){

        $user = session()->get('name');
        $level = User::$levels[session()->get('level')];

        return view('main.welcome', compact('user','level'));
    }

    public function index()
    {
        if (auth()->user()->level <= 2) {
            abort(403, 'Acesso não autorizado');
        }

        $users = User::orderBy('name')->get();
        return view('main.users.index', compact('users'));
    }

    public function form($id = null)
    {
        if (auth()->user()->level <= 2) {
            abort(403, 'Acesso não autorizado');
        }

        $user = User::find($id);
        return view('main.users.form', compact('user'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->level <= 2) {
            abort(403, 'Acesso não autorizado');
        }

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'level' => 'required|integer|min:0|max:10',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->level <= 2) {
            abort(403, 'Acesso não autorizado');
        }

        $user = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
            'level' => 'required|integer|min:0|max:10',
        ]);

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function delete($id)
    {
        if (auth()->user()->level <= 2) {
            abort(403, 'Acesso não autorizado');
        }

        User::destroy($id);
        return response()->json(['message' => 'Usuário excluído com sucesso.']);
    }
}
