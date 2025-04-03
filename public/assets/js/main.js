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

