<!DOCTYPE html>
<html>
<head>


    <title>Relatório de Pedidos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: center; }
    </style>
</head>
<body>

    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo do Sistema" style="max-height: 80px;">
    </div>

    <h3 style="text-align: center;">Relatório de Pedidos</h3>

    @if($cliente || $representada || $transportadora || $mes || $ano)
        <h4 style="text-align: center; margin-bottom: 20px;">Filtros Aplicados:</h4>
        <table style="margin: 0 auto 20px auto; width: 60%;">
            @if($cliente)
            <tr>
                <td style="text-align: right;"><strong>Cliente:</strong></td>
                <td style="text-align: left;">{{ $cliente->razao_social }}</td>
            </tr>
            @endif
            @if($representada)
            <tr>
                <td style="text-align: right;"><strong>Representada:</strong></td>
                <td style="text-align: left;">{{ $representada->razao_social }}</td>
            </tr>
            @endif
            @if($transportadora)
            <tr>
                <td style="text-align: right;"><strong>Transportadora:</strong></td>
                <td style="text-align: left;">{{ $transportadora->razao_social }}</td>
            </tr>
            @endif
            @if($mes)
            <tr>
                <td style="text-align: right;"><strong>Mês:</strong></td>
                <td style="text-align: left;">{{ str_pad($mes, 2, '0', STR_PAD_LEFT) }}</td>
            </tr>
            @endif
            @if($ano)
            <tr>
                <td style="text-align: right;"><strong>Ano:</strong></td>
                <td style="text-align: left;">{{ $ano }}</td>
            </tr>
            @endif
        </table>
    @endif


<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Cliente</th>
            <th>Representada</th>
            <th>Transportadora</th>
            <th>Valor Pedido</th>
            <th>Valor Faturado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
            <tr>
                <td>{{ \Carbon\Carbon::parse($pedido->data_pedido)->format('d/m/Y') }}</td>
                <td>{{ $pedido->cliente->razao_social ?? '-' }}</td>
                <td>{{ $pedido->representada->razao_social ?? '-' }}</td>
                <td>{{ $pedido->transportadora->razao_social ?? '-' }}</td>
                <td>R$ {{ number_format($pedido->valor_pedido, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($pedido->valor_faturado, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Resumo de Totais --}}
<br><br>
<table style="width: 50%; margin: 0 auto;">
    <tr>
        <th style="text-align: left;">Total de Pedidos:</th>
        <td style="text-align: right;">R$ {{ number_format($total_pedidos, 2, ',', '.') }}</td>
    </tr>
    <tr>
        <th style="text-align: left;">Total Faturado:</th>
        <td style="text-align: right;">R$ {{ number_format($total_faturado, 2, ',', '.') }}</td>
    </tr>
    <tr>
        <th style="text-align: left;">Comissão Parcial:</th>
        <td style="text-align: right;">R$ {{ number_format($total_comissao_parcial, 2, ',', '.') }}</td>
    </tr>
    <tr>
        <th style="text-align: left;">Comissão Faturada:</th>
        <td style="text-align: right;">R$ {{ number_format($total_comissao_faturada, 2, ',', '.') }}</td>
    </tr>
</table>

</body>
</html>
