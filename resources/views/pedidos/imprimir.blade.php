@extends('layouts.pages')
@section('content')

<style>
@media print {
    .no-print,
    .no-print * {
        display: none !important;
    }
}
</style>

<div class="container">
    <h2 class="text-center mb-4">Pedido Nº {{ $pedido->numero_pedido }}</h2>

    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ isset($is_pdf) ? public_path('assets/images/logo.png') : asset('assets/images/logo.png') }}" alt="Logo do Sistema" style="max-height: 80px;">
    </div>

    @php
    function nomeFormatado($entidade) {
        if (!$entidade) return 'Não informado';
        if (!empty($entidade->razao_social)) {
            return $entidade->nome
                ? "{$entidade->razao_social} ({$entidade->nome})"
                : $entidade->razao_social;
        }
        return $entidade->nome ?? 'Não informado';
    }
@endphp

<table class="table table-bordered mb-4">
    <tbody>
        <tr>
            <th>Representada</th>
            <td>{{ nomeFormatado($pedido->representada) }}</td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered mb-4">
    <tbody>
        <tr>
            <th colspan="1">Representante</th>
            <td colspan="3">{{ nomeFormatado($pedido->fornecedores_id) }}</td>
        </tr>

        <tr>
            <th>Email do Representante</th>
            <td>{{ $pedido->fornecedores->email ?? 'Não informado' }}</td>

            <th>Telefone do Representante</th>
            <td>{{ $pedido->fornecedores->fone ?? 'Não informado' }}</td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered mb-6">
<tbody>

        <tr>
            <th colspan="1">Cliente</th>
            <td colspan="5">{{ nomeFormatado($pedido->cliente) }}</td>
        </tr>
        <tr>
            <th colspan="1">Endereço do Cliente</th>
            <td colspan="5">{{ $pedido->cliente->endereco ?? 'Não informado' }}</td>
        </tr>
        <tr>
            <th>Cidade do Cliente</th>
            <td>{{ $pedido->cliente->cidade ?? 'Não informado' }}</td>

            <th>Estado do Cliente</th>
            <td>{{ $pedido->cliente->estado ?? 'Não informado' }}</td>

            <th>CEP do Cliente</th>
            <td>{{ $pedido->cliente->cep ?? 'Não informado' }}</td>


        </tr>
        <tr>
            <th>Celular do Cliente</th>
            <td>{{ $pedido->cliente->celular ?? 'Não informado' }}</td>

            <th>Email do Cliente</th>
            <td>{{ $pedido->cliente->email ?? 'Não informado' }}</td>

            <th>CPF/CNPJ do Cliente</th>
            <td>{{ $pedido->cliente->cpf ?? $pedido->cliente->cnpj ?? 'Não informado' }}</td>
        </tr>
</tbody>
</table>
<table class="table table-bordered mb-4">
    <tbody>
        <tr>
            <th colspan="1">Transportadora</th>
            <td colspan="3">{{ nomeFormatado($pedido->transportadora) }}</td>
        </tr>
        <tr>
            <th>Telefone da Transportadora</th>
            <td>{{ $pedido->transportadora->telefone ?? 'Não informado' }}</td>

            <th>Email da Transportadora</th>
            <td>{{ $pedido->transportadora->email ?? 'Não informado' }}</td>
        </tr>
    </tbody>
</table>




    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Item</th>
                <th>Código</th>
                <th>Descrição</th>
                <th>Qtd</th>
                <th>Unitário</th>
                <th>Desconto</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->itens as $item)
                <tr>
                    <td>{{ $item->item }}</td>
                    <td>{{ $item->codigo }}</td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->quantidade }}</td>
                    <td>R$ {{ number_format($item->valor_unitario, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($item->valor_com_desconto ?? $item->valor_unitario, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($item->total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <h5><strong>Total Geral: R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</strong></h5>
    </div>

    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-primary">Imprimir</button>
        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection
