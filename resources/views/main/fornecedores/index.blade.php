@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-8" style="vertical-align: middle">
            <h4 style="color:#003162;" class="title mt-2">
                <i class="fa fa-users mx-2"></i>Cadastro de Representante
            </h4>
        </div>

        <div class="col-4 text-end">
            {{-- Botão Novo Representante --}}
            <button style="background-color:#003162;" class="btn btn-primary" id="addNew">
                <i class="fa fa-plus mx-2"></i>Novo
            </button>
        </div>
        <br><br><hr>
    </div>
</section>

<section class="col-md-12 mt-2 container-fluid" id="divTable">
    {{-- A tabela será carregada aqui via AJAX --}}
</section>

<script>
    document.getElementById('addNew').addEventListener('click', function(){
        showModal("{{ route('fornecedores.form') }}");
    });

    function tblPopulate() {
        $.ajax({
            url: "{{ route('fornecedores.show') }}",
            method: "GET",
            beforeSend: function() {
                $('#divTable').html('Carregando...');
            },
            success: function(response) {
                $('#divTable').html(response);
            },
            error: function() {
                $('#divTable').html('Erro ao carregar dados');
            }
        });
    }

    // Popula a tabela ao carregar a página
    $(document).ready(tblPopulate);
</script>
@endsection
