@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-8" style="vertical-align: middle">
            <h4 style="color:#003162;" class="title mt-2">
                <i class="fa fa-list-alt mx-2"></i>Cadastro de Pedidos
            </h4>
        </div>

        <div class="col-4 text-end">
            <button type="button" style="background-color:#003162;" class="btn btn-primary" id="novoPedidoBtn">
                <i class="fa fa-plus mx-2"></i> Novo
            </button>
        </div>

        <br><br><hr>
    </div>
</section>

<section class="col-md-12 mt-2 container-fluid" id="divTable">
    {{-- Aqui vai carregar a tabela via AJAX --}}
</section>

<script>
$(document).ready(function() {

    // Botão Novo Pedido - abre modal
    $('#novoPedidoBtn').click(function() {
        $.ajax({
            url: "{{ route('cadastrodepedido.create') }}",
            method: 'GET',
            success: function(data) {
                showModal(data); // Função padrão para abrir modal no seu sistema
            },
            error: function() {
                Swal.fire('Erro!', 'Não foi possível abrir o formulário.', 'error');
            }
        });
    });

    // Primeira carga da tabela ao abrir a tela
    tblPopulate();

});

// Função para popular a tabela de pedidos
function tblPopulate() {
    $.ajax({
        url: "{{ route('cadastrodepedido.tabela') }}",
        method: "GET",
        beforeSend: function() {
            $("#divTable").html("Carregando...");
        },
        success: function(response) {
            $("#divTable").html(response);
        },
        error: function() {
            $("#divTable").html('Erro ao carregar dados');
        }
    });
}

function showModal(content) {
    if ($('#modalMain').length === 0) {
        $('body').append(`
            <div class="modal fade" id="modalMain" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Conteúdo AJAX vem aqui -->
                    </div>
                </div>
            </div>
        `);
    }

    $('#modalMain .modal-content').html(content);
    $('#modalMain').modal('show');
}

</script>
@endsection
