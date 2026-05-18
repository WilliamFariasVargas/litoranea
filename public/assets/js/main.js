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

let exportProgressTimer = null;

function showExportLoadingModal(titulo, mensagem) {
    const el = document.getElementById('exportLoadingModal');
    if (!el) return;

    document.getElementById('exportLoadingTitle').textContent = titulo || 'Preparando arquivo...';
    document.getElementById('exportLoadingMessage').textContent = mensagem || 'Aguarde enquanto geramos o arquivo para download.';
    updateExportProgress(0);

    bootstrap.Modal.getOrCreateInstance(el, {
        backdrop: 'static',
        keyboard: false,
    }).show();
}

function hideExportLoadingModal() {
    if (exportProgressTimer) {
        clearInterval(exportProgressTimer);
        exportProgressTimer = null;
    }

    const el = document.getElementById('exportLoadingModal');
    if (!el) return;

    const instance = bootstrap.Modal.getInstance(el);
    if (instance) {
        instance.hide();
    }
}

function updateExportProgress(percent) {
    const value = Math.max(0, Math.min(100, Math.round(percent)));
    const bar = document.getElementById('exportProgressBar');
    const label = document.getElementById('exportProgressPercent');

    if (bar) {
        bar.style.width = value + '%';
        bar.setAttribute('aria-valuenow', value);
    }
    if (label) {
        label.textContent = value + '%';
    }
}

function startExportProgressSimulation() {
    if (exportProgressTimer) {
        clearInterval(exportProgressTimer);
    }

    let progress = 5;
    updateExportProgress(progress);

    exportProgressTimer = setInterval(function () {
        if (progress < 90) {
            progress += Math.random() * 6 + 2;
            updateExportProgress(Math.min(90, progress));
        }
    }, 450);
}

function baixarExportacaoComLoading(url, filename, tipoLabel) {
    showExportLoadingModal(
        'Gerando ' + tipoLabel + '...',
        'Não feche esta janela. Com muitos registros, o processo pode levar alguns minutos.'
    );
    startExportProgressSimulation();

    fetch(url, {
        method: 'GET',
        credentials: 'same-origin',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/octet-stream, application/json',
        },
    })
        .then(async function (response) {
            const contentType = (response.headers.get('Content-Type') || '').toLowerCase();

            if (contentType.includes('application/json') || contentType.includes('text/json')) {
                const data = await response.json();
                throw new Error(data.message || data.detail || 'Não foi possível gerar o arquivo.');
            }

            if (!response.ok) {
                if (contentType.includes('text/html')) {
                    throw new Error('O servidor retornou erro ao gerar o arquivo. Verifique o limite de tempo do PHP/hospedagem ou tente novamente em instantes.');
                }
                throw new Error('Não foi possível gerar o arquivo (HTTP ' + response.status + ').');
            }

            if (contentType.includes('text/html')) {
                throw new Error('Resposta inválida do servidor. Atualize a página, faça login novamente e tente de novo.');
            }

            return response.blob();
        })
        .then(function (blob) {
            updateExportProgress(100);

            const blobUrl = window.URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = blobUrl;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            link.remove();
            window.URL.revokeObjectURL(blobUrl);

            setTimeout(function () {
                hideExportLoadingModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Download iniciado',
                    text: 'O arquivo ' + tipoLabel + ' foi gerado com sucesso.',
                    timer: 2500,
                    showConfirmButton: false,
                });
            }, 400);
        })
        .catch(function (error) {
            hideExportLoadingModal();
            Swal.fire({
                icon: 'error',
                title: 'Erro na exportação',
                text: error.message || 'Não foi possível concluir a exportação. Tente novamente.',
            });
        });
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

