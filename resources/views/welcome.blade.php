

<body>
@include('layouts.masterhome')

@section('content')
<div class="container">
    <div class="row justify-content-center">

            <h1>Seja bem-vindo!</h1>
            <p>Nosso sistema de gestão comercial</p>
            <a href="{{ route('login') }}" class="btn btn-primary mt-4">Entrar</a>
    </div>
</div>

@endsection

