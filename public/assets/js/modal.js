function showModal(url) {
    // Assegura que o contêiner para o modal não exista já e cria um novo
    $('#dynamicModalContainer').remove();
    $("body").append('<div id="dynamicModalContainer"></div>');

    $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
        // Insere o HTML do modal no contêiner recém-criado
        $('#dynamicModalContainer').html(response);

        // Encontra a modal dentro do HTML injetado
        var modalElement = $('#dynamicModalContainer .modal').first();

        // Verifica se encontrou o modal e o inicializa
        if (modalElement.length) {
          var modalInstance = new bootstrap.Modal(modalElement[0]);
          modalInstance.show();
        } else {
          console.error('O HTML carregado não contém um modal válido.');
        }
      },
      error: function() {
        console.error('Erro ao carregar o modal da URL fornecida.');
      }
    });
  }
//DEFINE DINAMICAMENTE A ALTURA DA MODAL
function doModalHigh() {
    var scr_height = window.innerHeight - 125;
    $(".modal-body").css("overflow-y", "auto", "!important");
    $(".modal-body").css("overflow-x", "auto", "!important");
    $(".modal-body").css("height", scr_height + "px", "!important");
    $(".modal-dialog").css("margin-top", "10px", "!important");
}
