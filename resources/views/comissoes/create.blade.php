

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif


@extends('layouts.pages')
<form method="POST" action="{{ route('comissoes.store') }}">
    @csrf

    <label>Pedido:</label>
    <select name="pedido_id">
        @foreach($pedidos as $pedido)
            <option value="{{ $pedido->id }}">
                Pedido #{{ $pedido->numero_pedido }} - {{ $pedido->cliente->nome ?? 'Cliente' }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Percentual de Comissão (%):</label>
    <input type="number" name="percentual" step="0.01">

    <br><br>

    <label>Ou Valor Fixo (R$):</label>
    <input type="number" name="valor" step="0.01">

    <br><br>

    <button type="submit">Salvar Comissão</button>
</form>
