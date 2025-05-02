<form method="GET" action="{{ route('cadastrodepedido.index') }}" id="filter_form" class="row g-3 mb-4">




<table class="table table-striped">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Representada</th>
            <th>Transportadora</th>
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
            <td>{{ $pedido->representada->razao_social ?? '-' }}</td>
            <td>{{ $pedido->transportadora->razao_social ?? '-' }}</td>
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

<div class="mt-4">
    <h5 class="mb-2">Totais:</h5>
    <ul class="list-unstyled">
        <li><strong>Valor total dos pedidos:</strong> R$ {{ number_format($valor_total, 2, ',', '.') }}</li>
        <li><strong>Valor total faturado:</strong> R$ {{ number_format($valor_total_faturado, 2, ',', '.') }}</li>
        <li><strong>Valor total comissão parcial:</strong> R$ {{ number_format($valor_total_comissao_parcial, 2, ',', '.') }}</li>
        <li><strong>Valor total comissão faturada:</strong> R$ {{ number_format($valor_total_comissao_faturada, 2, ',', '.') }}</li>
    </ul>
</div>

<script>
    function editPedido(id) {
    event.preventDefault(); // <-- Isso impede o submit padrão
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
