@extends('layouts.modal')

@php
    $title = "Cadastro de Representadas";
    if($representada!= null) {
        $title = 'Editando: '. $representada->id.' - '.$representada->razao_social;
    }
@endphp
@section('modal_title') {{ $title }} @endsection

@section('modal_content')


<section id="div_tipo_pessoa" class="row col-md-12">
    <div class="col-md-4 form-group mb-2">
        <label for="tipo">Tipo</label>
        <select name="tipo_pessoa" id="tipo_pessoa" class="form-control select2" required>
            <option {{ $representada != null ? ($representada->tipo_pessoa==1 ? 'selected' : '') : ''}} value="1" >Pessoa Jurídica</option>
            <option {{ $representada != null ? ($representada->tipo_pessoa==2 ? 'selected' : '') : ''}} value="2">Pessoa Física</option>
        </select>
    </div>
</section>
<!-- EMPRESA -->

<div class="col-md-4 mt-2">
    <label for="cnpj" id="labelCNPJ">CNPJ:</label>
    <input type="text" maxlength="20" name="cpf_cnpj" id="cpf_cnpj" class="form-control" value="{{ $representada != null ? $representada->cpf_cnpj : '' }}" />
</div>

<div class="form-group col-md-8 mt-2">
    <label for="empresa" id="labelNome">Razão Social:</label>
    <input type="text" maxlength="250" name="razao_social" class="form-control" id="razao_social" value="{{ $representada != null ?  $representada->razao_social : '' }}"  />
</div>

<!-- CNPJ -->
<!-- NOME FANTASIA -->
<div class="col-md-8 form-group mt-2">
    <label for="nome_fantasia" id="labelFantasia">Nome Fantasia:</label>
    <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" value="{{ $representada != null ? $representada->nome_fantasia : '' }}">
</div>

<!-- FONE -->
<div class="col-md-4 form-group mt-2">
    <label for="fone">Telefone:</label>
    <input type="tel" name="fone" id="fone" class="form-control" value="{{ $representada != null ? $representada->fone : '' }}" >
</div>


<!-- RESPONSÁVEL -->
<div class="col-md-4 form-group mt-2">
    <label for="email">Responsável:</label>
    <input type="text" name="responsavel" id="responsavel" class="form-control" value="{{ $representada != null ? $representada->responsavel : '' }}" >
</div>


<!-- EMAIL -->
<div class="col-md-4 form-group mt-2">
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ $representada != null ? $representada->email : '' }}" >
</div>

<!-- CELULAR -->
<div class="col-md-4  form-group  mt-2">
    <label for="celular">Celular:</label>
    <input type="tel" name="celular" id="celular" class="form-control" value="{{ $representada != null ? $representada->celular : '' }}" >
</div>




<!-- ENDEREÇO -->
<div class="col-md-12 form-group mt-2 mt-3 ">
    <div class="form-separator"><span>Endereço</span></div>
</div>

<!-- CEP -->
<div class="col-md-3 form-group mt-2">
    <label for="cep">CEP:</label> &nbsp; <span style="color:red" id="CepAguarde"></span>
    <input type="text" name="cep" id="cep" class="form-control" value="{{ $representada != null ? $representada->cep : '' }}"  >
</div>

<!-- RUA -->
<div class="col-md-6 form-group mt-2">
    <label for="rua">Rua:</label>
    <input type="text" name="rua" id="rua" class="form-control" value="{{ $representada != null ? $representada->rua : '' }}" required >
</div>

<!-- NÚMERO -->
<div class="col-md-3 form-group mt-2">
    <label for="numero">Número:</label>
    <input type="text" name="numero" id="numero" class="form-control" value="{{ $representada != null ? $representada->numero : '' }}" required >
</div>

<!-- COMPLEMENTO -->
<div class="col-md-3 form-group mt-2">
    <label for="complemento">Complemento:</label>
    <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $representada != null ? $representada->complemento : '' }}" >
</div>

<!-- BAIRRO -->
<div class="col-md-3 form-group mt-2">
    <label for="bairro">Bairro:</label>
    <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $representada != null ? $representada->bairro : '' }}"  required>
</div>

<!-- CIDADE -->
<div class="col-md-3 form-group mt-2">
    <label for="cidade">Cidade:</label>
    <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $representada != null ? $representada->cidade : '' }}"  required>
</div>

