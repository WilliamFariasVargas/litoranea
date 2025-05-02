<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Representada;
use App\Models\Transportadora;
use PDF; // usa o dompdf

class ExportacoesController extends Controller
{
    public function exportarClientes()
    {
        $clientes = Cliente::orderBy('razao_social')->get();

        $pdf = PDF::loadView('exportacoes.clientes', compact('clientes'));

        return $pdf->download('clientes.pdf');
    }

    public function exportarRepresentadas()
    {
        $representadas = Representada::orderBy('razao_social')->get();

        $pdf = PDF::loadView('exportacoes.representadas', compact('representadas'));

        return $pdf->download('representadas.pdf');
    }

    public function exportarTransportadoras()
    {
        $transportadoras = Transportadora::orderBy('razao_social')->get();

        $pdf = PDF::loadView('exportacoes.transportadoras', compact('transportadoras'));

        return $pdf->download('transportadoras.pdf');
    }
}
