<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 4px 6px; text-align: left; vertical-align: top; }
        th { background-color: #f2f2f2; }
        .cliente { border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-bottom: 5px; }
        .header-cliente { font-weight: bold; font-size: 11px; margin-bottom: 8px; }
        h2 { text-align: center; margin-bottom: 20px; font-size: 16px; }
    </style>
</head>
<body>

<h2>Relatório de Clientes</h2>

@foreach ($clientes as $cliente)
    <div class="cliente">
        <div class="header-cliente">{{ $cliente->razao_social }}</div>

        <table>
            <tr>
                <td><strong>Nome Fantasia:</strong> {{ $cliente->nome_fantasia }}</td>
                <td><strong>Tipo Pessoa:</strong> {{ $cliente->tipo_pessoa == 1 ? 'Jurídica' : 'Física' }}</td>
                <td><strong>CPF/CNPJ:</strong> {{ $cliente->cpf_cnpj }}</td>
                <td><strong>Inscrição Estadual:</strong> {{ $cliente->inscricao_estadual }}</td>
            </tr>
            <tr>
                <td><strong>Responsável:</strong> {{ $cliente->responsavel }}</td>
                <td><strong>Email:</strong> {{ $cliente->email }}</td>
                <td><strong>Email:</strong> {{ $cliente->email_2 }}</td>
                <td><strong>Email:</strong> {{ $cliente->email_3 }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong> {{ $cliente->email_4 }}</td>
                <td><strong>Email NF-e:</strong> {{ $cliente->email_nfe }}</td>
                <td><strong>Telefone:</strong> {{ $cliente->fone }}</td>
                <td><strong>Telefone 2:</strong> {{ $cliente->fone_2 }}</td>
            </tr>
            <tr>
                <td><strong>Telefone 3:</strong> {{ $cliente->fone_3 }}</td>
                <td><strong>Celular:</strong> {{ $cliente->celular }}</td>
                <td><strong>Celular 2:</strong> {{ $cliente->celular_2 }}</td>
                <td><strong>Celular 3:</strong> {{ $cliente->celular_3 }}</td>
            </tr>
            <tr>
                <td><strong>CEP:</strong> {{ $cliente->cep }}</td>
                <td><strong>Rua:</strong> {{ $cliente->rua }}</td>
                <td><strong>Número:</strong> {{ $cliente->numero }}</td>
                <td><strong>Complemento:</strong> {{ $cliente->complemento }}</td>
            </tr>
            <tr>

                <td><strong>Bairro:</strong> {{ $cliente->bairro }}</td>
                <td><strong>Cidade:</strong> {{ $cliente->cidade }}</td>
                <td><strong>UF:</strong> {{ $cliente->uf }}</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>Observações:</strong> {{ $cliente->observacoes }}</td>
            </tr>
        </table>
    </div>
@endforeach

</body>
</html>
