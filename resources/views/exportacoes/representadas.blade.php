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
        .registro { border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-bottom: 5px; }
        .header-registro { font-weight: bold; font-size: 11px; margin-bottom: 8px; }
        h2 { text-align: center; margin-bottom: 20px; font-size: 16px; }
    </style>
</head>
<body>

<h2>Relatório de Representadas</h2>

@foreach ($representadas as $r)
    <div class="registro">
        <div class="header-registro">{{ $r->razao_social }}</div>

        <table>
            <tr>
                <td><strong>Nome Fantasia:</strong> {{ $r->nome_fantasia }}</td>
                <td><strong>Tipo Pessoa:</strong> {{ $r->tipo_pessoa == 1 ? 'Jurídica' : 'Física' }}</td>
                <td><strong>CPF/CNPJ:</strong> {{ $r->cpf_cnpj }}</td>
                <td><strong>Inscrição Estadual:</strong> {{ $r->inscricao_estadual }}</td>
            </tr>
            <tr>
                <td><strong>Responsável:</strong> {{ $r->responsavel }}</td>
                <td><strong>Email:</strong> {{ $r->email }}</td>
                <td><strong>Email 2:</strong> {{ $r->email_2 }}</td>
                <td><strong>Email 3:</strong> {{ $r->email_3 }}</td>
            </tr>
            <tr>
                <td><strong>Email 4:</strong> {{ $r->email_4 }}</td>
                <td><strong>Email NF-e:</strong> {{ $r->email_nfe }}</td>
                <td><strong>Telefone:</strong> {{ $r->fone }}</td>
                <td><strong>Telefone 2:</strong> {{ $r->fone_2 }}</td>
            </tr>
            <tr>
                <td><strong>Telefone 3:</strong> {{ $r->fone_3 }}</td>
                <td><strong>Celular:</strong> {{ $r->celular }}</td>
                <td><strong>Celular 2:</strong> {{ $r->celular_2 }}</td>
                <td><strong>Celular 3:</strong> {{ $r->celular_3 }}</td>
            </tr>
            <tr>
                <td><strong>CEP:</strong> {{ $r->cep }}</td>
                <td><strong>Rua:</strong> {{ $r->rua }}</td>
                <td><strong>Número:</strong> {{ $r->numero }}</td>
                <td><strong>Complemento:</strong> {{ $r->complemento }}</td>
            </tr>
            <tr>
                <td><strong>Bairro:</strong> {{ $r->bairro }}</td>
                <td><strong>Cidade:</strong> {{ $r->cidade }}</td>
                <td><strong>UF:</strong> {{ $r->uf }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Observações:</strong> {{ $r->observacoes }}</td>
            </tr>
        </table>
    </div>
@endforeach

</body>
</html>
