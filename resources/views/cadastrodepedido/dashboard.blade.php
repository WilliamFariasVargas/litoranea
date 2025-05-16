@extends('layouts.pages')


@section('page-content')
<div class="container">
    <div style="padding-top:60px;" class="d-flex justify-content-between align-items-center mb-4">

            <div class="col-8" style="vertical-align: middle">
                <h4 style="color:#003162;" class="title mt-2">
                    <i class="fa fa-list-alt mx-2"></i>Gráficos e Relatórios
                </h4>
            </div>

        {{-- Botão Voltar --}}
        <a href="{{ route('cadastrodepedido.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    {{-- Filtros --}}
<form method="GET" action="{{ route('cadastrodepedido.dashboard') }}" class="row g-3 mb-4">
    {{-- Cliente --}}
    <div class="col-md-3">
        <select name="cliente_id" class="form-control select2">
            <option value="">Cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->razao_social }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Representada --}}
    <div class="col-md-3">
        <select name="representada_id" class="form-control select2">
            <option value="">Representada</option>
            @foreach($representadas as $rep)
                <option value="{{ $rep->id }}" {{ request('representada_id') == $rep->id ? 'selected' : '' }}>
                    {{ $rep->razao_social }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Transportadora --}}
    <div class="col-md-3">
        <select name="transportadora_id" class="form-control select2">
            <option value="">Transportadora</option>
            @foreach($transportadoras as $trans)
                <option value="{{ $trans->id }}" {{ request('transportadora_id') == $trans->id ? 'selected' : '' }}>
                    {{ $trans->razao_social }}
                </option>
            @endforeach
        </select>
    </div>
    {{-- Dia Início --}}
    <div class="col-md-2">
        <input type="date" name="data_inicial" class="form-control" value="{{ request('data_inicial') }}">
    </div>

    {{-- Dia Fim --}}
    <div class="col-md-2">
        <input type="date" name="data_final" class="form-control" value="{{ request('data_final') }}">
    </div>

    {{-- Mês --}}
    <div class="col-md-1">
        <input type="number" name="mes" class="form-control" placeholder="Mês" min="1" max="12" value="{{ request('mes') }}">
    </div>

    {{-- Ano --}}
    <div class="col-md-1">
        <select name="ano" class="form-control select2">
            <option value="">Ano</option>
            @foreach(range(date('Y'), date('Y') - 5) as $ano)
                <option value="{{ $ano }}" {{ request('ano') == $ano ? 'selected' : '' }}>
                    {{ $ano }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Botão Filtrar --}}
    <div class="col-md-1 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
</form>


    {{-- Cards de Resumo --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="card-title text-primary">Total de Pedidos</h6>
                    <h4>R$ {{ number_format($total_pedidos, 2, ',', '.') }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h6 class="card-title text-success">Total Faturado</h6>
                    <h4>R$ {{ number_format($total_faturado, 2, ',', '.') }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <h6 class="card-title text-warning">Comissão Parcial</h6>
                    <h4>R$ {{ number_format($total_comissao_parcial, 2, ',', '.') }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center border-danger">
                <div class="card-body">
                    <h6 class="card-title text-danger">Comissão Faturada</h6>
                    <h4>R$ {{ number_format($total_comissao_faturada, 2, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráfico --}}
    <div class="row">
        <div class="col-md-12 mb-4">
            <canvas id="pedidosChart" height="100"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($labels) !!};
    const valoresPedidos = {!! json_encode($valoresPedidos) !!};
    const valoresFaturados = {!! json_encode($valoresFaturados) !!};

    const ctx = document.getElementById('pedidosChart').getContext('2d');
    const pedidosChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Valor Total dos Pedidos (R$)',
                    data: valoresPedidos,
                    borderWidth: 2,
                    fill: false,
                    borderColor: 'blue',
                    tension: 0.3
                },
                {
                    label: 'Valor Total Faturado (R$)',
                    data: valoresFaturados,
                    borderWidth: 2,
                    fill: false,
                    borderColor: 'green',
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
