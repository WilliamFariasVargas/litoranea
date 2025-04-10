@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-8">
            <h4 style="color:#003162;" class="title mt-2">
                <i class="fa fa-user mx-2"></i>Gerenciamento de Usuários
            </h4>
        </div>
        <div class="col-4 text-end">
            <button style="background-color:#003162;" class="btn btn-primary" id="addNew">
                <i class="fa fa-plus mx-2"></i>Novo
            </button>
        </div>
        <br><br><hr>
    </div>
</section>

<section class="col-md-12 mt-2 container-fluid" id="divTable">
    @include('main.users.table')
</section>
<script>
    function initUserTable() {
        if ( $.fn.dataTable.isDataTable('#table-users') ) {
            $('#table-users').DataTable().destroy();
        }

        $('#table-users').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
            }
        });
    }

    function bindUserForm() {
        $(document).off('submit', '#formUser').on('submit', '#formUser', function(e) {
            e.preventDefault();

            const form = $(this);
            const url = form.attr('action');

            $.ajax({
                url: url,
                type: 'POST', // forçar sempre POST
                data: form.serialize(),
                success: function(data) {
                    Swal.fire('Sucesso', data.message, 'success')
                        .then(() => location.reload());
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Erro ao salvar usuário';
                    Swal.fire('Erro!', msg, 'error');
                }
            });
        });
    }

    function showModal(url) {
        const modal = $('#modal');
        modal.find('.modal-content').html('<div class="text-center p-5">Carregando...</div>');
        modal.modal('show');

        $.get(url, function(response) {
            modal.find('.modal-content').html(response);
            bindUserForm(); // 🔥 Chama bind aqui após o conteúdo estar carregado
        }).fail(function() {
            Swal.fire('Erro!', 'Erro ao carregar o conteúdo.', 'error');
        });
    }

    $(document).ready(function() {
        initUserTable();

        $("#addNew").click(function() {
            showModal("{{ route('users.form') }}");
        });

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            showModal("{{ url('/users/form') }}/" + id);
        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const url = "{{ url('/users/delete') }}/" + id;

            Swal.fire({
                title: 'Atenção',
                text: "Você deseja excluir este usuário?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, { _token: "{{ csrf_token() }}" }, function(data) {
                        Swal.fire('Sucesso', data.message, 'success')
                            .then(() => location.reload());
                    }).fail(function(xhr) {
                        let msg = xhr.responseJSON?.message || 'Erro ao remover registro';
                        Swal.fire('Erro!', msg, 'error');
                    });
                }
            });
        });
    });
</script>
@endsection
