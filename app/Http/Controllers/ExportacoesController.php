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
        $clientes = Cliente::select(
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
            'uf'
        )->orderBy('razao_social')->get();

        $pdf = PDF::loadView('exportacoes.clientes', compact('clientes'));

        return $pdf->download('clientes.pdf');
    }

    public function exportarRepresentadas()
    {
        $representadas = Representada::select(
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
            'uf'
        )->orderBy('razao_social')->get();

        $pdf = PDF::loadView('exportacoes.representadas', compact('representadas'));

        return $pdf->download('representadas.pdf');
    }

    public function exportarTransportadoras()
    {
        $transportadoras = Transportadora::select(
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
            'uf'
        )->orderBy('razao_social')->get();

        $pdf = PDF::loadView('exportacoes.transportadoras', compact('transportadoras'));

        return $pdf->download('transportadoras.pdf');
    }
}
