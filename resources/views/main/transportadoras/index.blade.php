@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-6">
            <h4 style="color:#003162;" class="title mt-2"><i class="fa fa-truck mx-2"></i>Cadastro de Transportadoras</h4>
        </div>
        <div class="col-6 text-end">
            @php
    $cidadesTransportadoras = \App\Models\Transportadora::select('cidade')->distinct()->orderBy('cidade')->pluck('cidade');
@endphp

<form action="{{ route('exportar.transportadoras') }}" method="GET" class="d-inline-flex align-items-center gap-2" id="formExportTransportadoras">
    <select name="orderBy" id="orderByTransportadoras" class="form-select form-select-sm" style="width: 150px;">
        <option value="razao_social" {{ request('orderBy') == 'razao_social' ? 'selected' : '' }}>Nome</option>
        <option value="cidade" {{ request('orderBy') == 'cidade' ? 'selected' : '' }}>Cidade</option>
        <option value="id" {{ request('orderBy') == 'id' ? 'selected' : '' }}>ID</option>
    </select>

    <select name="cidade" id="cidadeSelectTransportadoras" class="form-select form-select-sm" style="width: 180px; display: none;">
        <option value="">Selecione a cidade</option>
        @foreach($cidadesTransportadoras as $cidade)
            <option value="{{ $cidade }}" {{ request('cidade') == $cidade ? 'selected' : '' }}>
                {{ $cidade }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-outline-warning">
        <i class="fas fa-truck mx-2"></i> Exportar Transportadoras
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderBySelect = document.getElementById('orderByTransportadoras');
        const cidadeSelect = document.getElementById('cidadeSelectTransportadoras');

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
</div>
        <br><br><hr>
    </div>
</section>


<section class="col-md-12 mt-2 container-fluid" id="divTable">

</section>
<script>
    $("#addNew").click(function(){
        showModal("{{route('transportadoras.form')}}");
    });

    function tblPopulate(){
        $.ajax({
            url: "{{route('transportadoras.show')}}",
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
