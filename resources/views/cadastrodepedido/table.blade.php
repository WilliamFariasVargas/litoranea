<form method="GET" action="{{ route('cadastrodepedido.index') }}" id="filter_form" class="row g-3 mb-4">

    {{-- Cliente --}}
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

    {{-- Representada --}}
    <div class="col-md-3">
        <label>Representada:</label>
        <select name="representada_id" class="form-control select2">
            <option value="">Selecione</option>
            @foreach(\App\Models\Representada::all() as $rep)
                <option value="{{ $rep->id }}" {{ request('representada_id') == $rep->id ? 'selected' : '' }}>
                    {{ $rep->razao_social }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Transportadora --}}
    <div class="col-md-3">
        <label>Transportadora:</label>
        <select name="transportadora_id" class="form-control select2">
            <option value="">Selecione</option>
            @foreach(\App\Models\Transportadora::all() as $trans)
                <option value="{{ $trans->id }}" {{ request('transportadora_id') == $trans->id ? 'selected' : '' }}>
                    {{ $trans->razao_social }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Mês --}}
    <div class="col-md-1">
        <label>Mês:</label>
        <input type="number" name="mes" class="form-control" min="1" max="12" value="{{ request('mes') }}">
    </div>

    {{-- Ano --}}
    <div class="col-md-1">
        <label>Ano:</label>
        <input type="number" name="ano" class="form-control" value="{{ request('ano') }}">
    </div>

    {{-- Botão Filtrar --}}
    <div class="col-md-1 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>

</form>

<h5 class="mb-3">
    Valor total dos pedidos: <strong>R$ {{ number_format($valor_total, 2, ',', '.') }}</strong>
</h5>

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
                <div class="d-flex gap-1">
                    <button onclick="editPedido({{ $pedido->id }})" class="btn btn-sm btn-warning">Editar</button>

                    <button onclick="deletePedido({{ $pedido->id }})" class="btn btn-sm btn-danger">Excluir</button>

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    function editPedido(id) {
        $.ajax({
            url: "{{ url('cadastrodepedido') }}/" + id + "/edit",
            method: 'GET',
            success: function(data) {
                showModal(data);
            },
            error: function() {
                Swal.fire('Erro!', 'Não foi possível carregar o formulário de edição.', 'error');
            }
        });
    }

    function deletePedido(id) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Essa ação não poderá ser desfeita!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('cadastrodepedido') }}/" + id,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Excluído!', response.message, 'success');
                        tblPopulate(); // Atualiza a tabela
                    },
                    error: function() {
                        Swal.fire('Erro!', 'Erro ao excluir o pedido.', 'error');
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        // Inicializa o select2 para o filtro normal (sem AJAX no filtro)
        $('#filter_form select.select2').select2({
            placeholder: 'Selecione',
            allowClear: true
        });

        // Filtro funcionando por AJAX
        $('#filter_form').submit(function(e) {
            e.preventDefault();

            var queryString = $(this).serialize();

            $.ajax({
                url: "{{ route('cadastrodepedido.tabela') }}?" + queryString,
                method: "GET",
                beforeSend: function() {
                    $("#divTable").html("Carregando...");
                },
                success: function(response) {
                    $("#divTable").html(response);
                },
                error: function() {
                    Swal.fire('Erro!', 'Erro ao carregar os pedidos.', 'error');
                }
            });
        });
    });
    </script>
