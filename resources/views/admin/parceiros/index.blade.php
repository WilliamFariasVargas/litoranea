@extends('layouts.pages')

@section('page-content')
<div class="container py-5">
    <h3 class="mb-4">Galeria de Logos de Parceiros</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.parceiros.logos.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <input type="file" name="imagem" class="form-control" required>
            </div>
            <div class="col-md-4 text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-upload"></i> Enviar Logo
                </button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse($logos as $logo)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $logo->imagem) }}" class="card-img-top" alt="Logo" style="height: 150px; object-fit: contain;">
                    <form action="{{ route('admin.parceiros.logos.destroy', $logo->id) }}" method="POST" class="text-center my-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Remover este logo?')">
                            <i class="fa fa-trash"></i> Remover
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-muted">Nenhum logo adicionado ainda.</p>
        @endforelse
    </div>
</div>
@endsection
