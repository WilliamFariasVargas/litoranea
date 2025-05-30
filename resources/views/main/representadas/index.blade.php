@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-6" style="vertical-align: middle">
            <h4 style="color:#003162;" class="title mt-2">
                <i class="fa fa-building mx-2"></i>Cadastro de Representadas
            </h4>
        </div>

        <div class="col-6 text-end">
            @php
                $cidadesRepresentadas = \App\Models\Representada::select('cidade')
                    ->distinct()
                    ->orderBy('cidade')
                    ->pluck('cidade');
            @endphp



            {{-- Form de exportação --}}
            <form action="{{ route('exportar.representadas') }}" method="GET"
                  class="d-inline-flex align-items-center gap-2" id="formExportRepresentadas">
                <select name="orderBy" id="orderByRepresentadas" class="form-select form-select-sm" style="width: 150px;">
                    <option value="razao_social" {{ request('orderBy')=='razao_social' ? 'selected':'' }}>Nome</option>
                    <option value="cidade"        {{ request('orderBy')=='cidade'        ? 'selected':'' }}>Cidade</option>
                    <option value="id"            {{ request('orderBy')=='id'            ? 'selected':'' }}>ID</option>
                </select>

                <select name="cidade" id="cidadeSelectRepresentadas"
                        class="form-select form-select-sm" style="width: 180px; display: none;">
                    <option value="">Selecione a cidade</option>
                    @foreach($cidadesRepresentadas as $cidade)
                        <option value="{{ $cidade }}"
                            {{ request('cidade')==$cidade ? 'selected':'' }}>
                            {{ $cidade }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-outline-success">
                    <i class="fas fa-building mx-1"></i>Exportar
                </button>
            </form>

            {{-- Botão Novo --}}
            <button id="addNew" class="btn btn-success me-2">
                <i class="fa fa-plus mx-1"></i>Novo
            </button>
        </div>

        <div class="w-100"><br><hr></div>
    </div>
</section>

<section class="col-md-12 mt-2 container-fluid" id="divTable">
    {{-- Tabela carregada via AJAX --}}
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle do select de cidade
        const orderBy = document.getElementById('orderByRepresentadas');
        const cidade  = document.getElementById('cidadeSelectRepresentadas');
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

        // Botão Novo
        document.getElementById('addNew').addEventListener('click', function() {
            showModal("{{ route('representadas.form') }}");
        });

        // Carrega tabela
        function tblPopulate() {
            $.ajax({
                url: "{{ route('representadas.show') }}",
                method: "GET",
                beforeSend: function() {
                    $("#divTable").html("Carregando...");
                },
                success: function(res) {
                    $("#divTable").html(res);
                },
                error: function() {
                    $("#divTable").html("Erro ao carregar dados");
                }
            });
        }
        tblPopulate();
    });
</script>
@endsection
