@php
    use App\Http\Controllers\Controller;
@endphp

<!-- Pessoa Jurídica -->
<div class="col-md-12 mt-1 form-group mt-3 mb-3">
    <div class="form-separator"><span><i class="fa fa-users mx-2"></i>Pessoa Jurídica</span></div>
</div>

<!-- Tabela para telas maiores -->
<div class="d-none d-lg-block">
    <table class="table" id="table-juridico">
        <thead>
            <th>ID</th>
            <th style="white-space: nowrap">CNPJ</th>
            <th style="white-space: nowrap">Empresa</th>
            <th style="white-space: nowrap">Fantasia</th>
            <th style="white-space: nowrap">Telefone</th>
            <th style="white-space: nowrap">E-mail</th>
            <th style="white-space: nowrap">Cidade-UF</th>
            <th class="text-center" style="white-space: nowrap">Ações</th>
        </thead>
        <tbody>
            @foreach ($fornecedores as $fornecedor)
                @if($fornecedor->tipo_pessoa == 1)
                    <tr>
                        <td>{{$fornecedor->id}}</td>
                        <td>{{$fornecedor->cpf_cnpj}}</td>
                        <td>{{$fornecedor->razao_social}}</td>
                        <td>{{$fornecedor->nome_fantasia}}</td>
                        <td>{{$fornecedor->fone}}</td>
                        <td>{{$fornecedor->email}}</td>
                        <td>{{$fornecedor->cidade}}-{{$fornecedor->uf}}</td>
                        <td class="text-center"  style="white-space: nowrap">
                            <button class="btn btn-sm btn-success btn-edit" data-id="{{$fornecedor->id}}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{$fornecedor->id}}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<!-- Cards para celular -->
<div class="d-lg-none">
    @foreach ($fornecedores as $fornecedor)
        @if($fornecedor->tipo_pessoa == 1)
            <div class="card mb-3 shadow-sm border-secondary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">{{$fornecedor->nome_fantasia}}</h6>
                    <div style="min-width: 75px">
                        <button class="btn btn-sm btn-edit me-2" data-id="{{$fornecedor->id}}"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-sm btn-delete" data-id="{{$fornecedor->id}}"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <p><b>CNPJ:</b> {{$fornecedor->cpf_cnpj}}</p>
                    <p><b>Empresa:</b> {{$fornecedor->razao_social}}</p>
                    <p><b>Telefone:</b> {{$fornecedor->fone}}</p>
                    <p><b>Email:</b> {{$fornecedor->email}}</p>
                    <p><b>Cidade-UF:</b> {{$fornecedor->cidade}}-{{$fornecedor->uf}}</p>
                </div>
            </div>
        @endif
    @endforeach
</div>

<!-- Pessoa Física -->
@php $exists = false; @endphp
@foreach ($fornecedores as $fornecedor)
    @if($fornecedor->tipo_pessoa == 2)
        @php $exists = true; @endphp
    @endif
@endforeach

@if($exists)
    <div class="col-md-12 mt-3 form-group mt-3 mb-3">
        <div class="form-separator"><span><i class="fa fa-user mx-2"></i>Pessoa Física</span></div>
    </div>

    <!-- Tabela para telas maiores -->
    <div class="d-none d-lg-block">
        <table class="table" id="table-fisico">
            <thead>
                <th>ID</th>
                <th style="white-space: nowrap">CPF</th>
                <th style="white-space: nowrap">Nome</th>
                <th style="white-space: nowrap">Sobrenome</th>
                <th style="white-space: nowrap">Telefone</th>
                <th style="white-space: nowrap">E-mail</th>
                <th style="white-space: nowrap">Cidade-UF</th>
                <th class="text-center" style="white-space: nowrap">Ações</th>
            </thead>
            <tbody>
                @foreach ($fornecedores as $fornecedor)
                    @if($fornecedor->tipo_pessoa == 2)
                        <tr>
                            <td>{{$fornecedor->id}}</td>
                            <td>{{$fornecedor->cpf_cnpj}}</td>
                            <td>{{$fornecedor->razao_social}}</td>
                            <td>{{$fornecedor->nome_fantasia}}</td>
                            <td>{{$fornecedor->fone}}</td>
                            <td>{{$fornecedor->email}}</td>
                            <td>{{$fornecedor->cidade}}-{{$fornecedor->uf}}</td>
                            <td class="text-center" style="white-space: nowrap">
                                <button class="btn btn-sm btn-success btn-edit" data-id="{{$fornecedor->id}}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger  btn-delete" data-id="{{$fornecedor->id}}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Cards para celular -->
    <div class="d-lg-none">
        @foreach ($fornecedores as $fornecedor)
            @if($fornecedor->tipo_pessoa == 2)
                <div class="card mb-3 shadow-sm border-secondary">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">{{$fornecedor->razao_social}}</h6>
                        <div style="min-width: 75px">
                            <button class="btn btn-sm btn-edit me-2" data-id="{{$fornecedor->id}}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-delete" data-id="{{$fornecedor->id}}"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><b>CPF:</b> {{$fornecedor->cpf_cnpj}}</p>
                        <p><b>Nome:</b> {{$fornecedor->razao_social}}</p>
                        <p><b>Telefone:</b> {{$fornecedor->fone}}</p>
                        <p><b>Email:</b> {{$fornecedor->email}}</p>
                        <p><b>Cidade-UF:</b> {{$fornecedor->cidade}}-{{$fornecedor->uf}}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif

<script>
$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();


    $(".btn-edit").click(function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var url = "{{route('fornecedores.form')}}" + '/' +id;
        showModal(url);
    });

    $(".btn-delete").click(function(e){

        var id = $(this).data('id');
        var url = "{{route('fornecedores.delete')}}" + '/' +id;
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
                    url:url,
                    type: 'POST',
                    data: {_token: "{{ csrf_token() }}"},
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
                        var errorMessage = 'Erro ao remover licença';
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
                })
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
