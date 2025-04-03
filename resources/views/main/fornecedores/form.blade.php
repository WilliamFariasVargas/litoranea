@extends('layouts.modal')

@php
    $title  = "Cadastro de Fornecedores" ;
    if($fornecedor!= null) $title = 'Editando: '. $fornecedor->id.' - '.$fornecedor->razao_social;

@endphp
@section('modal_title') {{ $title }}@endsection

@section('modal_content')


<section id="div_tipo_pessoa" class="row col-md-12">
    <div class="col-md-4 form-group mb-2">
        <label for="tipo">Tipo</label>
        <select name="tipo_pessoa" id="tipo_pessoa" class="form-control select2" required>
            <option {{ $fornecedor != null ? ($fornecedor->tipo_pessoa==1 ? 'selected' : '') : ''}} value="1" >Pessoa Jurídica</option>
            <option {{ $fornecedor != null ? ($fornecedor->tipo_pessoa==2 ? 'selected' : '') : ''}} value="2">Pessoa Física</option>
        </select>
    </div>
</section>
<!-- EMPRESA -->

<div class="col-md-4 mt-2">
    <label for="cnpj" id="labelCNPJ">CNPJ:</label>
    <input type="text" maxlength="20" name="cpf_cnpj" id="cpf_cnpj" class="form-control" value="{{ $fornecedor != null ? $fornecedor->cpf_cnpj : '' }}" />
</div>

<div class="form-group col-md-8 mt-2">
    <label for="empresa" id="labelNome">Razão Social:</label>
    <input type="text" maxlength="250" name="razao_social" class="form-control" id="razao_social" value="{{ $fornecedor != null ?  $fornecedor->razao_social : '' }}"  />
</div>

<!-- CNPJ -->
<!-- NOME FANTASIA -->
<div class="col-md-8 form-group mt-2">
    <label for="nome_fantasia" id="labelFantasia">Nome Fantasia:</label>
    <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" value="{{ $fornecedor != null ? $fornecedor->nome_fantasia : '' }}">
</div>

<!-- FONE -->
<div class="col-md-4 form-group mt-2">
    <label for="fone">Telefone:</label>
    <input type="tel" name="fone" id="fone" class="form-control" value="{{ $fornecedor != null ? $fornecedor->fone : '' }}" >
</div>


<!-- RESPONSÁVEL -->
<div class="col-md-4 form-group mt-2">
    <label for="email">Responsável:</label>
    <input type="text" name="responsavel" id="responsavel" class="form-control" value="{{ $fornecedor != null ? $fornecedor->responsavel : '' }}" >
</div>


<!-- EMAIL -->
<div class="col-md-4 form-group mt-2">
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ $fornecedor != null ? $fornecedor->email : '' }}" >
</div>

<!-- CELULAR -->
<div class="col-md-4  form-group  mt-2">
    <label for="celular">Celular:</label>
    <input type="tel" name="celular" id="celular" class="form-control" value="{{ $fornecedor != null ? $fornecedor->celular : '' }}" >
</div>




<!-- ENDEREÇO -->
<div class="col-md-12 form-group mt-2 mt-3 ">
    <div class="form-separator"><span>Endereço</span></div>
</div>

<!-- CEP -->
<div class="col-md-3 form-group mt-2">
    <label for="cep">CEP:</label> &nbsp; <span style="color:red" id="CepAguarde"></span>
    <input type="text" name="cep" id="cep" class="form-control" value="{{ $fornecedor != null ? $fornecedor->cep : '' }}"  >
</div>

<!-- RUA -->
<div class="col-md-6 form-group mt-2">
    <label for="rua">Rua:</label>
    <input type="text" name="rua" id="rua" class="form-control" value="{{ $fornecedor != null ? $fornecedor->rua : '' }}" required >
</div>

<!-- NÚMERO -->
<div class="col-md-3 form-group mt-2">
    <label for="numero">Número:</label>
    <input type="text" name="numero" id="numero" class="form-control" value="{{ $fornecedor != null ? $fornecedor->numero : '' }}" required >
</div>

<!-- COMPLEMENTO -->
<div class="col-md-3 form-group mt-2">
    <label for="complemento">Complemento:</label>
    <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $fornecedor != null ? $fornecedor->complemento : '' }}" >
</div>

<!-- BAIRRO -->
<div class="col-md-3 form-group mt-2">
    <label for="bairro">Bairro:</label>
    <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $fornecedor != null ? $fornecedor->bairro : '' }}"  required>
</div>

