@extends('layouts.pages')

@section('content')

<h2>Relatório de Comissões - {{ $mes }}/{{ $ano }}</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Pedido</th>
            <th>Cliente</th>
            <th>Valor do Pedido</th>
            <th>Comissão (%)</th>
            <th>Valor Fixo</th>
            <th>Valor Calculado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($comissoes as $comissao)
            <tr>
                <td>#{{ $comissao->pedido->numero_pedido }}</td>
                <td>{{ $comissao->pedido->cliente->nome ?? '-' }}</td>
                <td>R$ {{ number_format($comissao->pedido->valor_total, 2, ',', '.') }}</td>
                <td>{{ $comissao->percentual ?? '-' }}</td>
                <td>{{ $comissao->valor ?? '-' }}</td>
                <td>R$ {{ number_format($comissao->valor_calculado, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>Total de Comissões: R$ {{ number_format($total, 2, ',', '.') }}</h3>
