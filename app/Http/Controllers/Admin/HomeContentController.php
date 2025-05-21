<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeContent;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    public function edit()
    {
        $conteudo = HomeContent::first();
        if (!$conteudo) {
            $conteudo = HomeContent::create([]);
        }
        return view('admin.home.edit', compact('conteudo'));
    }

    public function update(Request $request)
    {
        $conteudo = HomeContent::first();
        if (!$conteudo) {
            $conteudo = HomeContent::create([]);
        }

        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
            'foto_sobre' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
            'clientes' => 'required|string',
            'anos_experiencia' => 'required|string',
            'parceiros' => 'required|string',
            'estados' => 'required|string',
            'texto_sobre' => 'required|string',
            'whatsapp' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            if ($conteudo->logo) {

                Storage::disk('public')->delete($conteudo->logo);
            }
            $validated['logo'] = $request->file('logo')->store('home', 'public');
        }

        if ($request->hasFile('foto_sobre')) {
            if ($conteudo->foto_sobre) {
                Storage::disk('public')->delete($conteudo->foto_sobre);
            }

            $validated['foto_sobre'] = $request->file('foto_sobre')->store('home', 'public');
        }

        $conteudo->update($validated);

        return redirect()->route('admin.home.edit')->with('success', 'Conteúdo atualizado com sucesso!');
    }
}
