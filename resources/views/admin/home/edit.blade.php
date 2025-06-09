@extends('layouts.pages')

@section('page-content')
<div class="container py-5">
    <h3 class="mb-4">Editar Conteúdo da Home</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-4">
            <div class="col-md-6">
                <label for="logo">Logo (300px):</label>
                <input type="file" name="logo" class="form-control" id="logo_input" accept="image/*">

                <div class="mt-2">
                    <label class="form-label d-block">Visualização:</label>
                    <img id="logo_preview"
                        src="{{ $conteudo->logo ? asset('storage/' . $conteudo->logo) : '' }}"
                        alt="Logo Preview"
                        class="img-thumbnail"
                        style="max-height: 100px; {{ $conteudo->logo ? '' : 'display: none;' }}">
                </div>
            </div>

            <div class="col-md-6">
                <label for="foto_sobre">Foto "Sobre" (imagem lateral):</label>
                <input type="file" name="foto_sobre" class="form-control" id="foto_sobre_input" accept="image/*">

                <div class="mt-2">
                    <label class="form-label d-block">Visualização:</label>
                    <img id="foto_sobre_preview"
                        src="{{ $conteudo->foto_sobre ? asset('storage/' . $conteudo->foto_sobre) : '' }}"
                        alt="Preview"
                        class="img-thumbnail"
                        style="max-height: 150px; {{ $conteudo->foto_sobre ? '' : 'display: none;' }}">
                </div>
            </div>

        </div>

        <div class="row mb-4">
            <div class="col-md">
                <label for="clientes">Clientes:</label>
                <input type="text" name="clientes" class="form-control" value="{{ old('clientes', $conteudo->clientes) }}">
            </div>
            <div class="col-md">
                <label for="anos_experiencia">Anos de Experiência:</label>
                <input type="text" name="anos_experiencia" class="form-control" value="{{ old('anos_experiencia', $conteudo->anos_experiencia) }}">
            </div>
            <div class="col-md">
                <label for="parceiros">Parceiros:</label>
                <input type="text" name="parceiros" class="form-control" value="{{ old('parceiros', $conteudo->parceiros) }}">
            </div>
            <div class="col-md">
                <label for="estados">Estados Atendidos:</label>
                <input type="text" name="estados" class="form-control" value="{{ old('estados', $conteudo->estados) }}">
            </div>
            <div class="col-md">
                <label for="eventos">Número de Eventos:</label>
                <input type="text" name="eventos" class="form-control" value="{{ old('eventos', $conteudo->eventos) }}">
            </div>
        </div>

        <div class="mb-4">
            <label for="texto_sobre">Texto "Sobre a Litorânea":</label>
            <textarea name="texto_sobre" rows="8" class="form-control">{{ old('texto_sobre', $conteudo->texto_sobre) }}</textarea>
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

<script>
    function previewImage(inputId, imgId) {
        const input = document.getElementById(inputId);
        const img = document.getElementById(imgId);

        input.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    img.src = e.target.result;
                    img.style.display = 'block';
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    previewImage('foto_sobre_input', 'foto_sobre_preview');
    previewImage('logo_input', 'logo_preview');
</script>

@endsection

