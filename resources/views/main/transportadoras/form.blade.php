@extends('layouts.modal')

@php
    $title = "Cadastro de Transportadora";
    if($transportadora != null) $title = 'Editando: ' . $transportadora->id . ' - ' . $transportadora->razao_social;
@endphp

@section('modal_title') {{ $title }} @endsection

@section('modal_content')
<form id="create_edit">
<section class="row col-md-12">
    <div class="col-md-4 form-group mb-2">
        <label for="tipo">Tipo</label>
        <select name="tipo_pessoa" id="tipo_pessoa" class="form-control select2" required>
            <option value="" {{ $transportadora == null || $transportadora->tipo_pessoa == null ? 'selected' : '' }}>Selecione</option>
            <option value="1" {{ $transportadora != null && $transportadora->tipo_pessoa == 1 ? 'selected' : '' }}>Pessoa Jurídica</option>
            <option value="2" {{ $transportadora != null && $transportadora->tipo_pessoa == 2 ? 'selected' : '' }}>Pessoa Física</option>
        </select>
    </div>
    <div class="col-md-8 mt-12">
        <label for="cpf_cnpj" id="labelCNPJ">CNPJ:</label>
        <input type="text" maxlength="20" name="cpf_cnpj" id="cpf_cnpj" class="form-control" value="{{ $transportadora->cpf_cnpj ?? '' }}" />
    </div>
</section>

<div class="row col-md-12">
    <div class="form-group col-md-6 mt-2">
        <label id="labelNome">Razão Social:</label>
        <input type="text" maxlength="250" name="razao_social" class="form-control" id="razao_social" value="{{ $transportadora->razao_social ?? '' }}" />
    </div>
    <div class="col-md-6 form-group mt-2">
        <label id="labelFantasia">Nome Fantasia:</label>
        <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" value="{{ $transportadora->nome_fantasia ?? '' }}">
    </div>
</div>

<div class="row col-md-12">
    <div class="col-md-4 form-group mt-2" id="div_inscricao_estadual">
        <label for="inscricao_estadual">Inscrição Estadual:</label>
        <input type="text" maxlength="50" name="inscricao_estadual" id="inscricao_estadual" class="form-control" value="{{ $transportadora->inscricao_estadual ?? '' }}">
    </div>
</div>

<div class="row col-md-12">
    <div class="col-md-4 form-group mt-2">
        <label>Telefone:</label>
        <input type="tel" name="fone" id="fone" class="form-control" value="{{ $transportadora->fone ?? '' }}">
    </div>
    <div class="col-md-4 form-group mt-2">
        <label>Telefone 2:</label>
        <input type="tel" name="fone_2" id="fone_2" class="form-control" value="{{ $transportadora->fone_2 ?? '' }}">
    </div>
    <div class="col-md-4 form-group mt-2">
        <label>Telefone 3:</label>
        <input type="tel" name="fone_3" id="fone_3" class="form-control" value="{{ $transportadora->fone_3 ?? '' }}">
    </div>
</div>

<div class="row col-md-12">
    <div class="col-md-4 form-group mt-2">
        <label>Celular:</label>
        <input type="tel" name="celular" id="celular" class="form-control" value="{{ $transportadora->celular ?? '' }}">
    </div>
    <div class="col-md-4 form-group mt-2">
        <label>Celular 2:</label>
        <input type="tel" name="celular_2" id="celular_2" class="form-control" value="{{ $transportadora->celular_2 ?? '' }}">
    </div>
    <div class="col-md-4 form-group mt-2">
        <label>Celular 3:</label>
        <input type="tel" name="celular_3" id="celular_3" class="form-control" value="{{ $transportadora->celular_3 ?? '' }}">
    </div>
</div>

<div class="row col-md-12">
    <div class="col-md-4 form-group mt-2">
        <label>Responsável:</label>
        <input type="text" name="responsavel" id="responsavel" class="form-control" value="{{ $transportadora->responsavel ?? '' }}">
    </div>
    <div class="col-md-4 form-group mt-2">
        <label>E-mail:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $transportadora->email ?? '' }}">
    </div>
    <div class="col-md-4 form-group mt-2">
        <label>E-mail 2:</label>
        <input type="email" name="email_2" id="email_2" class="form-control" value="{{ $transportadora->email_2 ?? '' }}">
    </div>
</div>

<div class="row col-md-12">
    <div class="col-md-4 form-group mt-2">
        <label>E-mail 3:</label>
        <input type="email" name="email_3" id="email_3" class="form-control" value="{{ $transportadora->email_3 ?? '' }}">
    </div>
    <div class="col-md-4 form-group mt-2">
        <label>E-mail 4:</label>
        <input type="email" name="email_4" id="email_4" class="form-control" value="{{ $transportadora->email_4 ?? '' }}">
    </div>
    <div class="col-md-4 form-group mt-2">
        <label>E-mail NFe:</label>
        <input type="email" name="email_nfe" id="email_nfe" class="form-control" value="{{ $transportadora->email_nfe ?? '' }}">
    </div>
