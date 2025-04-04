@extends('layouts.modal')

@php
    $title = "Cadastro de Usuários";
    if ($usuario != null) { $title = "Editando: " . $usuario->nome; }
@endphp

@section('modal_title') {{ $title }} @endsection

@section('modal_content')
<form id="create_edit" method="POST">
    @csrf
    <div class="row">
        <!-- Nome -->
        <div class="col-md-6 form-group mt-2">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $usuario != null ? $usuario->nome : '' }}" required>
        </div>
        <!-- E-mail -->
        <div class="col-md-6 form-group mt-2">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $usuario != null ? $usuario->email : '' }}" required>
        </div>
        <!-- Senha -->
        <div class="col-md-6 form-group mt-2">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" {{ $usuario == null ? 'required' : '' }}>
        </div>
        <!-- Perfil -->
        <div class="col-md-6 form-group mt-2">
            <label for="perfil">Perfil:</label>
            <input type="text" name="perfil" id="perfil" class="form-control" value="{{ $usuario != null ? $usuario->perfil : '' }}" required>
        </div>
    </div>
</form>
<script>
@if($usuario != null)
    var url_post = "{{ route('usuarios.update', $usuario->id) }}";
@else
    var url_post = "{{ route('usuarios.store') }}";
@endif
$(document).ready(function() {
    $('#create_edit').on('keydown', function (e) { if (e.key === 'Enter') { e.preventDefault(); } });
    $('#create_edit').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: url_post, type: 'POST', data: formData,
            success: function(data) {
                Swal.fire({ title: 'Sucesso!', text: data.message, icon: 'success', confirmButtonText: 'OK' })
                .then(function(){ tblPopulate(); });
                $("#closeModal").trigger('click');
            },
            error: function(xhr) {
                var errorMessage = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Erro ao registrar usuário';
                Swal.fire({ title: 'Erro!', text: errorMessage, icon: 'error', confirmButtonText: 'OK' });
            }
        });
    });
});
</script>
@endsection
