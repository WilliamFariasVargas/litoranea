<!DOCTYPE html>
<html>
<head>
    <title>Transportadoras</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: center; }
    </style>
</head>
<body>

<h3 style="text-align: center;">Lista de Transportadoras</h3>

<table>
    <thead>
        <tr>
            <th>Nome/Razão Social</th>
            <th>CPF/CNPJ</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transportadoras as $trans)
        <tr>
            <td>{{ $trans->razao_social }}</td>
            <td>{{ $trans->cpf_cnpj }}</td>
            <td>{{ $trans->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
