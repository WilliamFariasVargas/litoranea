@extends('layouts.modal')

@php
    $title = "Cadastro de Representadas";
    if($representada!= null) {
        $title = 'Editando: '. $representada->id.' - '.$representada->razao_social;
    }
@endphp

@section('modal_title') {{ $title }} @endsection

@section('modal_content')

<form id="create_edit" method="POST">
    @csrf

    <section id="div_tipo_pessoa" class="row col-md-12">
        <div class="col-md-4 form-group mb-2">
            <label for="tipo">Tipo</label>
            <select name="tipo_pessoa" id="tipo_pessoa" class="form-control select2" required>
                <option {{ $representada != null ? ($representada->tipo_pessoa==1 ? 'selected' : '') : ''}} value="1" >Pessoa Jurídica</option>
                <option {{ $representada != null ? ($representada->tipo_pessoa==2 ? 'selected' : '') : ''}} value="2">Pessoa Física</option>
            </select>
        </div>
    </section>

    <div class="col-md-4 mt-2">
        <label for="cnpj" id="labelCNPJ">CNPJ:</label>
        <input type="text" maxlength="20" name="cpf_cnpj" id="cpf_cnpj" class="form-control" value="{{ $representada != null ? $representada->cpf_cnpj : '' }}" />
    </div>

    <div class="form-group col-md-8 mt-2">
        <label for="empresa" id="labelNome">Razão Social:</label>
        <input type="text" maxlength="250" name="razao_social" class="form-control" id="razao_social" value="{{ $representada != null ?  $representada->razao_social : '' }}" required />
    </div>

    <div class="col-md-8 form-group mt-2">
        <label for="nome_fantasia" id="labelFantasia">Nome Fantasia:</label>
        <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" value="{{ $representada != null ? $representada->nome_fantasia : '' }}">
    </div>

    <div class="col-md-4 form-group mt-2">
        <label for="fone">Telefone:</label>
        <input type="tel" name="fone" id="fone" class="form-control" value="{{ $representada != null ? $representada->fone : '' }}" >
    </div>

    <div class="col-md-4 form-group mt-2">
        <label for="email">Responsável:</label>
        <input type="text" name="responsavel" id="responsavel" class="form-control" value="{{ $representada != null ? $representada->responsavel : '' }}" >
    </div>

    <div class="col-md-4 form-group mt-2">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $representada != null ? $representada->email : '' }}" >
    </div>

    <div class="col-md-4  form-group  mt-2">
        <label for="celular">Celular:</label>
        <input type="tel" name="celular" id="celular" class="form-control" value="{{ $representada != null ? $representada->celular : '' }}" >
    </div>

    <div class="col-md-12 form-group mt-2 mt-3 ">
        <div class="form-separator"><span>Endereço</span></div>
    </div>

    <div class="col-md-3 form-group mt-2">
        <label for="cep">CEP:</label> &nbsp; <span style="color:red" id="CepAguarde"></span>
        <input type="text" name="cep" id="cep" class="form-control" value="{{ $representada != null ? $representada->cep : '' }}"  >
    </div>

    <div class="col-md-6 form-group mt-2">
        <label for="rua">Rua:</label>
        <input type="text" name="rua" id="rua" class="form-control" value="{{ $representada != null ? $representada->rua : '' }}" required >
    </div>

    <div class="col-md-3 form-group mt-2">
        <label for="numero">Número:</label>
        <input type="text" name="numero" id="numero" class="form-control" value="{{ $representada != null ? $representada->numero : '' }}" required >
    </div>

    <div class="col-md-3 form-group mt-2">
        <label for="complemento">Complemento:</label>
        <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $representada != null ? $representada->complemento : '' }}" >
    </div>

    <div class="col-md-3 form-group mt-2">
        <label for="bairro">Bairro:</label>
        <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $representada != null ? $representada->bairro : '' }}"  required>
    </div>

    <div class="col-md-3 form-group mt-2">
        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $representada != null ? $representada->cidade : '' }}"  required>
    </div>

    <div class="col-md-3 form-group mt-2">
        <label for="uf">Estado:</label>
        <select class="form-control select2" name="uf" id="uf" placeholder="Selecione" required >
            <option value="">Selecione</option>
            @foreach(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'] as $estado)
                <option value="{{ $estado }}" @if($representada != null && $representada->uf == $estado) selected @endif>{{ $estado }}</option>
            @endforeach
        </select>
    </div>
</form>

<script>
    $('#create_edit').on('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });

    @if($representada!=null)
        var url_post = "{{route('representadas.update',$representada->id)}}";
        var tipo = $("#tipo_pessoa").val();
        showTipo(tipo);
    @else
        var url_post = "{{route('representadas.store')}}";
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

        $("#cpf_cnpj").blur(function(){
            var tipo = $("#tipo_pessoa").val();
            var cpf_cnpj = $("#cpf_cnpj").val().replace(/[^0-9]/g,'');
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

        $("#cep").change(function(){
            var cep = $("#cep").val().replace(/[^0-9]/g,'');
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

        function selecionar(uf){
            $('#uf option').each(function(e) {
                if($(this).attr('value') == uf) {
                    $(this).prop('selected', true);
                    $("#select2-uf-container").html($(this).text())
                }
            });
        }
    });
</script>

@endsection
