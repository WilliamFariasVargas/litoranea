<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Transportadoras</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 4px 6px; text-align: left; vertical-align: top; }
        th { background-color: #f2f2f2; }
        .transportadora { border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-bottom: 5px; }
        .header-transportadora { font-weight: bold; font-size: 11px; margin-bottom: 8px; }
        h2 { text-align: center; margin-bottom: 20px; font-size: 16px; }
    </style>
</head>
<body>

<h2>Relatório de Transportadoras</h2>

@foreach ($transportadoras as $transportadora)
    <div class="transportadora">
        <div class="header-transportadora">{{ $transportadora->razao_social }}</div>

        <table>
            <tr>
                <td><strong>Nome Fantasia:</strong> {{ $transportadora->nome_fantasia }}</td>
                <td><strong>Tipo Pessoa:</strong> {{ $transportadora->tipo_pessoa == 1 ? 'Jurídica' : 'Física' }}</td>
                <td><strong>CPF/CNPJ:</strong> {{ $transportadora->cpf_cnpj }}</td>
                <td><strong>Inscrição Estadual:</strong> {{ $transportadora->inscricao_estadual }}</td>
            </tr>
            <tr>
                <td><strong>Responsável:</strong> {{ $transportadora->responsavel }}</td>
                <td><strong>Email:</strong> {{ $transportadora->email }}</td>
                <td><strong>Email NF-e:</strong> {{ $transportadora->email_nfe }}</td>
                <td><strong>Telefone:</strong> {{ $transportadora->fone }}</td>
            </tr>
            <tr>
                <td><strong>Celular:</strong> {{ $transportadora->celular }}</td>
                <td><strong>CEP:</strong> {{ $transportadora->cep }}</td>
                <td><strong>Rua:</strong> {{ $transportadora->rua }}</td>
                <td><strong>Número:</strong> {{ $transportadora->numero }}</td>
            </tr>
            <tr>
                <td><strong>Complemento:</strong> {{ $transportadora->complemento }}</td>
                <td><strong>Bairro:</strong> {{ $transportadora->bairro }}</td>
                <td><strong>Cidade:</strong> {{ $transportadora->cidade }}</td>
                <td><strong>UF:</strong> {{ $transportadora->uf }}</td>
            </tr>
        </table>
    </div>
@endforeach

</body>
</html>
