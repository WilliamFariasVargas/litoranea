<div class="modal-header">
    <h5 class="modal-title">Editar Pedido</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
</div>

<div class="modal-body">
    <form id="edit_pedido_form" method="POST" class="row g-2">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label for="data_pedido" class="form-label obrigatorio">Data do Pedido:</label>
            <input type="date" name="data_pedido" id="data_pedido" class="form-control" required value="{{ $pedido->data_pedido }}">
        </div>

        <div class="col-md-6">
            <label for="cliente_id">Cliente:</label>
            <select id="cliente_id" name="cliente_id" class="form-control select2" data-placeholder="Selecione um cliente">
                <option value="">Selecione</option>
                @foreach(\App\Models\Cliente::all() as $cliente)
                    <option value="{{ $cliente->id }}" @if($pedido->cliente_id == $cliente->id) selected @endif>{{ $cliente->razao_social }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="representada_id">Representada:</label>
            <select id="representada_id" name="representada_id" class="form-control select2" data-placeholder="Selecione uma representada">
                <option value="">Selecione</option>
                @foreach(\App\Models\Representada::all() as $rep)
                    <option value="{{ $rep->id }}" @if($pedido->representada_id == $rep->id) selected @endif>{{ $rep->razao_social }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="transportadora_id">Transportadora:</label>
            <select id="transportadora_id" name="transportadora_id" class="form-control select2" data-placeholder="Selecione uma transportadora">
                <option value="">Selecione</option>
                @foreach(\App\Models\Transportadora::all() as $trans)
                    <option value="{{ $trans->id }}" @if($pedido->transportadora_id == $trans->id) selected @endif>{{ $trans->razao_social }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="valor_pedido" class="form-label obrigatorio">Valor do Pedido:</label>
            <input type="text" name="valor_pedido" id="valor_pedido" class="form-control money" value="{{ number_format($pedido->valor_pedido, 2, ',', '.') }}">
        </div>

        <div class="col-md-6">
            <label for="valor_faturado" class="form-label">Valor Faturado:</label>
            <input type="text" name="valor_faturado" id="valor_faturado" class="form-control money" value="{{ number_format($pedido->valor_faturado, 2, ',', '.') }}">
        </div>

        <div class="col-md-6">
            <label for="indice_comissao" class="form-label obrigatorio">Índice de Comissão (%):</label>
            <input type="text" name="indice_comissao" id="indice_comissao" class="form-control money" value="{{ number_format($pedido->indice_comissao ?? 0, 2, ',', '.') }}">
        </div>

        <div class="col-md-6">
            <label for="data_faturamento" class="form-label">Data do Faturamento:</label>
            <input type="date" name="data_faturamento" id="data_faturamento" class="form-control" value="{{ $pedido->data_faturamento }}">
        </div>

        <div class="col-md-6">
            <label for="valor_comissao_parcial" class="form-label">Valor Comissão Parcial:</label>
            <input type="text" name="valor_comissao_parcial" id="valor_comissao_parcial" class="form-control money" readonly value="{{ number_format($pedido->valor_comissao_parcial, 2, ',', '.') }}">
        </div>

        <div class="col-md-6">
            <label for="valor_comissao_faturada" class="form-label">Valor Comissão Faturada:</label>
            <input type="text" name="valor_comissao_faturada" id="valor_comissao_faturada" class="form-control money" readonly value="{{ number_format($pedido->valor_comissao_faturada, 2, ',', '.') }}">
        </div>
    </form>
</div>

<div class="modal-footer">
    <button type="submit" form="edit_pedido_form" class="btn btn-primary">Salvar</button>
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
    $('#edit_pedido_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('cadastrodepedido.update', $pedido->id) }}",
            method: 'POST',
            data: $(this).serialize(),
            success: data => {
                Swal.fire('Sucesso!', data.message, 'success').then(() => {
                    tblPopulate();
                    $('#modalMain').modal('hide');
                });
            },
            error: xhr => {
                Swal.fire('Erro!', xhr.responseJSON?.message || 'Erro ao atualizar o pedido.', 'error');
            }
        });
    });
});
</script>