<!-- ESTADO -->
<div class="col-md-3 form-group mt-2">
    <label for="uf">Estado:</label>
    <select class="form-control select2" name="uf" id="uf" placeholder="Selecione" required >
        <option value="">Selecione</option>
        <option value="AC" @if($representada != null && $representada->uf=='AC') selected="selected" @endif>Acre</option>
        <option value="AL" @if($representada != null && $representada->uf=='AL') selected="selected" @endif>Alagoas</option>
        <option value="AP" @if($representada != null && $representada->uf=='AP') selected="selected" @endif>Amapá</option>
        <option value="AM" @if($representada != null && $representada->uf=='AM') selected="selected" @endif>Amazonas</option>
        <option value="BA" @if($representada != null && $representada->uf=='BA') selected="selected" @endif>Bahia</option>
        <option value="CE" @if($representada != null && $representada->uf=='CE') selected="selected" @endif>Ceará</option>
        <option value="DF" @if($representada != null && $representada->uf=='DF') selected="selected" @endif>Distrito Federal</option>
        <option value="ES" @if($representada != null && $representada->uf=='ES') selected="selected" @endif>Espírito Santo</option>
        <option value="GO" @if($representada != null && $representada->uf=='GO') selected="selected" @endif>Goiás</option>
        <option value="MA" @if($representada != null && $representada->uf=='MA') selected="selected" @endif>Maranhão</option>
        <option value="MT" @if($representada != null && $representada->uf=='MT') selected="selected" @endif>Mato Grosso</option>
        <option value="MS" @if($representada != null && $representada->uf=='MS') selected="selected" @endif>Mato Grosso do Sul</option>
        <option value="MG" @if($representada != null && $representada->uf=='MG') selected="selected" @endif>Minas Gerais</option>
        <option value="PA" @if($representada != null && $representada->uf=='PA') selected="selected" @endif>Pará</option>
        <option value="PB" @if($representada != null && $representada->uf=='PB') selected="selected" @endif>Paraíba</option>
        <option value="PR" @if($representada != null && $representada->uf=='PR') selected="selected" @endif>Paraná</option>
        <option value="PE" @if($representada != null && $representada->uf=='PE') selected="selected" @endif>Pernambuco</option>
        <option value="PI" @if($representada != null && $representada->uf=='PI') selected="selected" @endif>Piauí</option>
        <option value="RJ" @if($representada != null && $representada->uf=='RJ') selected="selected" @endif>Rio de Janeiro</option>
        <option value="RN" @if($representada != null && $representada->uf=='RN') selected="selected" @endif>Rio Grande do Norte</option>
        <option value="RS" @if($representada != null && $representada->uf=='RS') selected="selected" @endif>Rio Grande do Sul</option>
        <option value="RO" @if($representada != null && $representada->uf=='RO') selected="selected" @endif>Rondônia</option>
        <option value="RR" @if($representada != null && $representada->uf=='RR') selected="selected" @endif>Roraima</option>
        <option value="SC" @if($representada != null && $representada->uf=='SC') selected="selected" @endif>Santa Catarina</option>
        <option value="SP" @if($representada != null && $representada->uf=='SP') selected="selected" @endif>São Paulo</option>
        <option value="SE" @if($representada != null && $representada->uf=='SE') selected="selected" @endif>Sergipe</option>
        <option value="TO" @if($representada != null && $representada->uf=='TO') selected="selected" @endif>Tocantins</option>
    </select>
</div>


<script>
$('#create_edit').on('keydown', function (e) {
    if (e.key === 'Enter') {
        // Impede o comportamento padrão da tecla Enter
        e.preventDefault();
    }
});


@if($representada!=null)
    var url_post = "{{route('representadaes.update',$representada->id)}}";
    var tipo = $("#tipo_pessoa").val();
    showTipo(tipo);
@else
    var url_post = "{{route('representadaes.store')}}";
@endif


$("#tipo_pessoa").change(function(){
    var tipo = $(this).val();
    showTipo(tipo);
});


function showTipo(tipo){
    if(tipo==1){
        $("#labelCNPJ").html("CNPJ:");
        $("#labelNome").html("Razão Social:");
        $("#labelFantasia").html("Nome Fantasia:");
        $("#cpf_cnpj").mask('00.000.000/0000-00');
    }else if(tipo==2){
        $("#labelCNPJ").html("CPF:");
        $("#labelNome").html("Nome:");
        $("#labelFantasia").html("Sobrenome:");
        $("#cpf_cnpj").mask('000.000.000-00');
    }
}

$(document).ready(function() {
    // Captura o envio do formulário ou outro evento desejado
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
                    tblPopulate()
                });
                $("#closeModal").trigger('click');
            },
            error: function(xhr) {
                var errorMessage = 'Erro ao registrar representada';
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


    $("#fone").mask('(00) 0000-0000');
    $("#celular").mask('(00) 00000-0000');
    $("#cep").mask('00.000-000');

    //VALIDA CNPJ
    $("#cpf_cnpj").blur(function(){

        var tipo = $("#tipo_pessoa").val();
        var cpf_cnpj = $("#cpf_cnpj").val();
        cpf_cnpj = cpf_cnpj.replace(/[^0-9]/g,'');
        if(tipo==1){
            if(TestaCNPJ(cpf_cnpj) == false){
                swal.fire("Atenção", "CNPJ inválido", "warning");
                $("#cpf_cnpj").val('');
            }
        }else{
            if(TestaCPF(cpf_cnpj) == false){
                swal.fire("Atenção", "CPF inválido", "warning");
                $("#cpf_cnpj").val('');
            }
        }

    });

    //-------------------------------------

    //CEP
    $("#cep").change(function(){
        var cep = $("#cep").val();
        cep = cep.replace(/[^0-9]/g,'');
        var url = "https://viacep.com.br/ws/"+cep+"/json/";
        $("#CepAguarde").html("Carregando...");
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(data){
                $("#CepAguarde").html("");
                $("#rua").val(data.logradouro)
                $("#bairro").val(data.bairro)
                $("#cidade").val(data.localidade)

                selecionar(data.uf)
            }
        });
    });

    // SELECIONAR O ESTADO E ALTERAR O SELECT2
    function selecionar(uf){
        $('#uf option').each(function(e) {
            // se localizar a frase, define o atributo selected
            if($(this).attr('value') == uf) {
                $(this).prop('selected', true);
                $("#select2-uf-container").html($(this).text())

            }
        });
    }

});
</script>
@endsection
