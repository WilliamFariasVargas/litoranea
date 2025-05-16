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
        .registro { border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-bottom: 5px; }
        .header-registro { font-weight: bold; font-size: 11px; margin-bottom: 8px; }
        h2 { text-align: center; margin-bottom: 20px; font-size: 16px; }
    </style>
</head>
<body>

<h2>Relatório de Transportadoras</h2>

@foreach ($transportadoras as $t)
    <div class="registro">
        <div class="header-registro">{{ $t->razao_social }}</div>

        <table>
            <tr>
                <td><strong>Nome Fantasia:</strong> {{ $t->nome_fantasia }}</td>
                <td><strong>Tipo Pessoa:</strong> {{ $t->tipo_pessoa == 1 ? 'Jurídica' : 'Física' }}</td>
                <td><strong>CPF/CNPJ:</strong> {{ $t->cpf_cnpj }}</td>
                <td><strong>Inscrição Estadual:</strong> {{ $t->inscricao_estadual }}</td>
            </tr>
            <tr>
                <td><strong>Responsável:</strong> {{ $t->responsavel }}</td>
                <td><strong>Email:</strong> {{ $t->email }}</td>
                <td><strong>Email 2:</strong> {{ $t->email_2 }}</td>
                <td><strong>Email 3:</strong> {{ $t->email_3 }}</td>
            </tr>
            <tr>
                <td><strong>Email 4:</strong> {{ $t->email_4 }}</td>
                <td><strong>Email NF-e:</strong> {{ $t->email_nfe }}</td>
                <td><strong>Telefone:</strong> {{ $t->fone }}</td>
                <td><strong>Telefone 2:</strong> {{ $t->fone_2 }}</td>
            </tr>
            <tr>
                <td><strong>Telefone 3:</strong> {{ $t->fone_3 }}</td>
                <td><strong>Celular:</strong> {{ $t->celular }}</td>
                <td><strong>Celular 2:</strong> {{ $t->celular_2 }}</td>
                <td><strong>Celular 3:</strong> {{ $t->celular_3 }}</td>
            </tr>
            <tr>
                <td><strong>CEP:</strong> {{ $t->cep }}</td>
                <td><strong>Rua:</strong> {{ $t->rua }}</td>
                <td><strong>Número:</strong> {{ $t->numero }}</td>
                <td><strong>Complemento:</strong> {{ $t->complemento }}</td>
            </tr>
            <tr>
                <td><strong>Bairro:</strong> {{ $t->bairro }}</td>
                <td><strong>Cidade:</strong> {{ $t->cidade }}</td>
                <td><strong>UF:</strong> {{ $t->uf }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Observações:</strong> {{ $t->observacoes }}</td>
            </tr>
        </table>
    </div>
@endforeach

</body>
</html>
