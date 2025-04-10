@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="text-center mb-4">Pedido Nº {{ $pedido->numero_pedido }}</h2>

    <div class="mb-3">
        <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
        <p><strong>Representada:</strong> {{ $pedido->representada->nome }}</p>
        <p><strong>Representante:</strong> {{ $pedido->representante->nome }}</p>
        <p><strong>Transportadora:</strong> {{ $pedido->transportadora->nome }}</p>
    </div>

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

    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">Imprimir</button>
        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection
