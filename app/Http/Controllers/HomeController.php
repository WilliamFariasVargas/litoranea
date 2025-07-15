<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeContent;
use App\Models\LogoParceiro;
use App\Models\Evento;

class HomeController extends Controller
{
    public function index()
    {
        $conteudo = \App\Models\HomeContent::first();
        $logosParceiros = \App\Models\LogoParceiro::all();
        $eventos = \App\Models\Evento::with('fotos')->latest()->take(5)->get();

        return view('welcome', compact('conteudo', 'logosParceiros', 'eventos'));
    }
}
