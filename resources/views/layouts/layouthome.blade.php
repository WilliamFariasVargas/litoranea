<style>
    html, body {
        margin: 0;
        padding: 0;
    }
</style>


<nav class="navbar no-print navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <img style="height:50px;" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-primary">Entrar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>