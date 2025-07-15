@extends('layouts.pages')

@section('page-content')
<div class="container py-5">
    <h3 class="mb-4">Galeria de Eventos</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.eventos.store') }}" method="POST" class="mb-5 row g-2">
        @csrf
        <div class="col-md-3">
            <input type="text" name="nome" class="form-control" placeholder="Nome do Evento" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="local" class="form-control" placeholder="Local" required>
        </div>
        <div class="col-md-2">
            <select name="mes" class="form-select" required>
                @foreach(['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'] as $m)
                    <option>{{ $m }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="ano" class="form-control" placeholder="Ano" required>
        </div>
        <div class="col-md-2 text-end">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Criar Evento</button>
        </div>
    </form>

    @foreach($eventos as $evento)
        <div class="card mb-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $evento->nome }} – {{ $evento->mes }}/{{ $evento->ano }}</strong><br>
                    <small>{{ $evento->local }}</small>
                </div>
                <form action="{{ route('admin.eventos.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('Deseja excluir este evento e todas as fotos?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-trash"></i> Excluir Evento
                    </button>
                </form>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.eventos.fotos.upload', $evento) }}" method="POST" enctype="multipart/form-data" class="mb-4 row g-2">
                    @csrf
                    <div class="col-md-10">
                        <input type="file" name="imagens[]" class="form-control" multiple required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fa fa-upload"></i> Enviar Fotos
                        </button>
                    </div>
                </form>

                <div class="row g-3">
                    @foreach($evento->fotos as $foto)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset('storage/' . $foto->imagem) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                <form action="{{ route('admin.eventos.fotos.destroy', $foto) }}" method="POST" class="text-center my-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Remover esta foto?')">
                                        <i class="fa fa-trash"></i> Remover
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
