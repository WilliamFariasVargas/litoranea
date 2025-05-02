<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Representadas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 4px 6px; text-align: left; vertical-align: top; }
        th { background-color: #f2f2f2; }
        .representada { border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-bottom: 5px; }
        .header-representada { font-weight: bold; font-size: 11px; margin-bottom: 8px; }
        h2 { text-align: center; margin-bottom: 20px; font-size: 16px; }
    </style>
</head>
<body>

<h2>Relatório de Representadas</h2>

@foreach ($representadas as $representada)
    <div class="representada">
        <div class="header-representada">{{ $representada->razao_social }}</div>

        <table>
            <tr>
                <td><strong>Nome Fantasia:</strong> {{ $representada->nome_fantasia }}</td>
                <td><strong>Tipo Pessoa:</strong> {{ $representada->tipo_pessoa == 1 ? 'Jurídica' : 'Física' }}</td>
                <td><strong>CPF/CNPJ:</strong> {{ $representada->cpf_cnpj }}</td>
                <td><strong>Inscrição Estadual:</strong> {{ $representada->inscricao_estadual }}</td>
            </tr>
            <tr>
                <td><strong>Responsável:</strong> {{ $representada->responsavel }}</td>
                <td><strong>Email:</strong> {{ $representada->email }}</td>
                <td><strong>Email NF-e:</strong> {{ $representada->email_nfe }}</td>
                <td><strong>Telefone:</strong> {{ $representada->fone }}</td>
            </tr>
            <tr>
                <td><strong>Celular:</strong> {{ $representada->celular }}</td>
                <td><strong>CEP:</strong> {{ $representada->cep }}</td>
                <td><strong>Rua:</strong> {{ $representada->rua }}</td>
                <td><strong>Número:</strong> {{ $representada->numero }}</td>
            </tr>
            <tr>
                <td><strong>Complemento:</strong> {{ $representada->complemento }}</td>
                <td><strong>Bairro:</strong> {{ $representada->bairro }}</td>
                <td><strong>Cidade:</strong> {{ $representada->cidade }}</td>
                <td><strong>UF:</strong> {{ $representada->uf }}</td>
            </tr>
        </table>
    </div>
@endforeach

</body>
</html>
