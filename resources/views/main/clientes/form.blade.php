@extends('layouts.modal')

@php
    $title = "Cadastro de Clientes";
    if ($cliente != null) {
        $title = "Editando: " . $cliente->id . " - " . $cliente->nome;
    }
@endphp

@section('modal_title') {{ $title }} @endsection

@section('modal_content')
<form id="create_edit" method="POST">
    @csrf
    <div class="row">
        <!-- Nome -->
        <div class="col-md-6 form-group mt-2">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $cliente != null ? $cliente->nome : '' }}" required>
        </div>
        <!-- Sobrenome -->
        <div class="col-md-6 form-group mt-2">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" name="sobrenome" id="sobrenome" class="form-control" value="{{ $cliente != null ? $cliente->sobrenome : '' }}" required>
        </div>
        <!-- CPF -->
        <div class="col-md-6 form-group mt-2">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="form-control" value="{{ $cliente != null ? $cliente->cpf : '' }}" required>
        </div>
        <!-- E-mail -->
        <div class="col-md-6 form-group mt-2">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $cliente != null ? $cliente->email : '' }}" required>
        </div>
        <!-- Telefone -->
        <div class="col-md-6 form-group mt-2">
            <label for="telefone">Telefone:</label>
            <input type="tel" name="telefone" id="telefone" class="form-control" value="{{ $cliente != null ? $cliente->telefone : '' }}">
        </div>
        <!-- Celular -->
        <div class="col-md-6 form-group mt-2">
            <label for="celular">Celular:</label>
            <input type="tel" name="celular" id="celular" class="form-control" value="{{ $cliente != null ? $cliente->celular : '' }}">
        </div>
        <!-- CEP -->
        <div class="col-md-4 form-group mt-2">
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" class="form-control" value="{{ $cliente != null ? $cliente->cep : '' }}">
        </div>
        <!-- Rua -->
        <div class="col-md-8 form-group mt-2">
            <label for="rua">Rua:</label>
            <input type="text" name="rua" id="rua" class="form-control" value="{{ $cliente != null ? $cliente->rua : '' }}">
        </div>
        <!-- Número -->
        <div class="col-md-4 form-group mt-2">
            <label for="numero">Número:</label>
            <input type="text" name="numero" id="numero" class="form-control" value="{{ $cliente != null ? $cliente->numero : '' }}">
        </div>
        <!-- Complemento -->
        <div class="col-md-4 form-group mt-2">
            <label for="complemento">Complemento:</label>
            <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $cliente != null ? $cliente->complemento : '' }}">
        </div>
        <!-- Bairro -->
        <div class="col-md-4 form-group mt-2">
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $cliente != null ? $cliente->bairro : '' }}">
        </div>
        <!-- Cidade -->
        <div class="col-md-4 form-group mt-2">
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $cliente != null ? $cliente->cidade : '' }}">
        </div>
        <!-- UF -->
        <div class="col-md-4 form-group mt-2">
            <label for="uf">Estado (UF):</label>
            <select name="uf" id="uf" class="form-control" required>
                <option value="">Selecione</option>
                <option value="AC" @if($cliente != null && $cliente->uf=='AC') selected @endif>Acre</option>
                <option value="AL" @if($cliente != null && $cliente->uf=='AL') selected @endif>Alagoas</option>
                <option value="AP" @if($cliente != null && $cliente->uf=='AP') selected @endif>Amapá</option>
                <option value="AM" @if($cliente != null && $cliente->uf=='AM') selected @endif>Amazonas</option>
                <option value="BA" @if($cliente != null && $cliente->uf=='BA') selected @endif>Bahia</option>
                <option value="CE" @if($cliente != null && $cliente->uf=='CE') selected @endif>Ceará</option>
                <option value="DF" @if($cliente != null && $cliente->uf=='DF') selected @endif>Distrito Federal</option>
                <option value="ES" @if($cliente != null && $cliente->uf=='ES') selected @endif>Espírito Santo</option>
                <option value="GO" @if($cliente != null && $cliente->uf=='GO') selected @endif>Goiás</option>
                <option value="MA" @if($cliente != null && $cliente->uf=='MA') selected @endif>Maranhão</option>
                <option value="MT" @if($cliente != null && $cliente->uf=='MT') selected @endif>Mato Grosso</option>
                <option value="MS" @if($cliente != null && $cliente->uf=='MS') selected @endif>Mato Grosso do Sul</option>
                <option value="MG" @if($cliente != null && $cliente->uf=='MG') selected @endif>Minas Gerais</option>
                <option value="PA" @if($cliente != null && $cliente->uf=='PA') selected @endif>Pará</option>
                <option value="PB" @if($cliente != null && $cliente->uf=='PB') selected @endif>Paraíba</option>
                <option value="PR" @if($cliente != null && $cliente->uf=='PR') selected @endif>Paraná</option>
                <option value="PE" @if($cliente != null && $cliente->uf=='PE') selected @endif>Pernambuco</option>
                <option value="PI" @if($cliente != null && $cliente->uf=='PI') selected @endif>Piauí</option>
                <option value="RJ" @if($cliente != null && $cliente->uf=='RJ') selected @endif>Rio de Janeiro</option>
                <option value="RN" @if($cliente != null && $cliente->uf=='RN') selected @endif>Rio Grande do Norte</option>
                <option value="RS" @if($cliente != null && $cliente->uf=='RS') selected @endif>Rio Grande do Sul</option>
                <option value="RO" @if($cliente != null && $cliente->uf=='RO') selected @endif>Rondônia</option>
                <option value="RR" @if($cliente != null && $cliente->uf=='RR') selected @endif>Roraima</option>
                <option value="SC" @if($cliente != null && $cliente->uf=='SC') selected @endif>Santa Catarina</option>
                <option value="SP" @if($cliente != null && $cliente->uf=='SP') selected @endif>São Paulo</option>
                <option value="SE" @if($cliente != null && $cliente->uf=='SE') selected @endif>Sergipe</option>
                <option value="TO" @if($cliente != null && $cliente->uf=='TO') selected @endif>Tocantins</option>
            </select>
        </div>
    </div>
</form>

<script>
@if($cliente != null)
    var url_post = "{{ route('clientes.update', $cliente->id) }}";
@else
    var url_post = "{{ route('clientes.store') }}";
@endif

$(document).ready(function() {
    // Impede o envio do formulário via Enter
    $('#create_edit').on('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });

    // Submissão do formulário via AJAX
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
                var errorMessage = 'Erro ao registrar cliente';
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

    // Aplicando máscaras aos campos
    $("#cpf").mask('000.000.000-00');
    $("#telefone").mask('(00) 0000-0000');
    $("#celular").mask('(00) 00000-0000');
    $("#cep").mask('00.000-000');

    // Validação simples para CPF (pode ser aprimorada)
    $("#cpf").blur(function(){
        var cpf = $(this).val().replace(/[^0-9]/g, '');
        if(cpf.length != 11){
            Swal.fire('Atenção', 'CPF inválido', 'warning');
            $(this).val('');
        }
    });
});
</script>
@endsection
