@extends('layouts.pages')

@section('page-content')
<div style="position: relative; background: url('{{ asset('assets/images/whitebg.jpg') }}') no-repeat center center; background-size: cover; min-height: 60vh; display: flex; align-items: center; justify-content: center;">
    <div class="container text-center position-relative" style="z-index: 2;">
        <img style="height:300px;" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
        <br><br>
        <h3 class="text-dark">Seja bem-vindo!</h3>
    </div>
</div>

<section style="max-height:40vh;" class="container my-5">
    <h2 class="text-center mb-4">Nossos Parceiros</h2>
    @if($logosParceiros->count())
        <div class="logos-carousel overflow-hidden">
            <div class="logos-track d-flex">
                @foreach($logosParceiros as $logo)
                    <div class="logo-item">
                        <img src="{{ asset('storage/' . $logo->imagem) }}" class="img-fluid" alt="Logo Parceiro">
                    </div>
                @endforeach
                @foreach($logosParceiros as $logo)
                    <div class="logo-item">
                        <img src="{{ asset('storage/' . $logo->imagem) }}" class="img-fluid" alt="Logo Parceiro">
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-muted text-center">Nenhum logo de parceiro cadastrado no momento.</p>
    @endif
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 p-4">
                    <h2><span>+</span><span class="counter" data-target="{{ $conteudo->clientes ?? 0 }}">0</span></h2>
                    <p class="mt-2 mb-0">Clientes</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 p-4">
                    <h2><span>+</span><span class="counter" data-target="{{ $conteudo->anos_experiencia ?? 0 }}">0</span></h2>
                    <p class="mt-2 mb-0">Anos de experiência</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 p-4">
                    <h2><span>+</span><span class="counter" data-target="{{ $conteudo->parceiros ?? 0 }}">0</span></h2>
                    <p class="mt-2 mb-0">Parceiros</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 p-4">
                    <h2><span>+</span><span class="counter" data-target="{{ $conteudo->estados ?? 0 }}">0</span></h2>
                    <p class="mt-2 mb-0">Estados atendidos</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset($conteudo->foto_sobre ? 'storage/' . $conteudo->foto_sobre : 'assets/images/foto.png') }}" alt="Sobre a Litorânea" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h2 class="text-center">Sobre a Litorânea</h2><br>
                <p>{!! nl2br(e($conteudo->texto_sobre ?? 'Conteúdo ainda não adicionado.')) !!}</p>
            </div>
        </div>
    </div>
</section>

<section class="container my-5 text-center">
    <h2 class="mb-4">Fale comigo</h2>
    @if($conteudo->whatsapp)
        <a href="{{ $conteudo->whatsapp }}" target="_blank" class="btn btn-success btn-lg px-5 py-3">
            Clique aqui para falar no WhatsApp
        </a>
    @endif
</section>

<style>
    .logos-carousel {
        position: relative;
        width: 100%;
        height: 150px;
        overflow: hidden;
    }
    .logos-track {
        display: flex;
        width: max-content;
        animation: scroll 10s linear infinite;
    }
    .logo-item {
        width: 250px;
        flex-shrink: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .logo-item img {
        max-height: 200px;
        object-fit: contain;
    }
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-250px * {{ $logosParceiros->count() }})); }
    }
</style>

<script>
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    counters.forEach(counter => {
        const animate = () => {
            const value = +counter.getAttribute('data-target');
            const data = +counter.innerText;
            const increment = value / speed;
            if (data < value) {
                counter.innerText = Math.ceil(data + increment);
                setTimeout(animate, 20);
            } else {
                counter.innerText = value;
            }
        };
        animate();
    });
</script>
@endsection
