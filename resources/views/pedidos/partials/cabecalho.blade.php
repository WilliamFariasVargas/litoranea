
<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ isset($is_pdf) ? public_path('assets/images/logo.png') : asset('assets/images/logo.png') }}" alt="Logo do Sistema" style="max-height: 80px;">
</div>

<p><strong>Representada:</strong> {{ $pedido->representada->razao_social ?? $pedido->representada->nome ?? '-' }}</p>
<p><strong>Representante:</strong> {{ $pedido->representante->nome ?? '-' }}</p>
<p><strong>Email:</strong> {{ $pedido->representante->email ?? '-' }}</p>
<p><strong>Telefone:</strong> {{ $pedido->representante->telefone ?? '-' }}</p>


<p><strong>Cliente:</strong> {{ $pedido->cliente->nome_fantasia ?? $pedido->cliente->nome ?? '-' }}</p>
<p><strong>Endereço:</strong> {{ $pedido->cliente->endereco ?? '-' }}</p>
<p>
    <strong>Cidade:</strong> {{ $pedido->cliente->cidade ?? '-' }},
    <strong>UF:</strong> {{ $pedido->cliente->estado ?? '-' }},
    <strong>CEP:</strong> {{ $pedido->cliente->cep ?? '-' }}
</p>
<p>
    <strong>Celular:</strong> {{ $pedido->cliente->celular ?? '-' }}<br>
    <strong>Email:</strong> {{ $pedido->cliente->email ?? '-' }}
</p>
<p><strong>CNPJ/CPF:</strong> {{ $pedido->cliente->cpf_cnpj ?? '-' }}</p>

<p><strong>Transportadora:</strong> {{ $pedido->transportadora->nome_fantasia ?? $pedido->transportadora->nome ?? '-' }}</p>
<p>
    <strong>Telefone:</strong> {{ $pedido->transportadora->telefone ?? '-' }}<br>
    <strong>Email:</strong> {{ $pedido->transportadora->email ?? '-' }}
</p>


// resources/views/pedidos/imprimir.blade.php
@extends('layouts.pages')
@section('content')
<div class="container">
    <h2 class="text-center mb-4">Pedido Nº {{ $pedido->numero_pedido }}</h2>

    @include('pedidos.partials.cabecalho')

    <hr>
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
</div>
@endsection


// resources/views/pedidos/pdf.blade.php
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        .title { text-align: center; font-size: 18px; margin-bottom: 10px; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <div class="title">Pedido Nº {{ $pedido->numero_pedido }}</div>

    @include('pedidos.partials.cabecalho', ['is_pdf' => true])

    <table>
        <thead>
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

    <p class="right"><strong>Total Geral: R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</strong></p>
</body>
</html>
