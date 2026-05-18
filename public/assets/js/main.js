// Select2 dentro de modal Bootstrap 5: impede o trap de foco de fechar o dropdown
document.addEventListener('focusin', function (e) {
    if (e.target.closest('.select2-container, .select2-dropdown')) {
        e.stopImmediatePropagation();
    }
}, true);

function destroySelect2($elements) {
    $elements.each(function () {
        if ($(this).hasClass('select2-hidden-accessible')) {
            $(this).select2('destroy');
        }
    });
}

function initSelect2($elements, options) {
    destroySelect2($elements);
    return $elements.select2($.extend({
        width: '100%',
        allowClear: true,
        placeholder: 'Selecione',
    }, options || {}));
}

function initCadastroPedidoModal($modal) {
    const $parent = $modal.find('.modal-content');

    initSelect2($modal.find('select.select2'), {
        dropdownParent: $parent,
        placeholder: function () {
            return $(this).data('placeholder') || 'Selecione';
        },
    });

    $modal.find('.money').off('blur.cadastroPedido').on('blur.cadastroPedido', function () {
        let valor = this.value.trim().replace(/\./g, '').replace(',', '.');
        if (!isNaN(valor) && valor !== '') {
            const numero = parseFloat(valor);
            this.value = numero.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
        } else {
            this.value = '0,00';
        }
    });

    $modal.find('#indice_comissao').off('input.cadastroPedido').on('input.cadastroPedido', function () {
        this.value = this.value.replace(/\D/g, '');
        $modal.find('#valor_pedido, #valor_faturado, #indice_comissao').trigger('input.cadastroPedido');
    });

    function toNum(str) {
        if (!str) return 0;
        return parseFloat(str.replace(/\./g, '').replace(',', '.')) || 0;
    }

    $modal.find('#valor_pedido, #valor_faturado, #indice_comissao')
        .off('input.cadastroPedido')
        .on('input.cadastroPedido', function () {
            const vp = toNum($modal.find('#valor_pedido').val());
            const vf = toNum($modal.find('#valor_faturado').val());
            const ic = parseFloat($modal.find('#indice_comissao').val()) || 0;

            $modal.find('#valor_comissao_parcial').val(((vp * ic) / 100).toFixed(2).replace('.', ','));
            $modal.find('#valor_comissao_faturada').val(((vf * ic) / 100).toFixed(2).replace('.', ','));
        });
}

function formatPedidoDecimal(raw) {
    if (!raw) return '0.00';
    if (raw.includes(',')) {
        return parseFloat(raw.replace(/\./g, '').replace(',', '.')).toFixed(2);
    }
    return parseFloat(raw).toFixed(2);
}

function cleanupStuckModalBackdrops() {
    const visibleModals = document.querySelectorAll('.modal.show');
    const backdrops = document.querySelectorAll('.modal-backdrop');

    if (visibleModals.length === 0) {
        backdrops.forEach(function (el) {
            el.remove();
        });
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('overflow');
        document.body.style.removeProperty('padding-right');
        return;
    }

    if (backdrops.length > visibleModals.length) {
        for (let i = visibleModals.length; i < backdrops.length; i++) {
            backdrops[i].remove();
        }
    }
}

function hideCadastroPedidoModal() {
    const el = document.getElementById('modalMain');
    if (!el) {
        cleanupStuckModalBackdrops();
        return;
    }

    const instance = bootstrap.Modal.getInstance(el);
    if (instance) {
        el.addEventListener('hidden.bs.modal', function () {
            cleanupStuckModalBackdrops();
        }, { once: true });
        instance.hide();
        return;
    }

    el.classList.remove('show');
    el.setAttribute('aria-hidden', 'true');
    el.style.removeProperty('display');
    cleanupStuckModalBackdrops();
}

function handleAjaxError(xhr, status, error) {
    console.log("Analisando erro HTTP: " + error)
    var errorData = {};

    try {
        errorData = JSON.parse(xhr.responseText);
    } catch (e) {
        // Se a resposta não for um JSON válido, criar dados de erro padrão
        errorData.swal = {
            title: 'Erro na requisição',
            msg: xhr.responseText,
            type: 'error'
        };
    }

    // Mostrar mensagem de erro usando SweetAlert2
    Swal.fire({
        title: errorData.swal.title,
        html: errorData.swal.msg,
        icon: errorData.swal.type,
    });

    // Remover o atributo 'disabled' de todos os botões desabilitados e alterar o conteúdo para "Tentar novamente"
    $('button[disabled]').each(function() {
        $(this).removeAttr('disabled').html('Tentar novamente');
    });
}


$.fn.takedata = function(url, method, dataType){
    try{
        $(".modal-body").hide();
        $("#bt-modal-send").hide();

        if (method == undefined) method = "POST";
        if (dataType == undefined) dataType = "JSON";

        $("#create_edit").off();
        $(".modal-title").html("<b>Novo registro</b>");
        $("#bt-modal-send").html("<i class=\"fa fa-save mr-2\"></i> Salvar")
        $("#create_edit").ajaxFileForm(url, method, dataType);

        $(".modal-body").fadeIn();
        $("#bt-modal-send").fadeIn();
    }catch{
        console.log("No take data ready")
    }

}

