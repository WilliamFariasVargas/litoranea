<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeContent;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    public function edit()
    {
        $conteudo = HomeContent::firstOrCreate([], [
            'clientes' => 0,
            'anos_experiencia' => 0,
            'parceiros' => 0,
            'estados' => 0,
            'texto_sobre' => '',
            'whatsapp' => '',
        ]);

        return view('admin.home.form', compact('conteudo'));
    }

    public function update(Request $request)
    {
        $conteudo = HomeContent::first();

        $conteudo->update($request->only([
            'clientes',
            'anos_experiencia',
            'parceiros',
            'estados',
            'texto_sobre',
            'whatsapp'
        ]));

        // Upload de logos
        if ($request->hasFile('logos')) {
            $paths = [];
            foreach ($request->file('logos') as $logo) {
                $paths[] = $logo->store('public/logos');
            }
            $conteudo->logos = json_encode($paths);
            $conteudo->save();
        }

        return redirect()->back()->with('success', 'Conteúdo atualizado com sucesso!');
    }
}
