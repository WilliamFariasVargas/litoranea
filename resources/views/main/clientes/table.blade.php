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
                        <th>CPF/CNPJ</th>
                        <th>Nome (Razão Social)</th>
                        <th>Fantasia (Se houver)</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Cidade-UF</th>
                        <th class="text-center" style="white-space: nowrap">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @php $juridicoExiste = false; @endphp
                    @foreach ($clientes as $cliente)
                        @if($cliente->tipo_pessoa == 1)
                            @php $juridicoExiste = true; @endphp
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->cpf }}</td>
                                <td>{{ $cliente->nome }}</td>
                                <td>{{ $cliente->sobrenome }}</td>
                                <!-- ou nome_fantasia, caso use esse campo -->
                                <td>{{ $cliente->telefone }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->cidade }}-{{ $cliente->uf }}</td>
                                <td class="text-center" style="white-space: nowrap">
                                    <button class="btn btn-sm btn-success btn-edit" data-id="{{ $cliente->id }}"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @if(!$juridicoExiste)
                        <tr>
                            <td colspan="8" class="text-center">Nenhum registro encontrado</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Cards para celular -->
        <div class="d-lg-none">
            @php $juridicoExisteMobile = false; @endphp
            @foreach ($clientes as $cliente)
                @if($cliente->tipo_pessoa == 1)
                    @php $juridicoExisteMobile = true; @endphp
                    <div class="card mb-3 shadow-sm border-secondary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ $cliente->nome }}</h6>
                            <div style="min-width: 75px">
                                <button class="btn btn-sm btn-edit me-2" data-id="{{ $cliente->id }}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-delete" data-id="{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><b>CPF/CNPJ:</b> {{ $cliente->cpf }}</p>
                            <p><b>Razão Social:</b> {{ $cliente->nome }}</p>
                            <p><b>Telefone:</b> {{ $cliente->telefone }}</p>
                            <p><b>E-mail:</b> {{ $cliente->email }}</p>
                            <p><b>Cidade-UF:</b> {{ $cliente->cidade }}-{{ $cliente->uf }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
            @if(!$juridicoExisteMobile)
                <p class="text-center">Nenhum registro encontrado</p>
            @endif
        </div>
    </div>

    <!-- Pessoa Física Tab -->
    <div class="tab-pane fade" id="fisica" role="tabpanel" aria-labelledby="fisica-tab">
        <!-- Tabela para telas maiores -->
        <div class="d-none d-lg-block" style="padding-top:60px;">
            <table class="table" id="table-fisico">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Cidade-UF</th>
                        <th class="text-center" style="white-space: nowrap">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @php $fisicoExiste = false; @endphp
                    @foreach ($clientes as $cliente)
                        @if($cliente->tipo_pessoa == 2)
                            @php $fisicoExiste = true; @endphp
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->cpf }}</td>
                                <td>{{ $cliente->nome }}</td>
                                <td>{{ $cliente->sobrenome }}</td>
                                <td>{{ $cliente->telefone }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->cidade }}-{{ $cliente->uf }}</td>
                                <td class="text-center" style="white-space: nowrap">
                                    <button class="btn btn-sm btn-success btn-edit" data-id="{{ $cliente->id }}"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @if(!$fisicoExiste)
                        <tr>
                            <td colspan="8" class="text-center">Nenhum registro encontrado</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Cards para celular -->
        <div class="d-lg-none">
            @php $fisicoExisteMobile = false; @endphp
            @foreach ($clientes as $cliente)
                @if($cliente->tipo_pessoa == 2)
                    @php $fisicoExisteMobile = true; @endphp
                    <div class="card mb-3 shadow-sm border-secondary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ $cliente->nome }}</h6>
                            <div style="min-width: 75px">
                                <button class="btn btn-sm btn-edit me-2" data-id="{{ $cliente->id }}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-delete" data-id="{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><b>CPF:</b> {{ $cliente->cpf }}</p>
                            <p><b>Nome:</b> {{ $cliente->nome }}</p>
                            <p><b>Sobrenome:</b> {{ $cliente->sobrenome }}</p>
                            <p><b>Telefone:</b> {{ $cliente->telefone }}</p>
                            <p><b>E-mail:</b> {{ $cliente->email }}</p>
                            <p><b>Cidade-UF:</b> {{ $cliente->cidade }}-{{ $cliente->uf }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
            @if(!$fisicoExisteMobile)
                <p class="text-center">Nenhum registro encontrado</p>
            @endif
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Tooltip (se necessário)
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Botão Editar
    $(".btn-edit").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{ route('clientes.form') }}" + '/' + id;
        showModal(url);
    });

    // Botão Excluir
    $(".btn-delete").click(function(e) {
        e.preventDefault();
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
                            tblPopulate(); // Recarrega a tabela
                        });
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

    // DataTables para as duas tabelas
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
