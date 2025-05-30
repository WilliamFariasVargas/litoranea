@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-6">
            <h4 style="color:#003162;" class="title mt-2">
                <i class="fa fa-truck mx-2"></i>Cadastro de Transportadoras
            </h4>
        </div>
        <div class="col-6 text-end">
            @php
                $cidadesTransportadoras = \App\Models\Transportadora::select('cidade')
                    ->distinct()
                    ->orderBy('cidade')
                    ->pluck('cidade');
            @endphp


            {{-- Form de exportação --}}
            <form action="{{ route('exportar.transportadoras') }}" method="GET"
                  class="d-inline-flex align-items-center gap-2" id="formExportTransportadoras">
                <select name="orderBy" id="orderByTransportadoras"
                        class="form-select form-select-sm" style="width: 150px;">
                    <option value="razao_social" {{ request('orderBy')=='razao_social' ? 'selected':'' }}>Nome</option>
                    <option value="cidade"        {{ request('orderBy')=='cidade'        ? 'selected':'' }}>Cidade</option>
                    <option value="id"            {{ request('orderBy')=='id'            ? 'selected':'' }}>ID</option>
                </select>

                <select name="cidade" id="cidadeSelectTransportadoras"
                        class="form-select form-select-sm" style="width: 180px; display: none;">
                    <option value="">Selecione a cidade</option>
                    @foreach($cidadesTransportadoras as $cidade)
                        <option value="{{ $cidade }}"
                            {{ request('cidade')==$cidade ? 'selected':'' }}>
                            {{ $cidade }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-outline-warning">
                    <i class="fas fa-truck mx-1"></i>Exportar
                </button>
            </form>

             {{-- Botão Novo Transportadora --}}
            <button id="addNew" class="btn btn-warning me-2">
                <i class="fa fa-plus mx-1"></i>Novo
            </button>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const orderBy = document.getElementById('orderByTransportadoras');
                    const cidade  = document.getElementById('cidadeSelectTransportadoras');
                    function toggleCidade() {
                        if (orderBy.value === 'cidade') {
                            cidade.style.display = 'inline-block';
                            cidade.required = true;
                        } else {
                            cidade.style.display = 'none';
                            cidade.required = false;
                            cidade.value = '';
                        }
                    }
                    orderBy.addEventListener('change', toggleCidade);
                    toggleCidade();
                });
            </script>
        </div>
        <div class="w-100"><br><hr></div>
    </div>
</section>

<section class="col-md-12 mt-2 container-fluid" id="divTable">
    {{-- Tabela carregada via AJAX --}}
</section>

<script>
    // Abre modal de cadastro
    $("#addNew").click(function(){
        showModal("{{ route('transportadoras.form') }}");
    });

    // Popula tabela via AJAX
    function tblPopulate(){
        $.ajax({
            url: "{{ route('transportadoras.show') }}",
            method: "GET",
            beforeSend: function(){
                $("#divTable").html("Carregando...");
            },
            success: function(response){
                $("#divTable").html(response);
            },
            error: function(){
                $("#divTable").html("Erro ao carregar dados");
            }
        });
    }

    // Executa no load
    $(document).ready(tblPopulate);
</script>
@endsection
