@extends('layouts.modal')

@php
    $title = "Cadastro de Comissões";
    if($comissao != null) {
        $title = "Editando Comissão: #" . $comissao->id;
    }
@endphp
@section('modal_title') {{ $title }} @endsection

@section('modal_content')
<form id="create_edit" method="POST">
    @csrf
    <div class="row">
        <!-- Pedido ID -->
        <div class="col-md-6 form-group mt-2">
            <label for="pedido_id">Pedido ID:</label>
            <input type="number" name="pedido_id" id="pedido_id" class="form-control" value="{{ $comissao != null ? $comissao->pedido_id : '' }}" required>
        </div>
        <!-- Valor -->
        <div class="col-md-6 form-group mt-2">
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" name="valor" id="valor" class="form-control" value="{{ $comissao != null ? $comissao->valor : '' }}" required>
        </div>
        <!-- Porcentagem -->
        <div class="col-md-6 form-group mt-2">
            <label for="porcentagem">Porcentagem:</label>
            <input type="number" step="0.01" name="porcentagem" id="porcentagem" class="form-control" value="{{ $comissao != null ? $comissao->porcentagem : '' }}">
        </div>
        <!-- Data -->
        <div class="col-md-6 form-group mt-2">
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" class="form-control" value="{{ $comissao != null ? $comissao->data : '' }}" required>
        </div>
    </div>
</form>
<script>
@if($comissao != null)
    var url_post = "{{ route('comissoes.update', $comissao->id) }}";
@else
    var url_post = "{{ route('comissoes.store') }}";
@endif

$(document).ready(function() {
    $('#create_edit').on('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); }
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
                }).then(function() {
                    tblPopulate();
                });
                $("#closeModal").trigger('click');
            },
            error: function(xhr) {
                var errorMessage = 'Erro ao registrar comissão';
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
        });
    });
});
</script>
@endsection
