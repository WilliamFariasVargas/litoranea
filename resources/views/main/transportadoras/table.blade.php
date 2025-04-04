@php
    use App\Http\Controllers\Controller;
@endphp

<style>
    .table thead tr th { white-space: nowrap; }
</style>

<div class="d-none d-lg-block" style="padding-top:60px;">
    <table class="table" id="table-transportadoras">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th class="text-center" style="white-space: nowrap">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transportadoras as $transportadora)
                <tr>
                    <td>{{ $transportadora->id }}</td>
                    <td>{{ $transportadora->nome }}</td>
                    <td>{{ $transportadora->cnpj }}</td>
                    <td>{{ $transportadora->email }}</td>
                    <td>{{ $transportadora->telefone }}</td>
                    <td class="text-center" style="white-space: nowrap">
                        <button class="btn btn-sm btn-success btn-edit" data-id="{{ $transportadora->id }}"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $transportadora->id }}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-lg-none">
    @foreach ($transportadoras as $transportadora)
        <div class="card mb-3 shadow-sm border-secondary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">{{ $transportadora->nome }}</h6>
                <div style="min-width: 75px">
                    <button class="btn btn-sm btn-success btn-edit me-2" data-id="{{ $transportadora->id }}"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $transportadora->id }}"><i class="fa fa-trash"></i></button>
                </div>
            </div>
            <div class="card-body">
                <p><b>CNPJ:</b> {{ $transportadora->cnpj }}</p>
                <p><b>E-mail:</b> {{ $transportadora->email }}</p>
                <p><b>Telefone:</b> {{ $transportadora->telefone }}</p>
            </div>
        </div>
    @endforeach
</div>

<script>
$(document).ready(function() {
    $(".btn-edit").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{ route('transportadoras.form') }}" + '/' + id;
        showModal(url);
    });
    $(".btn-delete").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{ route('transportadoras.delete') }}" + '/' + id;
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
                    url: url, type: 'POST',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(data) {
                        Swal.fire({ title: 'Sucesso!', text: data.message, icon: 'success', confirmButtonText: 'OK' })
                        .then(function() { tblPopulate(); });
                    },
                    error: function(xhr) {
                        var errorMessage = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Erro ao remover registro';
                        Swal.fire({ title: 'Erro!', text: errorMessage, icon: 'error', confirmButtonText: 'OK' });
                    }
                });
            }
        });
    });
    $('#table-transportadoras').DataTable({
        paging: true, searching: true, ordering: true, lengthChange: true,
        language: { url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json" }
    });
});
</script>
