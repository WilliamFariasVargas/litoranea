@extends('layouts.pages')

@section('page-content')
<section class="container">
    <div class="row" style="padding-top:60px;">
        <div class="col-8">
            <h4 style="color:#003162;" class="title mt-2"><i class="fa fa-user mx-2"></i>Gerenciamento de Usuários</h4>
        </div>
        <div class="col-4 text-end">
            <button style="background-color:#003162;" class="btn btn-primary" id="addNew"><i class="fa fa-plus mx-2"></i>Novo</button>
        </div>
        <br><br><hr>
    </div>
</section>


<section class="col-md-12 mt-2 container-fluid" id="divTable">

</section>
<script>
    $(document).ready(function() {
        $('#table-users').DataTable({ ... });

        // Novo usuário
        $("#addNew").click(function(){
            showModal("{{ route('users.form') }}");
        });

        // Editar usuário
        $(".btn-edit").click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            showModal("{{ url('/users/form') }}/" + id); // monta na hora
        });

        // Excluir
        $(".btn-delete").click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Atenção',
                text: "Deseja excluir este usuário?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ url('/users/delete') }}/" + id, { _token: "{{ csrf_token() }}" }, function(data) {
                        Swal.fire('Sucesso', data.message, 'success')
                            .then(() => location.reload());
                    }).fail(function(xhr) {
                        Swal.fire('Erro', 'Erro ao remover', 'error');
                    });
                }
            });
        });
    });
</script>

@endsection
