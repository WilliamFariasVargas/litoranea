@extends('layouts.modal')

@php
    $title = "Cadastro de Pedido";
@endphp

@section('modal_title')
    {{ $title }}
@endsection

@section('modal_content')

<form id="create_edit" method="POST">
    @csrf

    <div class="row">
        {{-- Data Pedido --}}
        <div class="col-md-4 form-group mb-2">
            <label>Data do Pedido:</label>
            <input type="date" name="data_pedido" class="form-control" required>
        </div>

        {{-- Cliente --}}
        <div class="col-md-8 form-group mb-2">
            <label>Cliente:</label>
            <select name="cliente_id" id="cliente_id" class="form-control select2" required>
                <option value="">Selecione</option>
            </select>
        </div>

        {{-- Representada --}}
        <div class="col-md-6 form-group mb-2">
            <label>Representada:</label>
            <select name="representada_id" id="representada_id" class="form-control select2" required>
                <option value="">Selecione</option>
            </select>
        </div>

        {{-- Transportadora --}}
        <div class="col-md-6 form-group mb-2">
            <label>Transportadora:</label>
            <select name="transportadora_id" id="transportadora_id" class="form-control select2">
                <option value="">Selecione</option>
            </select>
        </div>

        {{-- Valores --}}
        <div class="col-md-4 form-group mb-2">
            <label>Valor do Pedido:</label>
            <input type="text" name="valor_pedido" id="valor_pedido" class="form-control money" required>
        </div>

        <div class="col-md-4 form-group mb-2">
            <label>Valor Faturado:</label>
            <input type="text" name="valor_faturado" id="valor_faturado" class="form-control money">
        </div>

        <div class="col-md-4 form-group mb-2">
            <label>Data do Faturamento:</label>
            <input type="date" name="data_faturamento" class="form-control">
        </div>

        <div class="col-md-6 form-group mb-2">
            <label>Valor Comissão Parcial:</label>
            <input type="text" name="valor_comissao_parcial" id="valor_comissao_parcial" class="form-control money">
        </div>

        <div class="col-md-6 form-group mb-2">
            <label>Valor Comissão Faturada:</label>
            <input type="text" name="valor_comissao_faturada" id="valor_comissao_faturada" class="form-control money">
        </div>
    </div>

</form>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    var url_post = "{{ route('cadastrodepedido.store') }}";

    // Máscaras de dinheiro
    $('.money').mask('000.000.000,00', {reverse: true});

    // Select2 Cliente
    $('#cliente_id').select2({
        placeholder: 'Selecione um cliente',
        allowClear: true,
        ajax: {
            url: "{{ route('clientes.search') }}",
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: data => ({
                results: data.map(item => ({ id: item.id, text: item.razao_social }))
            }),
            cache: true
        }
    });

    // Select2 Representada
    $('#representada_id').select2({
        placeholder: 'Selecione uma representada',
        allowClear: true,
        ajax: {
            url: "{{ route('representadas.search') }}",
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: data => ({
                results: data.map(item => ({ id: item.id, text: item.nome }))
            }),
            cache: true
        }
    });

    // Select2 Transportadora
    $('#transportadora_id').select2({
        placeholder: 'Selecione uma transportadora',
        allowClear: true,
        ajax: {
            url: "{{ route('transportadoras.search') }}",
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: data => ({
                results: data.map(item => ({ id: item.id, text: item.nome }))
            }),
            cache: true
        }
    });

    // Formulário AJAX
    $('#create_edit').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: url_post,
            method: 'POST',
            data: formData,
            success: function(data) {
                Swal.fire('Sucesso!', data.message, 'success').then(() => {
                    tblPopulate(); // Atualiza tabela
                    $("#closeModal").click(); // Fecha modal
                });
            },
            error: function(xhr) {
                Swal.fire('Erro!', xhr.responseJSON.message || 'Erro ao salvar', 'error');
            }
        });
    });
});
</script>
@endsection
