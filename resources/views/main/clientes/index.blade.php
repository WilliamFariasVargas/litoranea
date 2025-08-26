@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-4" style="vertical-align: middle">
            <h4 style="color:#003162;" class="title mt-2">
                <i class="fa fa-users mx-2"></i>Cadastro de Cliente
            </h4>
        </div>
        <div class="col-8 text-end">
            @php
                $cidades = \App\Models\Cliente::select('cidade')
                    ->distinct()
                    ->orderBy('cidade')
                    ->pluck('cidade');
            @endphp



            {{-- Form de exportação --}}
            <form action="{{ route('exportar.clientes') }}" method="GET" class="d-inline-flex align-items-center gap-2" id="formExportClientes">
                <select name="orderBy" id="orderBy" class="form-select form-select-sm" style="width: 150px;">
                    <option value="razao_social" {{ request('orderBy') == 'razao_social' ? 'selected' : '' }}>Nome</option>
                    <option value="cidade" {{ request('orderBy') == 'cidade' ? 'selected' : '' }}>Cidade</option>
                    <option value="id" {{ request('orderBy') == 'id' ? 'selected' : '' }}>ID</option>
                </select>

                <select name="cidade" id="cidadeSelect" class="form-select form-select-sm" style="width: 180px; display: none;">
                    <option value="">Todas as cidades</option> {{-- Adicionei esta linha --}}
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade }}" {{ request('cidade') == $cidade ? 'selected' : '' }}>
                            {{ $cidade }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-users mx-2"></i> Exportar Clientes
                </button>
            </form>

            {{-- Botão Novo Cliente --}}
            <button id="addNew" class="btn btn-primary me-2">
                <i class="fa fa-plus-circle"></i> Novo Cliente
            </button>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Toggle do select de cidade
                    const orderBySelect = document.getElementById('orderBy');
                    const cidadeSelect  = document.getElementById('cidadeSelect');

                    function toggleCidadeSelect() {
                        if (orderBySelect.value === 'cidade') {
                            cidadeSelect.style.display  = 'inline-block';
                            cidadeSelect.required       = false; // Removi a validação para permitir "Todas as cidades"
                        } else {
                            cidadeSelect.style.display  = 'none';
                            cidadeSelect.required       = false;
                            cidadeSelect.value          = '';
                        }
                    }
                    orderBySelect.addEventListener('change', toggleCidadeSelect);
                    toggleCidadeSelect();

                    // Evento do botão Novo Cliente
                    document.getElementById('addNew').addEventListener('click', function() {
                        showModal("{{ route('clientes.form') }}");
                    });
                });
            </script>
        </div>
        <br><br><hr>
    </div>
</section>

<section class="col-md-12 mt-2 container-fluid" id="divTable"></section>

<script>
    function tblPopulate() {
        $.ajax({
            url: "{{ route('clientes.show') }}",
            method: "GET",
            beforeSend: function() {
                $("#divTable").html("Carregando");
            },
            success: function(response) {
                $("#divTable").html(response);
            },
            error: function() {
                $("#divTable").html('Erro ao carregar dados');
            }
        });
    }

    $(document).ready(tblPopulate);
</script>
@endsection
