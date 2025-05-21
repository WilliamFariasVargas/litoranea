<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function enviar(Request $request)
    {
        $validated = $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'mensagem' => 'required|string',
        ]);

        Mail::send('emails.contato', $validated, function ($message) {
            $message->to('seuemail@seudominio.com')
                    ->subject('Nova mensagem do site - Litorânea');
        });

        return back()->with('success', 'Mensagem enviada com sucesso!');
    }
}
