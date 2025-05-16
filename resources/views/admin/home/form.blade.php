@extends('layouts.pages')

@section('page-content')
<div class="container py-5">
    <h3 class="mb-4">Editar Conteúdo da Home</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-4">
            <div class="col-md-6">
                <label for="logo">Logo (300px):</label>
                <input type="file" name="logo" class="form-control">
                @if($conteudo->logo)
                    <img src="{{ asset('storage/'.$conteudo->logo) }}" alt="Logo" class="img-fluid mt-2" style="max-height: 100px;">
                @endif
            </div>
            <div class="col-md-6">
                <label for="foto_sobre">Foto "Sobre" (imagem lateral):</label>
                <input type="file" name="foto_sobre" class="form-control">
                @if($conteudo->foto_sobre)
                    <img src="{{ asset('storage/'.$conteudo->foto_sobre) }}" alt="Foto Sobre" class="img-fluid mt-2" style="max-height: 100px;">
                @endif
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <label for="clientes">Clientes:</label>
                <input type="number" name="clientes" class="form-control" value="{{ old('clientes', $conteudo->clientes) }}">
            </div>
            <div class="col-md-3">
                <label for="anos_experiencia">Anos de Experiência:</label>
                <input type="number" name="anos_experiencia" class="form-control" value="{{ old('anos_experiencia', $conteudo->anos_experiencia) }}">
            </div>
            <div class="col-md-3">
                <label for="parceiros">Parceiros:</label>
                <input type="number" name="parceiros" class="form-control" value="{{ old('parceiros', $conteudo->parceiros) }}">
            </div>
            <div class="col-md-3">
                <label for="estados_atendidos">Estados Atendidos:</label>
                <input type="number" name="estados_atendidos" class="form-control" value="{{ old('estados_atendidos', $conteudo->estados_atendidos) }}">
            </div>
        </div>

        <div class="mb-4">
            <label for="sobre">Texto "Sobre a Litorânea":</label>
            <textarea name="sobre" rows="8" class="form-control">{{ old('sobre', $conteudo->sobre) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="whatsapp">Link do WhatsApp:</label>
            <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $conteudo->whatsapp) }}" placeholder="https://wa.me/55...">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Salvar
            </button>
        </div>
    </form>
</div>
@endsection
