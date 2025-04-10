<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        .title { text-align: center; font-size: 18px; margin-bottom: 10px; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <div class="title">Pedido Nº {{ $pedido->numero_pedido }}</div>

    <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
    <p><strong>Representada:</strong> {{ $pedido->representada->nome }}</p>
    <p><strong>Representante:</strong> {{ $pedido->representante->nome }}</p>
    <p><strong>Transportadora:</strong> {{ $pedido->transportadora->nome }}</p>

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
