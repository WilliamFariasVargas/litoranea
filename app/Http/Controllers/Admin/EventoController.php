<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\EventoFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('fotos')->get();
        return view('admin.eventos.index', compact('eventos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'local' => 'required|string',
            'mes' => 'required|string',
            'ano' => 'required|numeric',
        ]);

        Evento::create($request->only('nome', 'local', 'mes', 'ano'));

        return redirect()->back()->with('success', 'Evento criado com sucesso.');
    }

    public function uploadFotos(Request $request, Evento $evento)
    {
        $request->validate([
            'imagens.*' => 'image|max:2048'
        ]);

        foreach ($request->file('imagens') as $imagem) {
            $path = $imagem->store('eventos', 'public');
            $evento->fotos()->create(['imagem' => $path]);
        }

        return redirect()->back()->with('success', 'Fotos enviadas com sucesso.');
    }

    public function destroyFoto(EventoFoto $foto)
    {
        Storage::disk('public')->delete($foto->imagem);
        $foto->delete();

        return redirect()->back()->with('success', 'Foto removida com sucesso.');
    }

    public function destroy(\App\Models\Evento $evento)
{
    // Apaga as fotos do disco
    foreach ($evento->fotos as $foto) {
        Storage::disk('public')->delete($foto->imagem);
    }

    // Apaga o evento e as fotos (por cascade)
    $evento->delete();

    return redirect()->back()->with('success', 'Evento e fotos excluídos com sucesso.');
}
}
