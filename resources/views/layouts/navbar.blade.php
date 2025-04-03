<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Minha Aplicação</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <!-- Menu à esquerda -->
        <ul class="navbar-nav me-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="cadastroDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Cadastro
            </a>
            <ul class="dropdown-menu" aria-labelledby="cadastroDropdown">
              <!-- Altere a rota abaixo para a rota que direciona para o cadastro de usuário -->
              <li><a class="dropdown-item" href="#">Cadastrar Usuário</a></li>
              <li><a class="dropdown-item" href="{{ route('main.fornecedores') }}">Cadastrar Fornecedor</a></li>
            </ul>
          </li>
        </ul>
        <!-- Botão de Logout à direita -->
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
