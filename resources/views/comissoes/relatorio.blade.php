@extends('layouts.pages')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Relatório de Comissões - {{ $mes }}/{{ $ano }}</h2>

    <form action="{{ route('comissoes.relatorio') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="mes" class="form-label">Mês</label>
            <select name="mes" id="mes" class="form-select">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $m == $mes ? 'selected' : '' }}>
                        {{ str_pad($m, 2, '0', STR_PAD_LEFT) }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-md-3">
            <label for="ano" class="form-label">Ano</label>
            <select name="ano" id="ano" class="form-select">
                @for ($y = date('Y') - 5; $y <= date('Y') + 1; $y++)
                    <option value="{{ $y }}" {{ $y == $ano ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>

        <div class="col-md-3 align-self-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>
    ssh ssh-user@geonosis.ssh.umbler.com -p 42091
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
