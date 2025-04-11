@extends('layouts.pages')

@section('page-content')
<div class="container">
    <h1 class="mb-4">Pedidos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pedidos.create') }}" class="btn btn-primary mb-3">Novo Pedido</a>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Valor Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->numero_pedido }}</td>
                    <td>{{ $pedido->cliente->nome }}</td>
                    <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('pedidos.pdf', $pedido) }}" class="btn btn-sm btn-secondary" target="_blank">PDF</a>
                        <a href="{{ route('pedidos.imprimir', $pedido) }}" class="btn btn-sm btn-info" target="_blank">Imprimir</a>

                        <a href="{{ route('pedidos.whatsapp', $pedido) }}"
                           target="_blank"
                           class="btn btn-sm btn-success">
                            WhatsApp
                        </a>
                        <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" class="form-excluir d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-excluir">Excluir</button>
                        </form>


                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.form-excluir');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Impede o envio imediato

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá desfazer essa ação!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Agora sim envia o formulário
                    }
                });
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
