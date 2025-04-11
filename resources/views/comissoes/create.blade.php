@extends('layouts.pages')

@section('page-content')


<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('comissoes.store') }}" method="POST" id="form-comissao" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pedido</label>
            <select name="pedido_id" class="form-select" required>
                <option value="">Selecione um pedido</option>
                @foreach($pedidos as $pedido)
                    <option value="{{ $pedido->id }}">
                        Pedido #{{ $pedido->numero_pedido }} - {{ $pedido->cliente->nome ?? 'Cliente' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Percentual de Comissão (%)</label>
                <input type="number" name="percentual" step="0.01" class="form-control" placeholder="Ex: 5.00">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Ou Valor Fixo (R$)</label>
                <input type="number" name="valor" step="0.01" class="form-control" placeholder="Ex: 150.00">
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Salvar Comissão</button>
        </div>
    </form>
</div>
@endsection
