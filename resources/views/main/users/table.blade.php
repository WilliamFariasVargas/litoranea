<style>
    .table thead th {
        white-space: nowrap;
    }
</style>

<div class="d-none d-lg-block" style="padding-top:30px;">
    <table class="table" id="table-users">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nível</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \App\Models\User::$levels[$user->level] ?? 'Desconhecido' }}</td>
                    <td class="text-center" style="white-space: nowrap">
                        <button class="btn btn-sm btn-success btn-edit" data-id="{{ $user->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Cards responsivos para mobile -->
<div class="d-lg-none">
    @foreach ($users as $user)
        <div class="card mb-3 shadow-sm border-secondary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">{{ $user->name }}</h6>
                <div>
                    <button class="btn btn-sm btn-success btn-edit me-2" data-id="{{ $user->id }}">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p><b>Email:</b> {{ $user->email }}</p>
                <p><b>Nível:</b> {{ \App\Models\User::$levels[$user->level] ?? 'Desconhecido' }}</p>
            </div>
        </div>
    @endforeach
</div>

<script>

    $(document).ready(function() {
        $('#table-users').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $(".btn-edit").click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url = "{{ route('users.form') }}/" + id;
            showModal(url);
        });

        $(".btn-delete").click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url = "{{ url('/users/delete') }}/" + id;

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
