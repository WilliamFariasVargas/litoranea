<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedido Nº {{ $pedido->numero_pedido }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        h2, h5 {
            margin: 0;
            padding: 4px 0;
        }

        img {
            margin-bottom: 12px;
        }

    </style>
</head>
<body>

    <div class="text-center">
        <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo" style="max-height: 80px;">
        <h2>Pedido Nº {{ $pedido->numero_pedido }}</h2>
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

    <table>
        <tr>
            <th>Representada</th>
            <td>{{ nomeFormatado($pedido->representada) }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Representante</th>
            <td colspan="3">{{ nomeFormatado($pedido->fornecedor) }}</td>
        </tr>
        <tr>
            <th>Email do Representante</th>
            <td>{{ $pedido->fornecedor->email ?? 'Não informado' }}</td>
            <th>Telefone do Representante</th>
            <td>{{ $pedido->fornecedor->fone ?? 'Não informado' }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Cliente</th>
            <td colspan="5">{{ nomeFormatado($pedido->cliente) }}</td>
        </tr>
        <tr>
            <th>Endereço do Cliente</th>
            <td colspan="5">{{ $pedido->cliente->rua ?? 'Não informado' }}</td>
        </tr>
        <tr>
            <th>Cidade</th>
            <td>{{ $pedido->cliente->cidade ?? 'Não informado' }}</td>
            <th>Estado</th>
            <td>{{ $pedido->cliente->uf ?? 'Não informado' }}</td>
            <th>CEP</th>
            <td>{{ $pedido->cliente->cep ?? 'Não informado' }}</td>
        </tr>
        <tr>
            <th>Celular</th>
            <td>{{ $pedido->cliente->celular ?? 'Não informado' }}</td>
            <th>Email</th>
            <td>{{ $pedido->cliente->email ?? 'Não informado' }}</td>
            <th>CPF/CNPJ</th>
            <td>{{ $pedido->cliente->cpf_cnpj ?? 'Não informado' }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Transportadora</th>
            <td colspan="3">{{ nomeFormatado($pedido->transportadora) }}</td>
        </tr>
        <tr>
            <th>Telefone</th>
            <td>{{ $pedido->transportadora->celular ?? 'Não informado' }}</td>
            <th>Email</th>
            <td>{{ $pedido->transportadora->email ?? 'Não informado' }}</td>
        </tr>
    </table>

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

    <div class="text-end">
        <h5><strong>Total Geral: R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</strong></h5>
    </div>

</body>
</html>
