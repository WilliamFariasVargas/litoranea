@php
    use App\Http\Controllers\Controller;
@endphp

<style>
    .table thead tr th { white-space: nowrap; }
</style>

<div class="d-none d-lg-block" style="padding-top:60px;">
    <table class="table" id="table-pedidos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente ID</th>
                <th>Data do Pedido</th>
                <th>Status</th>
                <th>Valor Total</th>
                <th class="text-center" style="white-space: nowrap">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if($pedidos->count() > 0)
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->cliente_id }}</td>
                        <td>{{ $pedido->data_pedido }}</td>
                        <td>{{ $pedido->status }}</td>
                        <td>{{ $pedido->valor_total }}</td>
                        <td class="text-center" style="white-space: nowrap">
                            <button class="btn btn-sm btn-success btn-edit" data-id="{{ $pedido->id }}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $pedido->id }}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">Nenhum registro encontrado</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Versão mobile -->
<div class="d-lg-none">
    @if($pedidos->count() > 0)
        @foreach($pedidos as $pedido)
            <div class="card mb-3 shadow-sm border-secondary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Pedido #{{ $pedido->id }}</h6>
                    <div style="min-width: 75px">
                        <button class="btn btn-sm btn-success btn-edit me-2" data-id="{{ $pedido->id }}"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $pedido->id }}"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <p><b>Cliente ID:</b> {{ $pedido->cliente_id }}</p>
                    <p><b>Data:</b> {{ $pedido->data_pedido }}</p>
                    <p><b>Status:</b> {{ $pedido->status }}</p>
                    <p><b>Valor Total:</b> {{ $pedido->valor_total }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">Nenhum registro encontrado</p>
    @endif
</div>

<script>
$(document).ready(function() {
    $(".btn-edit").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{ route('pedidos.form') }}" + '/' + id;
        showModal(url);
    });
    $(".btn-delete").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{ route('pedidos.delete') }}" + '/' + id;
        swal.fire({
            title: 'Atenção',
            text: "Você deseja excluir o registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(data) {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function(){
                            tblPopulate();
                        });
                        $("#closeModal").trigger('click');
                    },
                    error: function(xhr) {
                        var errorMessage = 'Erro ao remover registro';
                        if(xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            title: 'Erro!',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
    $('#table-pedidos').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        lengthChange: true,
        language: { url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json" }
    });
});
</script>
@endsection
