@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-8" style="vertical-align: middle">
            <h4 style="color:#003162;" class="title mt-2">
                <i class="fa fa-list-alt mx-2"></i> Cadastro de Pedidos
            </h4>
        </div>



        <div class="col-4 text-end">
            <button type="button" style="background-color:#003162;" class="btn btn-primary" id="novoPedidoBtn">
                <i class="fa fa-plus mx-2"></i> Novo
            </button>
        </div>

        <br><br><hr>
    </div>
</section>




<form method="GET" action="{{ route('cadastrodepedido.index') }}" id="filter_form" class="row g-3 mb-4">
    <div class="col-md-4">
        <label>Cliente:</label>
        <select name="cliente_id" class="form-control select2">
            <option value="">Selecione</option>
            @foreach(\App\Models\Cliente::all() as $cliente)
                <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->razao_social }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label>Representada:</label>
        <select name="representada_id" class="form-control select2">
            <option value="">Selecione</option>
            @foreach(\App\Models\Representada::all() as $rep)
                <option value="{{ $rep->id }}" {{ request('representada_id') == $rep->id ? 'selected' : '' }}>
                    {{ $rep->razao_social }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label>Transportadora:</label>
        <select name="transportadora_id" class="form-control select2">
            <option value="">Selecione</option>
            @foreach(\App\Models\Transportadora::all() as $trans)
                <option value="{{ $trans->id }}" {{ request('transportadora_id') == $trans->id ? 'selected' : '' }}>
                    {{ $trans->razao_social }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label>Data Inicial:</label>
        <input type="date" name="data_inicial" class="form-control" value="{{ request('data_inicial') }}" class="form-control">
    </div>

    <div class="col-md-3">
        <label>Data Final:</label>
        <input type="date" name="data_final" class="form-control" value="{{ request('data_final') }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label>Mês:</label>
        <input type="number" name="mes" min="1" max="12" value="{{ request('mes') }}" class="form-control">
    </div>

    <div class="col-md-3">
        <label>Ano:</label>
        <input type="number" name="ano" value="{{ request('ano') }}" class="form-control">
    </div>

    <div class="col-md-4 d-flex">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
    <div class="col-md-8 text-end">
        <a id="btnExportExcel" href="#" class="btn btn-success">
            <i class="fas fa-file-excel mx-2"></i> Exportar Excel
        </a>

        <a id="btnExportPdf" href="#" class="btn btn-danger">
            <i class="fas fa-file-pdf mx-2"></i> Exportar PDF
        </a>
    </div>
</form>

{{-- Botões de Exportação --}}



{{-- Área para carregar a tabela --}}
<section class="col-md-12 mt-2 container-fluid" id="divTable">
    {{-- A tabela vai ser carregada via AJAX aqui --}}
</section>

<script>
    $(document).ready(function() {
        // Inicializa os selects
        $('.select2').select2({
            placeholder: 'Selecione',
            allowClear: true,
            width: '100%'
        });

        // Botão Novo Pedido - abre modal
        $('#novoPedidoBtn').click(function() {
            $.ajax({
                url: "{{ route('cadastrodepedido.create') }}",
                method: 'GET',
                success: function(data) {
                    showModal(data);
                },
                error: function() {
                    Swal.fire('Erro!', 'Não foi possível abrir o formulário.', 'error');
                }
            });
        });

        // Envio do filtro
        $('#filter_form').submit(function(e) {
            e.preventDefault(); // Evita reload

            const queryString = $(this).serialize();

            // Atualiza a URL no navegador
            window.history.pushState({}, '', '?' + queryString);

            // Atualiza tabela e links
            tblPopulate();
            atualizarLinksExportacao();
        });

        // Primeira carga
        tblPopulate();
        atualizarLinksExportacao();
    });

    function tblPopulate() {
        let queryString = window.location.search;

        $.ajax({
            url: "{{ route('cadastrodepedido.tabela') }}" + queryString,
            method: "GET",
            beforeSend: function() {
                $("#divTable").html("Carregando...");
            },
            success: function(response) {
                $("#divTable").html(response);
            },
            error: function() {
                $("#divTable").html('Erro ao carregar dados');
            }
        });
    }

    function atualizarLinksExportacao() {
        let query = window.location.search;
        $('#btnExportExcel').attr('href', "{{ url('cadastrodepedido/export-excel') }}" + query);
        $('#btnExportPdf').attr('href', "{{ url('cadastrodepedido/export-pdf') }}" + query);
    }

    function showModal(content) {
        if ($('#modalMain').length === 0) {
            $('body').append(`
                <div class="modal fade" id="modalMain" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        </div>
                    </div>
                </div>
            `);
        }

        $('#modalMain .modal-content').html(content);
        $('#modalMain').modal('show');
    }
    </script>

@endsection
