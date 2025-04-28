@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastro de Pedidos</h1>

    <div class="mb-3">
        <button class="btn btn-primary" id="novoPedidoBtn">Novo Pedido</button>
    </div>

    {{-- Filtros + Tabela --}}
    <div id="tabelaPedidos">

        <form method="GET" action="{{ route('cadastrodepedido.index') }}" id="filter_form" class="row g-3 mb-4">

            <div class="col-md-3">
                <label>Cliente:</label>
                <select name="cliente_id" class="form-control select2">
                    <option value="">Selecione</option>
                    @foreach(\App\Models\Cliente::all() as $cliente)
                        <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->razao_social }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Representada:</label>
                <select name="representada_id" class="form-control select2">
                    <option value="">Selecione</option>
                    @foreach(\App\Models\Representada::all() as $rep)
                        <option value="{{ $rep->id }}" {{ request('representada_id') == $rep->id ? 'selected' : '' }}>
                            {{ $rep->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Transportadora:</label>
                <select name="transportadora_id" class="form-control select2">
                    <option value="">Selecione</option>
                    @foreach(\App\Models\Transportadora::all() as $trans)
                        <option value="{{ $trans->id }}" {{ request('transportadora_id') == $trans->id ? 'selected' : '' }}>
                            {{ $trans->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-1">
                <label>Mês:</label>
                <input type="number" name="mes" class="form-control" value="{{ request('mes') }}" min="1" max="12">
            </div>

            <div class="col-md-1">
                <label>Ano:</label>
                <input type="number" name="ano" class="form-control" value="{{ request('ano') }}">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <a href="#" id="export_excel" class="btn btn-success w-100">Exportar Excel</a>
            </div>

        </form>

        <h5 class="mb-3">Valor total dos pedidos: <strong>R$ {{ number_format($valor_total, 2, ',', '.') }}</strong></h5>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Representada</th>
                    <th>Valor Pedido</th>
                    <th>Valor Faturado</th>
                    <th>Data Pedido</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->cliente->razao_social ?? '-' }}</td>
                    <td>{{ $pedido->representada->nome ?? '-' }}</td>
                    <td>R$ {{ number_format($pedido->valor_pedido, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($pedido->valor_faturado, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pedido->data_pedido)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('cadastrodepedido.edit', $pedido->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('cadastrodepedido.destroy', $pedido->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div> {{-- FIM #tabelaPedidos --}}
</div>
@endsection

@section('scripts')
<script>

$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Selecione",
        allowClear: true
    });

    // Abrir modal para novo pedido
    $('#novoPedidoBtn').click(function() {
        $.ajax({
            url: "{{ route('cadastrodepedido.create') }}",
            method: 'GET',
            success: function(data) {
                showModal(data); // Função padrão do seu projeto
            },
            error: function() {
                Swal.fire('Erro!', 'Não foi possível carregar o formulário.', 'error');
            }
        });
    });

    // Exportar Excel com filtros aplicados
    $('#export_excel').click(function(e) {
        e.preventDefault();
        var queryString = $('#filter_form').serialize();
        window.open("{{ route('cadastrodepedido.export') }}?" + queryString, '_blank');
    });

    // Atualizar tabela dinamicamente
    $('#filter_form').submit(function(e) {
        e.preventDefault();
        tblPopulate();
    });
});

// Função de recarregar a tabela
function tblPopulate() {
    $.ajax({
        url: "{{ route('cadastrodepedido.index') }}",
        data: $('#filter_form').serialize(),
        success: function(data) {
            $('#tabelaPedidos').html($(data).find('#tabelaPedidos').html());
        },
        error: function(xhr) {
            Swal.fire('Erro!', 'Não foi possível atualizar a lista.', 'error');
        }
    });
}

</script>
@endsection
