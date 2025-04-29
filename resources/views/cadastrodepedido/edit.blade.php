<div class="modal-header">
    <h5 class="modal-title">Edição de Pedido</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
</div>

<div class="modal-body">
    <form id="create_edit" method="POST" class="row g-2">
        @csrf
        @method('PUT') {{-- IMPORTANTE para editar no Laravel --}}

        {{-- Data Pedido --}}
        <div class="col-md-6">
            <label for="data_pedido" class="form-label obrigatorio">Data do Pedido:</label>
            <input type="date" name="data_pedido" id="data_pedido" class="form-control" value="{{ $pedido->data_pedido }}" required>
        </div>

        {{-- Cliente --}}
        <div class="col-md-6">
            <label>Cliente:</label>
            <select name="cliente_id" id="cliente_id" class="form-control select2"></select>
        </div>

        {{-- Representada --}}
        <div class="col-md-6">
            <label>Representada:</label>
            <select name="representada_id" id="representada_id" class="form-control select2"></select>
        </div>

        {{-- Transportadora --}}
        <div class="col-md-6">
            <label>Transportadora:</label>
            <select name="transportadora_id" id="transportadora_id" class="form-control select2"></select>
        </div>

        {{-- Valores --}}
        <div class="col-md-4">
            <label for="valor_pedido" class="form-label obrigatorio">Valor do Pedido:</label>
            <input type="text" name="valor_pedido" id="valor_pedido" class="form-control money" value="{{ number_format($pedido->valor_pedido, 2, ',', '.') }}" required>
        </div>

        <div class="col-md-4">
            <label for="valor_faturado" class="form-label">Valor Faturado:</label>
            <input type="text" name="valor_faturado" id="valor_faturado" class="form-control money" value="{{ number_format($pedido->valor_faturado, 2, ',', '.') }}">
        </div>

        <div class="col-md-4">
            <label for="data_faturamento" class="form-label">Data do Faturamento:</label>
            <input type="date" name="data_faturamento" id="data_faturamento" class="form-control" value="{{ $pedido->data_faturamento }}">
        </div>

        <div class="col-md-6">
            <label for="valor_comissao_parcial" class="form-label">Valor Comissão Parcial:</label>
            <input type="text" name="valor_comissao_parcial" id="valor_comissao_parcial" class="form-control money" value="{{ number_format($pedido->valor_comissao_parcial, 2, ',', '.') }}">
        </div>

        <div class="col-md-6">
            <label for="valor_comissao_faturada" class="form-label">Valor Comissão Faturada:</label>
            <input type="text" name="valor_comissao_faturada" id="valor_comissao_faturada" class="form-control money" value="{{ number_format($pedido->valor_comissao_faturada, 2, ',', '.') }}">
        </div>
    </form>
</div>

<div class="modal-footer">
    <button type="submit" form="create_edit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
</div>

<script>
$(document).ready(function() {
    const url_update = "{{ route('cadastrodepedido.update', $pedido->id) }}";

    // Máscara para campos monetários
    $('.money').mask('000.000.000,00', { reverse: true });

    function initSelect2(selector, urlSearch, valueSelected) {
        $(selector).select2({
            placeholder: 'Selecione',
            allowClear: true,
            ajax: {
                url: urlSearch,
                dataType: 'json',
                delay: 250,
                data: params => ({ q: params.term }),
                processResults: data => ({
                    results: data.map(item => ({
                        id: item.id,
                        text: item.razao_social || item.nome
                    }))
                }),
                cache: true
            }
        });

        if (valueSelected) {
            let option = new Option(valueSelected.text, valueSelected.id, true, true);
            $(selector).append(option).trigger('change');
        }
    }

    // Inicializar os selects carregando o valor atual
    initSelect2('#cliente_id', "{{ route('clientes.search') }}", @json($pedido->cliente ? ['id' => $pedido->cliente->id, 'text' => $pedido->cliente->razao_social] : null));
    initSelect2('#representada_id', "{{ route('representadas.search') }}", @json($pedido->representada ? ['id' => $pedido->representada->id, 'text' => $pedido->representada->razao_social] : null));
    initSelect2('#transportadora_id', "{{ route('transportadoras.search') }}", @json($pedido->transportadora ? ['id' => $pedido->transportadora->id, 'text' => $pedido->transportadora->razao_social] : null));

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

    // Envio AJAX do formulário de edição
    $('#create_edit').submit(function(e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            url: url_update,
            method: 'POST',
            data: formData,
            success: function(data) {
                Swal.fire('Sucesso!', data.message, 'success').then(() => {
                    tblPopulate(); // Atualiza a tabela de pedidos
                    $('#modalMain').modal('hide'); // Fecha o modal
                });
            },
            error: function(xhr) {
                Swal.fire('Erro!', xhr.responseJSON?.message || 'Erro ao atualizar pedido.', 'error');
            }
        });
    });
});
</script>
