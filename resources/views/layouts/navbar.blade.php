<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <img style="height:50px;" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <!-- Menu à esquerda -->
        <ul style="padding-left:30px;" class="navbar-nav me-auto">
            <li class="nav-item dropdown">
                <a style="color:#003162!important;font-weight:600;"class="menutext nav-link dropdown-toggle" href="#" id="cadastroDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Usuário
                </a>

                <ul class="dropdown-menu" aria-labelledby="cadastroDropdown">
                <!-- Altere a rota abaixo para a rota que direciona para o cadastro de usuário -->
                <li><a class="dropdown-item" href="{{ route('main.usuarios') }}">Cadastrar</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a style="color:#003162!important;font-weight:600;"class="menutext nav-link dropdown-toggle" href="#" id="cadastroDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Cliente
                </a>

                <ul class="dropdown-menu" aria-labelledby="cadastroDropdown">
                <!-- Altere a rota abaixo para a rota que direciona para o cadastro de usuário -->
                <li><a class="dropdown-item" href="{{ route('main.clientes') }}">Cadastrar</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a style="color:#003162!important;font-weight:600;" class="nav-link dropdown-toggle" href="#" id="cadastroDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Fornecedores
                </a>

                <ul class="dropdown-menu" aria-labelledby="cadastroDropdown">
                    <!-- Altere a rota abaixo para a rota que direciona para o cadastro de usuário -->
                    <li><a class="dropdown-item" href="{{ route('main.fornecedores') }}">Cadastrar</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a style="color:#003162!important;font-weight:600;" class="nav-link dropdown-toggle" href="#" id="cadastroDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Transportadora
                </a>

                <ul class="dropdown-menu" aria-labelledby="cadastroDropdown">
                    <!-- Altere a rota abaixo para a rota que direciona para o cadastro de usuário -->
                    <li><a class="dropdown-item" href="{{ route('main.transportadoras') }}">Cadastrar</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a style="color:#003162!important;font-weight:600;" class="nav-link dropdown-toggle" href="#" id="cadastroDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Representada
                </a>

                <ul class="dropdown-menu" aria-labelledby="cadastroDropdown">
                    <!-- Altere a rota abaixo para a rota que direciona para o cadastro de usuário -->
                    <li><a class="dropdown-item" href="{{ route('main.representadas') }}">Cadastrar</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a style="color:#003162!important;font-weight:600;" class="nav-link dropdown-toggle" href="#" id="cadastroDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Pedidos
                </a>

                <ul class="dropdown-menu" aria-labelledby="cadastroDropdown">
                    <!-- Altere a rota abaixo para a rota que direciona para o cadastro de usuário -->
                    <li><a class="dropdown-item" href="{{ route('main.pedidos') }}">Novo Pedido</a></li>
                    <li><a class="dropdown-item" href="{{ route('main.pedidos') }}">Consultar Pedido</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a style="color:#003162!important;font-weight:600;" class="nav-link dropdown-toggle" href="#" id="cadastroDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Comissões
                </a>

                <ul class="dropdown-menu" aria-labelledby="cadastroDropdown">
                    <li><a class="dropdown-item" href="{{ route('main.comissoes') }}">Consultar Comissões</a></li>
                </ul>
            </li>
        </ul>
        <!-- Botão de Logout à direita -->
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-danger">Sair</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
