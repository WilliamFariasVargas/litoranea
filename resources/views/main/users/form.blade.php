@extends('layouts.modal')

@php
    $title = $user ? "Editando: " . $user->name : "Cadastro de Usuários";
@endphp

@section('modal_title')
    {{ $title }}
@endsection

@section('modal_content')
<form id="formUser" method="POST" action="{{ $user ? route('users.update', $user->id) : route('users.store') }}">
    @csrf
    @if($user)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">
            Senha {{ $user ? '(deixe em branco para manter)' : '' }}
        </label>
        <input type="password" name="password" id="password" class="form-control" {{ $user ? '' : 'required' }}>
    </div>

    <div class="mb-3">
        <label for="level" class="form-label">Nível</label>
        <select name="level" id="level" class="form-select">
            @foreach(\App\Models\User::$levels as $key => $label)
                <option value="{{ $key }}" {{ isset($user) && $user->level == $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Salvar
        </button>
    </div>
</form>
@endsection
