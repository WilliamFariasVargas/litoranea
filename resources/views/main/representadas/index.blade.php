@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-6" style="vertical-align: middle">
            <h4 style="color:#003162;" class="title  mt-2">
                <i class="fa fa-building mx-2"></i>Cadastro de Representadas
            </h4>
        </div>
        <div class="col-6 text-end">
            @php
    $cidadesRepresentadas = \App\Models\Representada::select('cidade')->distinct()->orderBy('cidade')->pluck('cidade');
@endphp

<form action="{{ route('exportar.representadas') }}" method="GET" class="d-inline-flex align-items-center gap-2" id="formExportRepresentadas">
    <select name="orderBy" id="orderByRepresentadas" class="form-select form-select-sm" style="width: 150px;">
        <option value="razao_social" {{ request('orderBy') == 'razao_social' ? 'selected' : '' }}>Nome</option>
        <option value="cidade" {{ request('orderBy') == 'cidade' ? 'selected' : '' }}>Cidade</option>
        <option value="id" {{ request('orderBy') == 'id' ? 'selected' : '' }}>ID</option>
    </select>

    <select name="cidade" id="cidadeSelectRepresentadas" class="form-select form-select-sm" style="width: 180px; display: none;">
        <option value="">Selecione a cidade</option>
        @foreach($cidadesRepresentadas as $cidade)
            <option value="{{ $cidade }}" {{ request('cidade') == $cidade ? 'selected' : '' }}>
                {{ $cidade }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-outline-success">
        <i class="fas fa-building mx-2"></i> Exportar Representadas
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderBySelect = document.getElementById('orderByRepresentadas');
        const cidadeSelect = document.getElementById('cidadeSelectRepresentadas');

        function toggleCidadeSelect() {
            if(orderBySelect.value === 'cidade') {
                cidadeSelect.style.display = 'inline-block';
                cidadeSelect.required = true;
            } else {
                cidadeSelect.style.display = 'none';
                cidadeSelect.required = false;
                cidadeSelect.value = '';
            }
        }

        orderBySelect.addEventListener('change', toggleCidadeSelect);

        // Inicializa na carga da página
        toggleCidadeSelect();
    });
</script>

        </div><div>
        <br><br><hr>
    </div>
</section>

<section class="col-md-12 mt-2 container-fluid" id="divTable">

</section>
<script>
    $("#addNew").click(function(){
        showModal("{{route('representadas.form')}}");
    });

    function tblPopulate(){
        $.ajax({
            url: "{{route('representadas.show')}}",
            method: "GET",
            beforeSend:function(){
                $("#divTable").html("Carregando");
            },
            success:function(response){
                $("#divTable").html(response);
            },
            error: function(){
                $("#divTable").html('Erro ao carregar dados');
            }
        });
    }

    tblPopulate();


</script>
@endsection