</div>

<div class="col-md-12 form-group mt-3">
    <div class="form-separator"><span>Endereço</span></div>
</div>

<div class="row col-md-12">
    <div class="col-md-3 form-group mt-2">
        <label>CEP:</label>
        <input type="text" name="cep" id="cep" class="form-control" value="{{ $transportadora->cep ?? '' }}">
    </div>
    <div class="col-md-6 form-group mt-2">
        <label>Rua:</label>
        <input type="text" name="rua" id="rua" class="form-control" value="{{ $transportadora->rua ?? '' }}">
    </div>
    <div class="col-md-3 form-group mt-2">
        <label>Número:</label>
        <input type="text" name="numero" id="numero" class="form-control" value="{{ $transportadora->numero ?? '' }}">
    </div>
    <div class="col-md-3 form-group mt-2">
        <label>Complemento:</label>
        <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $transportadora->complemento ?? '' }}">
    </div>
    <div class="col-md-3 form-group mt-2">
        <label>Bairro:</label>
        <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $transportadora->bairro ?? '' }}">
    </div>
    <div class="col-md-3 form-group mt-2">
        <label>Cidade:</label>
        <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $transportadora->cidade ?? '' }}">
    </div>
    <div class="col-md-3 form-group mt-2">
        <label>Estado:</label>
        <select class="form-control select2" name="uf" id="uf">
            <option value="">Selecione</option>
            @foreach(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'] as $estado)
                <option value="{{ $estado }}" {{ ($transportadora && $transportadora->uf == $estado) ? 'selected' : '' }}>{{ $estado }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-md-12 form-group mt-4">
    <label>Observações:</label>
    <textarea name="observacoes" id="observacoes" rows="3" class="form-control">{{ $transportadora->observacoes ?? '' }}</textarea>
</div>


<script>
@if(isset($transportadora))
    var url_post = "{{ route('transportadoras.update', $transportadora->id) }}";
@else
    var url_post = "{{ route('transportadoras.store') }}";
@endif

$("#tipo_pessoa").change(function () {
    showTipo($(this).val());
});

function showTipo(tipo) {
    if (tipo == 1) {
        $("#labelCNPJ").text("CNPJ:");
        $("#labelNome").text("Razão Social:");
        $("#labelFantasia").text("Nome Fantasia:");
        $("#cpf_cnpj").mask("00.000.000/0000-00");
        $("#div_inscricao_estadual").show();
    } else if (tipo == 2) {
        $("#labelCNPJ").text("CPF:");
        $("#labelNome").text("Nome:");
        $("#labelFantasia").text("Sobrenome:");
        $("#cpf_cnpj").mask("000.000.000-00");
        $("#div_inscricao_estadual").hide();
    }
}

$(document).ready(function () {
    if ($("#tipo_pessoa").val()) {
        showTipo($("#tipo_pessoa").val());
    }

    // Máscaras
    $("#fone, #fone_2, #fone_3").mask("(00) 0000-0000");
    $("#celular, #celular_2, #celular_3").mask("(00) 00000-0000");
    $("#cep").mask("00.000-000");

    // Validação CPF/CNPJ
    $("#cpf_cnpj").blur(function () {
        let tipo = $("#tipo_pessoa").val();
        let valor = $(this).val().replace(/[^0-9]/g, '');
        if (tipo == 1 && !TestaCNPJ(valor)) {
            Swal.fire("Atenção", "CNPJ inválido", "warning");
            $(this).val('');
        } else if (tipo == 2 && !TestaCPF(valor)) {
            Swal.fire("Atenção", "CPF inválido", "warning");
            $(this).val('');
        }
    });

    // Busca CEP
    $("#cep").change(function () {
        let cep = $(this).val().replace(/[^0-9]/g, '');
        if (cep.length != 8) return;
        let url = `https://viacep.com.br/ws/${cep}/json/`;
        $.getJSON(url, function (data) {
            if (!("erro" in data)) {
                $("#rua").val(data.logradouro);
                $("#bairro").val(data.bairro);
                $("#cidade").val(data.localidade);
                $("#uf").val(data.uf).trigger("change");
            }
        });
    });

    // Submit AJAX
    $("#create_edit").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: url_post,
            method: 'POST',
            data: $(this).serialize(),
            success: function (data) {
                Swal.fire("Sucesso!", data.message, "success").then(() => {
                    tblPopulate();
                    $("#closeModal").trigger("click");
                });
            },
            error: function (xhr) {
                let msg = xhr.responseJSON?.message || "Erro ao salvar registro";
                Swal.fire("Erro!", msg, "error");
            }
        });
    });
});
</script>


@endsection
