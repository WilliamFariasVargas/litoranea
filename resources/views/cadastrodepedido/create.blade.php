<div class="modal-header">
    <h5 class="modal-title">Cadastro de Pedido</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
</div>

<div class="modal-body">
    <form id="create_pedido_form" method="POST" class="row g-2">
        @csrf

        <div class="col-md-6">
            <label for="data_pedido" class="form-label obrigatorio">Data do Pedido:</label>
            <input type="date" name="data_pedido" id="data_pedido" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="cliente_id">Cliente:</label>
            <select id="cliente_id" name="cliente_id" class="form-control select2" data-placeholder="Selecione um cliente">
                <option value="">Selecione</option>
                @foreach(\App\Models\Cliente::all() as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->razao_social }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="representada_id">Representada:</label>
            <select id="representada_id" name="representada_id" class="form-control select2" data-placeholder="Selecione uma representada">
                <option value="">Selecione</option>
                @foreach(\App\Models\Representada::all() as $rep)
                    <option value="{{ $rep->id }}">{{ $rep->razao_social }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="transportadora_id">Transportadora:</label>
            <select id="transportadora_id" name="transportadora_id" class="form-control select2" data-placeholder="Selecione uma transportadora">
                <option value="">Selecione</option>
                @foreach(\App\Models\Transportadora::all() as $trans)
                    <option value="{{ $trans->id }}">{{ $trans->razao_social }}</option>
                @endforeach
            </select>
        </div>

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
            <input type="text" name="valor_comissao_parcial" id="valor_comissao_parcial" class="form-control money" readonly>
        </div>

        <div class="col-md-6">
            <label for="valor_comissao_faturada" class="form-label">Valor Comissão Faturada:</label>
            <input type="text" name="valor_comissao_faturada" id="valor_comissao_faturada" class="form-control money" readonly>
        </div>
    </form>
</div>

<div class="modal-footer">
    <button type="submit" form="create_pedido_form" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
</div>

<script>
$(document).on('shown.bs.modal', '#modalMain', function() {
    const $m = $(this);
    $m.find('.money').mask('000.000.000,00', { reverse: true });

    $m.find('#valor_pedido, #valor_faturado, #indice_comissao').off('input').on('input', function() {
        let vp = parseFloat($m.find('#valor_pedido').val().replace(/\./g,'').replace(',','.')) || 0;
        let vf = parseFloat($m.find('#valor_faturado').val().replace(/\./g,'').replace(',','.')) || 0;
        let ic = parseFloat($m.find('#indice_comissao').val().replace(/\./g,'').replace(',','.')) || 0;
        $m.find('#valor_comissao_parcial').val(((vp * ic)/100).toFixed(2).replace('.',','));
        $m.find('#valor_comissao_faturada').val(((vf * ic)/100).toFixed(2).replace('.',','));
    });

    // Inicializa selects simples sem ajax
    $m.find('#cliente_id, #representada_id, #transportadora_id').select2({
        dropdownParent: $m,
        placeholder: function() {
            return $(this).data('placeholder');
        },
        allowClear: true,
        width: '100%'
    });
});

$(document).ready(function() {
    $('#create_pedido_form').submit(function(e) {
        e.preventDefault();
        $.post("{{ route('cadastrodepedido.store') }}", $(this).serialize())
            .done(data => {
                Swal.fire('Sucesso!', data.message, 'success').then(() => {
                    tblPopulate();
                    $('#modalMain').modal('hide');
                });
            })
            .fail(xhr => {
                Swal.fire('Erro!', xhr.responseJSON?.message || 'Erro ao salvar pedido.', 'error');
            });
    });
});
</script>
