@php
    use App\Http\Controllers\Controller;
@endphp

<style>
    /* Centraliza os nav tabs */
    #clientesTabs {
        justify-content: center;
    }
    /* Define a cor para os nav links inativos */
    .nav-tabs .nav-link {
        color: #003162;
    }
    /* Define o estilo para o nav link ativo */
    .nav-tabs .nav-link.active {
        color: #fff;
        background-color: #003162;
        border-color: #003162;
    }
</style>


<!-- Nav Tabs -->
<ul class="nav nav-tabs justify-content-center" id="clientesTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="juridica-tab" data-bs-toggle="tab" href="#juridica" role="tab" aria-controls="juridica" aria-selected="true">
            <i class="fa fa-users mx-1"></i> Pessoa Jurídica
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="fisica-tab" data-bs-toggle="tab" href="#fisica" role="tab" aria-controls="fisica" aria-selected="false">
            <i class="fa fa-user mx-1"></i> Pessoa Física
        </a>
    </li>
</ul>

<div class="tab-content" id="clientesTabsContent">
    <!-- Pessoa Jurídica Tab -->
    <div class="tab-pane fade show active" id="juridica" role="tabpanel" aria-labelledby="juridica-tab">
        <!-- Tabela para telas maiores -->
        <div class="d-none d-lg-block" style="padding-top:60px;">
            <table class="table" id="table-juridico">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th style="white-space: nowrap">CNPJ</th>
                        <th style="white-space: nowrap">Empresa</th>
                        <th style="white-space: nowrap">Fantasia</th>
                        <th style="white-space: nowrap">Telefone</th>
                        <th style="white-space: nowrap">E-mail</th>
                        <th style="white-space: nowrap">Cidade-UF</th>
                        <th class="text-center" style="white-space: nowrap">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        @if($cliente->tipo_pessoa == 1)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->cpf_cnpj }}</td>
                                <td>{{ $cliente->razao_social }}</td>
                                <td>{{ $cliente->nome_fantasia }}</td>
                                <td>{{ $cliente->fone }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->cidade }}-{{ $cliente->uf }}</td>
                                <td class="text-center" style="white-space: nowrap">
                                    <button class="btn btn-sm btn-success btn-edit" data-id="{{ $cliente->id }}"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Cards para celular -->
        <div class="d-lg-none">
            @foreach ($clientes as $cliente)
                @if($cliente->tipo_pessoa == 1)
                    <div class="card mb-3 shadow-sm border-secondary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ $cliente->nome_fantasia }}</h6>
                            <div style="min-width: 75px">
                                <button class="btn btn-sm btn-edit me-2" data-id="{{ $cliente->id }}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-delete" data-id="{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><b>CNPJ:</b> {{ $cliente->cpf_cnpj }}</p>
                            <p><b>Empresa:</b> {{ $cliente->razao_social }}</p>
                            <p><b>Telefone:</b> {{ $cliente->fone }}</p>
                            <p><b>Email:</b> {{ $cliente->email }}</p>
                            <p><b>Cidade-UF:</b> {{ $cliente->cidade }}-{{ $cliente->uf }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Pessoa Física Tab -->
    <div class="tab-pane fade" id="fisica" role="tabpanel" aria-labelledby="fisica-tab">
        @php $exists = false; @endphp
        @foreach ($clientes as $cliente)
            @if($cliente->tipo_pessoa == 2)
                @php $exists = true; @endphp
            @endif
        @endforeach

        @if($exists)
            <!-- Tabela para telas maiores -->
            <div class="d-none d-lg-block" style="padding-top:60px;">
                <table class="table" id="table-fisico">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th style="white-space: nowrap">CPF</th>
                            <th style="white-space: nowrap">Nome</th>
                            <th style="white-space: nowrap">Sobrenome</th>
                            <th style="white-space: nowrap">Telefone</th>
                            <th style="white-space: nowrap">E-mail</th>
                            <th style="white-space: nowrap">Cidade-UF</th>
                            <th class="text-center" style="white-space: nowrap">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            @if($cliente->tipo_pessoa == 2)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->cpf_cnpj }}</td>
                                    <td>{{ $cliente->razao_social }}</td>
                                    <td>{{ $cliente->nome_fantasia }}</td>
                                    <td>{{ $cliente->fone }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->cidade }}-{{ $cliente->uf }}</td>
                                    <td class="text-center" style="white-space: nowrap">
                                        <button class="btn btn-sm btn-success btn-edit" data-id="{{ $cliente->id }}"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cards para celular -->
            <div class="d-lg-none">
                @foreach ($clientes as $cliente)
                    @if($cliente->tipo_pessoa == 2)
                        <div class="card mb-3 shadow-sm border-secondary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">{{ $cliente->razao_social }}</h6>
                                <div style="min-width: 75px">
                                    <button class="btn btn-sm btn-edit me-2" data-id="{{ $cliente->id }}"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-delete" data-id="{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <p><b>CPF:</b> {{ $cliente->cpf_cnpj }}</p>
                                <p><b>Nome:</b> {{ $cliente->razao_social }}</p>
                                <p><b>Telefone:</b> {{ $cliente->fone }}</p>
                                <p><b>Email:</b> {{ $cliente->email }}</p>
                                <p><b>Cidade-UF:</b> {{ $cliente->cidade }}-{{ $cliente->uf }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-center">Nenhum registro para Pessoa Física.</p>
        @endif
    </div>
</div>

<script>
$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();

    $(".btn-edit").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{ route('clientes.form') }}" + '/' + id;
        showModal(url);
    });

    $(".btn-delete").click(function(e) {
        var id = $(this).data('id');
        var url = "{{ route('clientes.delete') }}" + '/' + id;
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

    $('#table-fisico').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        lengthChange: true,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
    });

    $('#table-juridico').DataTable({
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
