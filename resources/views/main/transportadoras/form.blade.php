@extends('layouts.modal')

@php
    $title = "Cadastro de Transportadoras";
    if ($transportadora != null) { $title = "Editando: " . $transportadora->nome; }
@endphp

@section('modal_title') {{ $title }} @endsection

@section('modal_content')
<form id="create_edit" method="POST">
    @csrf
    <div class="row">
        <!-- Nome -->
        <div class="col-md-6 form-group mt-2">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $transportadora != null ? $transportadora->nome : '' }}" required>
        </div>
        <!-- CNPJ -->
        <div class="col-md-6 form-group mt-2">
            <label for="cnpj">CNPJ:</label>
            <input type="text" name="cnpj" id="cnpj" class="form-control" value="{{ $transportadora != null ? $transportadora->cnpj : '' }}" required>
        </div>
        <!-- E-mail -->
        <div class="col-md-6 form-group mt-2">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $transportadora != null ? $transportadora->email : '' }}" required>
        </div>
        <!-- Telefone -->
        <div class="col-md-6 form-group mt-2">
            <label for="telefone">Telefone:</label>
            <input type="tel" name="telefone" id="telefone" class="form-control" value="{{ $transportadora != null ? $transportadora->telefone : '' }}">
        </div>
        <!-- CEP -->
        <div class="col-md-4 form-group mt-2">
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" class="form-control" value="{{ $transportadora != null ? $transportadora->cep : '' }}">
        </div>
        <!-- Rua -->
        <div class="col-md-8 form-group mt-2">
            <label for="rua">Rua:</label>
            <input type="text" name="rua" id="rua" class="form-control" value="{{ $transportadora != null ? $transportadora->rua : '' }}">
        </div>
        <!-- Número -->
        <div class="col-md-4 form-group mt-2">
            <label for="numero">Número:</label>
            <input type="text" name="numero" id="numero" class="form-control" value="{{ $transportadora != null ? $transportadora->numero : '' }}">
        </div>
        <!-- Complemento -->
        <div class="col-md-4 form-group mt-2">
            <label for="complemento">Complemento:</label>
            <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $transportadora != null ? $transportadora->complemento : '' }}">
        </div>
        <!-- Bairro -->
        <div class="col-md-4 form-group mt-2">
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $transportadora != null ? $transportadora->bairro : '' }}">
        </div>
        <!-- Cidade -->
        <div class="col-md-4 form-group mt-2">
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $transportadora != null ? $transportadora->cidade : '' }}">
        </div>
        <!-- UF -->
        <div class="col-md-4 form-group mt-2">
            <label for="uf">Estado (UF):</label>
            <select name="uf" id="uf" class="form-control" required>
                <option value="">Selecione</option>
                <option value="AC" @if($transportadora != null && $transportadora->uf=='AC') selected @endif>Acre</option>
                <option value="AL" @if($transportadora != null && $transportadora->uf=='AL') selected @endif>Alagoas</option>
                <option value="AP" @if($transportadora != null && $transportadora->uf=='AP') selected @endif>Amapá</option>
                <option value="AM" @if($transportadora != null && $transportadora->uf=='AM') selected @endif>Amazonas</option>
                <option value="BA" @if($transportadora != null && $transportadora->uf=='BA') selected @endif>Bahia</option>
                <option value="CE" @if($transportadora != null && $transportadora->uf=='CE') selected @endif>Ceará</option>
                <option value="DF" @if($transportadora != null && $transportadora->uf=='DF') selected @endif>Distrito Federal</option>
                <option value="ES" @if($transportadora != null && $transportadora->uf=='ES') selected @endif>Espírito Santo</option>
                <option value="GO" @if($transportadora != null && $transportadora->uf=='GO') selected @endif>Goiás</option>
                <option value="MA" @if($transportadora != null && $transportadora->uf=='MA') selected @endif>Maranhão</option>
                <option value="MT" @if($transportadora != null && $transportadora->uf=='MT') selected @endif>Mato Grosso</option>
                <option value="MS" @if($transportadora != null && $transportadora->uf=='MS') selected @endif>Mato Grosso do Sul</option>
                <option value="MG" @if($transportadora != null && $transportadora->uf=='MG') selected @endif>Minas Gerais</option>
                <option value="PA" @if($transportadora != null && $transportadora->uf=='PA') selected @endif>Pará</option>
                <option value="PB" @if($transportadora != null && $transportadora->uf=='PB') selected @endif>Paraíba</option>
                <option value="PR" @if($transportadora != null && $transportadora->uf=='PR') selected @endif>Paraná</option>
                <option value="PE" @if($transportadora != null && $transportadora->uf=='PE') selected @endif>Pernambuco</option>
                <option value="PI" @if($transportadora != null && $transportadora->uf=='PI') selected @endif>Piauí</option>
                <option value="RJ" @if($transportadora != null && $transportadora->uf=='RJ') selected @endif>Rio de Janeiro</option>
                <option value="RN" @if($transportadora != null && $transportadora->uf=='RN') selected @endif>Rio Grande do Norte</option>
                <option value="RS" @if($transportadora != null && $transportadora->uf=='RS') selected @endif>Rio Grande do Sul</option>
                <option value="RO" @if($transportadora != null && $transportadora->uf=='RO') selected @endif>Rondônia</option>
                <option value="RR" @if($transportadora != null && $transportadora->uf=='RR') selected @endif>Roraima</option>
                <option value="SC" @if($transportadora != null && $transportadora->uf=='SC') selected @endif>Santa Catarina</option>
                <option value="SP" @if($transportadora != null && $transportadora->uf=='SP') selected @endif>São Paulo</option>
                <option value="SE" @if($transportadora != null && $transportadora->uf=='SE') selected @endif>Sergipe</option>
                <option value="TO" @if($transportadora != null && $transportadora->uf=='TO') selected @endif>Tocantins</option>
            </select>
        </div>
    </div>
</form>
<script>
@if($transportadora != null)
    var url_post = "{{ route('transportadoras.update', $transportadora->id) }}";
@else
    var url_post = "{{ route('transportadoras.store') }}";
@endif
$(document).ready(function() {
    $('#create_edit').on('keydown', function (e) { if (e.key === 'Enter') { e.preventDefault(); } });
    $('#create_edit').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: url_post, type: 'POST', data: formData,
            success: function(data) {
                Swal.fire({ title: 'Sucesso!', text: data.message, icon: 'success', confirmButtonText: 'OK' })
                .then(function(){ tblPopulate(); });
                $("#closeModal").trigger('click');
            },
            error: function(xhr) {
                var errorMessage = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Erro ao registrar transportadora';
                Swal.fire({ title: 'Erro!', text: errorMessage, icon: 'error', confirmButtonText: 'OK' });
            }
        });
    });
    $("#cnpj").mask('00.000.000/0000-00');
    $("#telefone").mask('(00) 0000-0000');
    $("#cep").mask('00.000-000');
});
</script>
@endsection