<!-- CIDADE -->
<div class="col-md-3 form-group mt-2">
    <label for="cidade">Cidade:</label>
    <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $fornecedor != null ? $fornecedor->cidade : '' }}"  required>
</div>

<!-- ESTADO -->
<div class="col-md-3 form-group mt-2">
    <label for="uf">Estado:</label>
    <select class="form-control select2" name="uf" id="uf" placeholder="Selecione" required >
        <option value="">Selecione</option>
        <option value="AC" @if($fornecedor != null && $fornecedor->uf=='AC') selected="selected" @endif>Acre</option>
        <option value="AL" @if($fornecedor != null && $fornecedor->uf=='AL') selected="selected" @endif>Alagoas</option>
        <option value="AP" @if($fornecedor != null && $fornecedor->uf=='AP') selected="selected" @endif>Amapá</option>
        <option value="AM" @if($fornecedor != null && $fornecedor->uf=='AM') selected="selected" @endif>Amazonas</option>
        <option value="BA" @if($fornecedor != null && $fornecedor->uf=='BA') selected="selected" @endif>Bahia</option>
        <option value="CE" @if($fornecedor != null && $fornecedor->uf=='CE') selected="selected" @endif>Ceará</option>
        <option value="DF" @if($fornecedor != null && $fornecedor->uf=='DF') selected="selected" @endif>Distrito Federal</option>
        <option value="ES" @if($fornecedor != null && $fornecedor->uf=='ES') selected="selected" @endif>Espírito Santo</option>
        <option value="GO" @if($fornecedor != null && $fornecedor->uf=='GO') selected="selected" @endif>Goiás</option>
        <option value="MA" @if($fornecedor != null && $fornecedor->uf=='MA') selected="selected" @endif>Maranhão</option>
        <option value="MT" @if($fornecedor != null && $fornecedor->uf=='MT') selected="selected" @endif>Mato Grosso</option>
        <option value="MS" @if($fornecedor != null && $fornecedor->uf=='MS') selected="selected" @endif>Mato Grosso do Sul</option>
        <option value="MG" @if($fornecedor != null && $fornecedor->uf=='MG') selected="selected" @endif>Minas Gerais</option>
        <option value="PA" @if($fornecedor != null && $fornecedor->uf=='PA') selected="selected" @endif>Pará</option>
        <option value="PB" @if($fornecedor != null && $fornecedor->uf=='PB') selected="selected" @endif>Paraíba</option>
        <option value="PR" @if($fornecedor != null && $fornecedor->uf=='PR') selected="selected" @endif>Paraná</option>
        <option value="PE" @if($fornecedor != null && $fornecedor->uf=='PE') selected="selected" @endif>Pernambuco</option>
        <option value="PI" @if($fornecedor != null && $fornecedor->uf=='PI') selected="selected" @endif>Piauí</option>
        <option value="RJ" @if($fornecedor != null && $fornecedor->uf=='RJ') selected="selected" @endif>Rio de Janeiro</option>
        <option value="RN" @if($fornecedor != null && $fornecedor->uf=='RN') selected="selected" @endif>Rio Grande do Norte</option>
        <option value="RS" @if($fornecedor != null && $fornecedor->uf=='RS') selected="selected" @endif>Rio Grande do Sul</option>
        <option value="RO" @if($fornecedor != null && $fornecedor->uf=='RO') selected="selected" @endif>Rondônia</option>
        <option value="RR" @if($fornecedor != null && $fornecedor->uf=='RR') selected="selected" @endif>Roraima</option>
        <option value="SC" @if($fornecedor != null && $fornecedor->uf=='SC') selected="selected" @endif>Santa Catarina</option>
        <option value="SP" @if($fornecedor != null && $fornecedor->uf=='SP') selected="selected" @endif>São Paulo</option>
        <option value="SE" @if($fornecedor != null && $fornecedor->uf=='SE') selected="selected" @endif>Sergipe</option>
        <option value="TO" @if($fornecedor != null && $fornecedor->uf=='TO') selected="selected" @endif>Tocantins</option>
    </select>
</div>


<script>
$('#create_edit').on('keydown', function (e) {
    if (e.key === 'Enter') {
        // Impede o comportamento padrão da tecla Enter
        e.preventDefault();
    }
});


@if($fornecedor!=null)
    var url_post = "{{route('fornecedores.update',$fornecedor->id)}}";
    var tipo = $("#tipo_pessoa").val();
    showTipo(tipo);
@else
    var url_post = "{{route('fornecedores.store')}}";
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
                var errorMessage = 'Erro ao registrar fornecedor';
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
