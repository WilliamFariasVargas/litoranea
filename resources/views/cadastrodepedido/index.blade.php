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
    <div class="col-md-3">
        <label>Status:</label>
        <select name="status" class="form-control select2">
            <option value="">Todos</option>
            <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
            <option value="baixado" {{ request('status') == 'baixado' ? 'selected' : '' }}>Baixado</option>
        </select>
    </div>

    <div class="col-md-3">
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

    <div class="col-md-3">
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

    <div class="col-md-3">
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
        <input type="date" name="data_inicial" class="form-control" value="{{ request('data_inicial') }}">
    </div>

    <div class="col-md-3">
        <label>Data Final:</label>
        <input type="date" name="data_final" class="form-control" value="{{ request('data_final') }}">
    </div>

    <div class="col-md-3">
        <label>Mês:</label>
        <input type="number" name="mes" min="1" max="12" value="{{ request('mes') }}" class="form-control">
    </div>

    <div class="col-md-3">
        <label>Ano:</label>
        <input type="number" name="ano" value="{{ request('ano') }}" class="form-control">
    </div>

    {{-- Inputs escondidos para ordenação --}}
    <input type="hidden" name="order" id="order" value="{{ request('order', 'data_pedido') }}">
    <input type="hidden" name="dir" id="dir" value="{{ request('dir', 'desc') }}">

    <div class="col-md-12 d-flex align-items-end gap-2 mt-2">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <button type="button" class="btn btn-secondary" onclick="limparFiltros()">Limpar Filtros</button>
        <button type="button" class="btn btn-outline-secondary btn-order" data-order="data_pedido" data-dir="desc">
            Data Pedido
            <i class="fas fa-sort{{ request('order') === 'data_pedido' ? (request('dir') === 'asc' ? '-up' : '-down') : '' }}"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary btn-order" data-order="cliente_id" data-dir="desc">
            Cliente
            <i class="fas fa-sort{{ request('order') === 'cliente_id' ? (request('dir') === 'asc' ? '-up' : '-down') : '' }}"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary btn-order" data-order="valor_faturado" data-dir="desc">
            Valor Faturado
            <i class="fas fa-sort{{ request('order') === 'valor_faturado' ? (request('dir') === 'asc' ? '-up' : '-down') : '' }}"></i>
        </button>

        <a id="btnExportExcel" href="#" class="btn btn-success ms-auto">
            <i class="fas fa-file-excel mx-2"></i> Exportar Excel
        </a>
        <a id="btnExportPdf" href="#" class="btn btn-danger">
            <i class="fas fa-file-pdf mx-2"></i> Exportar PDF
        </a>
    </div>
</form>

<section class="col-md-12 mt-2 container-fluid" id="divTable">
    {{-- Tabela será carregada aqui via AJAX --}}
</section>

<script>
    $(document).ready(function() {
        // Inicializa Select2
        $('.select2').select2({
            placeholder: 'Selecione',
            allowClear: true,
            width: '100%'
        });

        // Evento de clique nos botões de ordenação
        $('.btn-order').on('click', function() {
            const orderBy = $(this).data('order');
            let newDir = $(this).data('dir');

            if ($('#order').val() === orderBy) {
                newDir = $('#dir').val() === 'asc' ? 'desc' : 'asc';
            }

            $('#order').val(orderBy);
            $('#dir').val(newDir);

            $('#filter_form').submit();
        });

        // Botão novo pedido
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

        // Submit do filtro com AJAX
        $('#filter_form').submit(function(e) {
            e.preventDefault();
            let queryString = $(this).serialize();
            window.history.pushState({}, '', '?' + queryString);
            tblPopulate();
            atualizarLinksExportacao();
        });

        // Primeira carga
        tblPopulate();
        atualizarLinksExportacao();
    });

    // Funções globais para serem usadas na tabela
    function tblPopulate() {
        let queryString = window.location.search;
        $.ajax({
            url: "{{ route('cadastrodepedido.tabela') }}" + queryString,
            method: "GET",
            beforeSend: function() {
                $("#divTable").html("<div class='text-center p-5'><i class='fas fa-spinner fa-spin fa-2x'></i><br>Carregando...</div>");
            },
            success: function(response) {
                $("#divTable").html(response);
            },
            error: function() {
                $("#divTable").html('<div class="alert alert-danger">Erro ao carregar dados</div>');
            }
        });
    }

    function atualizarLinksExportacao() {
        let query = window.location.search;
        $('#btnExportExcel').attr('href', "{{ url('cadastrodepedido/export-excel') }}" + query);
        $('#btnExportPdf').attr('href', "{{ url('cadastrodepedido/export-pdf') }}" + query);
    }

    function limparFiltros() {
        window.location.href = "{{ route('cadastrodepedido.index') }}";
    }

    function showModal(content) {
        if ($('#modalMain').length === 0) {
            $('body').append(`
                <div class="modal fade" id="modalMain" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"></div>
                    </div>
                </div>
            `);
        }
        $('#modalMain .modal-content').html(content);
        $('#modalMain').modal('show');
    }
</script>
@endsection
