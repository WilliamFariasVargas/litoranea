@extends('layouts.pages')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Relatório de Comissões - {{ $mes }}/{{ $ano }}</h2>

    @if($comissoes->isEmpty())
        <div class="alert alert-warning">Nenhuma comissão encontrada para esse período.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
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
                            <td><strong>R$ {{ number_format($comissao->valor_calculado, 2, ',', '.') }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h4 class="text-end mt-4">Total de Comissões: <strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></h4>
    @endif

    <div class="mt-4">
        <a href="{{ route('comissoes.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>
</div>
@endsection
