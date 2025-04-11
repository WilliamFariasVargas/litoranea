@extends('layouts.pages') {{-- ou outro layout seu --}}

@section('content')
<div class="container">
    <h2 class="mb-4">Comissões Cadastradas</h2>

    <div class="mb-3">
        <a href="{{ route('comissoes.create') }}" class="btn btn-primary">+ Nova Comissão</a>
        <a href="{{ route('comissoes.relatorio') }}" class="btn btn-secondary">📊 Ver Relatório Mensal</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
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
    @if($comissoes->count())
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Pedido</th>
                <th>Cliente</th>
                <th>Valor do Pedido</th>
                <th>Comissão (%)</th>
                <th>Valor Fixo</th>
                <th>Valor Calculado</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comissoes as $comissao)
                <tr>
                    <td>#{{ $comissao->pedido->numero_pedido }}</td>
                    <td>{{ nomeFormatado($comissao->pedido->cliente) }}</td>
                    <td>R$ {{ number_format($comissao->pedido->valor_total, 2, ',', '.') }}</td>
                    <td>{{ $comissao->percentual ?? '-' }}</td>
                    <td>{{ $comissao->valor ?? '-' }}</td>
                    <td>R$ {{ number_format($comissao->valor_calculado, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($comissao->created_at)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Nenhuma comissão cadastrada ainda.</p>
    @endif
</div>
@endsection
