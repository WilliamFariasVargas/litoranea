<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogoParceiro;
use Illuminate\Support\Facades\Storage;

class LogoParceiroController extends Controller
{
    public function index()
    {
        $logos = LogoParceiro::latest()->get();
        return view('admin.parceiros.index', compact('logos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $path = $request->file('imagem')->store('parceiros', 'public');

        LogoParceiro::create(['imagem' => $path]);

        return redirect()->back()->with('success', 'Logo adicionado com sucesso!');
    }

    public function destroy($id)
    {
        $logo = LogoParceiro::findOrFail($id);
        Storage::disk('public')->delete($logo->imagem);
        $logo->delete();

        return redirect()->back()->with('success', 'Logo removido!');
    }
}
