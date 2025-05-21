<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeContent;
use App\Models\LogoParceiro;

class HomeController extends Controller
{
    public function index()
    {
        $conteudo = HomeContent::first();
        $logosParceiros = LogoParceiro::all();

        return view('welcome', compact('conteudo', 'logosParceiros'));
    }
}
