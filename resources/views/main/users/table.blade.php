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

