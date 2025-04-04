@extends('layouts.modal')

@php
    $title = "Cadastro de Usuários";
    if ($user != null) { $title = "Editando: " . $user->name; }
@endphp

@section('modal_title') {{ $title }} @endsection

@section('modal_content')

<form id="formUser" method="POST" action="{{ $user ? route('users.update', $user->id) : route('users.store') }}">
    @csrf
    ...
</form>

<script>
    $('#formUser').submit(function(e){
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');

        $.post(url, form.serialize(), function(data){
            Swal.fire('Sucesso', data.message, 'success')
                .then(() => location.reload());
        }).fail(function(xhr){
            Swal.fire('Erro', 'Erro ao salvar', 'error');
        });
    });
</script>

@endsection
