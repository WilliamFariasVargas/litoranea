<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Representada;
use App\Models\Transportadora;
use PDF;

class ExportacoesController extends Controller
{
    private $columns = [
        'tipo_pessoa',
        'cpf_cnpj',
        'inscricao_estadual',
        'razao_social',
        'nome_fantasia',
        'responsavel',
        'email',
        'email_nfe',
        'fone',
        'celular',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
    ];

    public function exportarClientes(\Illuminate\Http\Request $request)
    {
        $orderBy = $request->query('orderBy', 'razao_social');
        $cidadeFiltro = $request->query('cidade', null);

        if (!in_array($orderBy, ['razao_social', 'cidade', 'id'])) {
            $orderBy = 'razao_social';
        }

        $query = Cliente::select($this->columns);

        if ($cidadeFiltro) {
            $query->where('cidade', $cidadeFiltro);
        }

        $query->orderBy($orderBy);

        $clientes = $query->get();

        $pdf = PDF::loadView('exportacoes.clientes', compact('clientes'));

        return $pdf->download('clientes.pdf');
    }

    public function exportarRepresentadas(\Illuminate\Http\Request $request)
    {
        $orderBy = $request->query('orderBy', 'razao_social');
        $cidadeFiltro = $request->query('cidade', null);

        if (!in_array($orderBy, ['razao_social', 'cidade', 'id'])) {
            $orderBy = 'razao_social';
        }

        $query = Representada::select($this->columns);

        if ($cidadeFiltro) {
            $query->where('cidade', $cidadeFiltro);
        }

        $query->orderBy($orderBy);

        $representadas = $query->get();

        $pdf = PDF::loadView('exportacoes.representadas', compact('representadas'));

        return $pdf->download('representadas.pdf');
    }

    public function exportarTransportadoras(\Illuminate\Http\Request $request)
    {
        $orderBy = $request->query('orderBy', 'razao_social');
        $cidadeFiltro = $request->query('cidade', null);

        if (!in_array($orderBy, ['razao_social', 'cidade', 'id'])) {
            $orderBy = 'razao_social';
        }

        $query = Transportadora::select($this->columns);

        if ($cidadeFiltro) {
            $query->where('cidade', $cidadeFiltro);
        }

        $query->orderBy($orderBy);

        $transportadoras = $query->get();

        $pdf = PDF::loadView('exportacoes.transportadoras', compact('transportadoras'));

        return $pdf->download('transportadoras.pdf');
    }
}
