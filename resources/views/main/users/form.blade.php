<div class="modal-header bg-primary text-white">
    <h5 class="modal-title">{{ $user ? 'Editando: ' . $user->name : 'Cadastro de Usuário' }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
  </div>

  <div class="modal-body">
    <form id="formUser" method="POST" action="{{ $user ? route('users.update', $user->id) : route('users.store') }}">
      @csrf
      @if($user)
          @method('PUT')
      @endif

      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name ?? '' }}" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email ?? '' }}" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">
          {{ $user ? 'Senha (deixe em branco para manter)' : 'Senha' }}
        </label>
        <input type="password" name="password" class="form-control" {{ $user ? '' : 'required' }}>
      </div>

      <div class="mb-3">
        <label for="level" class="form-label">Nível</label>
        <select name="level" class="form-select" required>
          @foreach(\App\Models\User::$levels as $key => $label)
            <option value="{{ $key }}" {{ isset($user) && $user->level == $key ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-save"></i> Salvar
        </button>
      </div>
    </form>
  </div>

  <script>
      bindUserForm();
  </script>
