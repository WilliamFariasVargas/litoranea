<!DOCTYPE html>
<html>
<head>
    <title>Representadas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: center; }
    </style>
</head>
<body>

<h3 style="text-align: center;">Lista de Representadas</h3>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($representadas as $rep)
        <tr>
            <td>{{ $rep->razao_social }}</td>
            <td>{{ $rep->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
