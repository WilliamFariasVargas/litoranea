@extends('layouts.modal')

@php
    $title = "Cadastro de Pedidos";
    if($pedido != null) {
        $title = "Editando Pedido: #" . $pedido->id;
    }
@endphp
@section('modal_title') {{ $title }} @endsection

@section('modal_content')
<form id="create_edit" method="POST">
    @csrf
    <div class="row">
        <!-- Cliente ID -->
        <div class="col-md-6 form-group mt-2">
            <label for="cliente_id">Cliente ID:</label>
            <input type="number" name="cliente_id" id="cliente_id" class="form-control" value="{{ $pedido != null ? $pedido->cliente_id : '' }}" required>
        </div>
        <!-- Data do Pedido -->
        <div class="col-md-6 form-group mt-2">
            <label for="data_pedido">Data do Pedido:</label>
            <input type="date" name="data_pedido" id="data_pedido" class="form-control" value="{{ $pedido != null ? $pedido->data_pedido : '' }}" required>
        </div>
        <!-- Status -->
        <div class="col-md-6 form-group mt-2">
            <label for="status">Status:</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $pedido != null ? $pedido->status : '' }}" required>
        </div>
        <!-- Valor Total -->
        <div class="col-md-6 form-group mt-2">
            <label for="valor_total">Valor Total:</label>
            <input type="number" step="0.01" name="valor_total" id="valor_total" class="form-control" value="{{ $pedido != null ? $pedido->valor_total : '' }}" required>
        </div>
    </div>
</form>
<script>
@if($pedido != null)
    var url_post = "{{ route('pedidos.update', $pedido->id) }}";
@else
    var url_post = "{{ route('pedidos.store') }}";
@endif

$(document).ready(function() {
    $('#create_edit').on('keydown', function(e) {
        if(e.key === 'Enter') { e.preventDefault(); }
    });
    $('#create_edit').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: url_post,
            type: 'POST',
            data: formData,
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
                var errorMessage = 'Erro ao registrar pedido';
                if(xhr.responseJSON && xhr.responseJSON.message) {
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
    });
});
</script>
@endsection
