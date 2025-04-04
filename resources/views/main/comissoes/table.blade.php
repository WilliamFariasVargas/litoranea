@php
    use App\Http\Controllers\Controller;
@endphp

<style>
    /* Ajusta a tabela */
    .table thead tr th { white-space: nowrap; }
</style>

<div class="d-none d-lg-block" style="padding-top:60px;">
    <table class="table" id="table-comissoes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pedido ID</th>
                <th>Valor</th>
                <th>Porcentagem</th>
                <th>Data</th>
                <th class="text-center" style="white-space: nowrap">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if($comissoes->count() > 0)
                @foreach ($comissoes as $comissao)
                    <tr>
                        <td>{{ $comissao->id }}</td>
                        <td>{{ $comissao->pedido_id }}</td>
                        <td>{{ $comissao->valor }}</td>
                        <td>{{ $comissao->porcentagem }}</td>
                        <td>{{ $comissao->data }}</td>
                        <td class="text-center" style="white-space: nowrap">
                            <button class="btn btn-sm btn-success btn-edit" data-id="{{ $comissao->id }}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $comissao->id }}"><i class="fa fa-trash"></i></button>
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
    @if($comissoes->count() > 0)
        @foreach ($comissoes as $comissao)
            <div class="card mb-3 shadow-sm border-secondary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Comissão #{{ $comissao->id }}</h6>
                    <div style="min-width: 75px">
                        <button class="btn btn-sm btn-success btn-edit me-2" data-id="{{ $comissao->id }}"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $comissao->id }}"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <p><b>Pedido ID:</b> {{ $comissao->pedido_id }}</p>
                    <p><b>Valor:</b> {{ $comissao->valor }}</p>
                    <p><b>Porcentagem:</b> {{ $comissao->porcentagem }}</p>
                    <p><b>Data:</b> {{ $comissao->data }}</p>
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
        var url = "{{ route('comissoes.form') }}" + '/' + id;
        showModal(url);
    });
    $(".btn-delete").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{ route('comissoes.delete') }}" + '/' + id;
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
            if (result.isConfirmed) {
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
                        }).then(function() {
                            tblPopulate();
                        });
                        $("#closeModal").trigger('click');
                    },
                    error: function(xhr) {
                        var errorMessage = 'Erro ao remover registro';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
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
    // Inicializa DataTables
    $('#table-comissoes').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        lengthChange: true,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
    });
});
</script>
