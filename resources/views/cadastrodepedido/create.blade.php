<div class="modal-header">
    <h5 class="modal-title">Cadastro de Pedido</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
</div>

<div class="modal-body">
    <form id="create_edit" method="POST" class="row g-2">
        @csrf

        {{-- Data Pedido --}}
        <div class="col-md-6">
            <label for="data_pedido" class="form-label obrigatorio">Data do Pedido:</label>
            <input type="date" name="data_pedido" id="data_pedido" class="form-control" required>
        </div>

        {{-- Cliente --}}
    <div class="col-md-6">
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

    {{-- Representada --}}
    <div class="col-md-6">
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

    {{-- Transportadora --}}
    <div class="col-md-6">
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

        {{-- Valores --}}
        <div class="col-md-6">
            <label for="valor_pedido" class="form-label obrigatorio">Valor do Pedido:</label>
            <input type="text" name="valor_pedido" id="valor_pedido" class="form-control money" required>
        </div>

        <div class="col-md-6">
            <label for="valor_faturado" class="form-label">Valor Faturado:</label>
            <input type="text" name="valor_faturado" id="valor_faturado" class="form-control money">
        </div>

        <div class="col-md-6">
            <label for="indice_comissao" class="form-label obrigatorio">Índice de Comissão (%):</label>
            <input type="text" name="indice_comissao" id="indice_comissao" class="form-control money">
        </div>


        <div class="col-md-6">
            <label for="data_faturamento" class="form-label">Data do Faturamento:</label>
            <input type="date" name="data_faturamento" id="data_faturamento" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="valor_comissao_parcial" class="form-label">Valor Comissão Parcial:</label>
            <input type="text" name="valor_comissao_parcial" id="valor_comissao_parcial" class="form-control ">
        </div>

        <div class="col-md-6">
            <label for="valor_comissao_faturada" class="form-label">Valor Comissão Faturada:</label>
            <input type="text" name="valor_comissao_faturada" id="valor_comissao_faturada" class="form-control ">
        </div>

    </form>
</div>
<div class="modal-footer">
    <button type="submit" form="create_edit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
</div>

<script>
$(document).ready(function() {
    const url_post = "{{ route('cadastrodepedido.store') }}";

    // Máscara para campos monetários
    $('.money').mask('000.000.000,00', { reverse: true });

    // Select2 - Cliente
    $('#cliente_id').select2({
        placeholder: 'Selecione um cliente',
        allowClear: true,
        ajax: {
            url: "{{ route('clientes.search') }}",
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: data => ({
                results: data.map(item => ({
                    id: item.id,
                    text: item.razao_social
                }))
            }),
            cache: true
        }
    });

    // Select2 - Representada
    $('#representada_id').select2({
        placeholder: 'Selecione uma representada',
        allowClear: true,
        ajax: {
            url: "{{ route('representadas.search') }}",
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: data => ({
                results: data.map(item => ({
                    id: item.id,
                    text: item.nome
                }))
            }),
            cache: true
        }
    });

    // Select2 - Transportadora
    $('#transportadora_id').select2({
        placeholder: 'Selecione uma transportadora',
        allowClear: true,
        ajax: {
            url: "{{ route('transportadoras.search') }}",
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: data => ({
                results: data.map(item => ({
                    id: item.id,
                    text: item.nome
                }))
            }),
            cache: true
        }
    });

    $('#valor_pedido, #valor_faturado, #indice_comissao').on('input', function() {
    calcularComissao();
    });


    // ENVIO AJAX do formulário de cadastro de pedido
    $('#create_edit').submit(function(e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            url: url_post,
            method: 'POST',
            data: formData,
            success: function(data) {
                Swal.fire('Sucesso!', data.message, 'success').then(() => {
                    tblPopulate(); // Atualiza a tabela de pedidos
                    $('#modalMain').modal('hide'); // Fecha o modal
                });
            },
            error: function(xhr) {
                Swal.fire('Erro!', xhr.responseJSON?.message || 'Erro ao salvar pedido.', 'error');
            }
        });
    });

    function calcularComissao() {
    let valorPedido = parseFloat($('#valor_pedido').val().replace(/\./g, '').replace(',', '.')) || 0;
    let valorFaturado = parseFloat($('#valor_faturado').val().replace(/\./g, '').replace(',', '.')) || 0;
    let indiceComissao = parseFloat($('#indice_comissao').val().replace(/\./g, '').replace(',', '.')) || 0;

    let valorComissaoParcial = (valorPedido * indiceComissao) / 100;
    let valorComissaoFaturada = (valorFaturado * indiceComissao) / 100;

    if (!isNaN(valorComissaoParcial)) {
        $('#valor_comissao_parcial').val(valorComissaoParcial.toFixed(2).replace('.', ','));
    }
    if (!isNaN(valorComissaoFaturada)) {
        $('#valor_comissao_faturada').val(valorComissaoFaturada.toFixed(2).replace('.', ','));
    }
}

});
</script>
