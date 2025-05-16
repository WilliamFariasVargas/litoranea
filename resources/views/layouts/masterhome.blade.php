
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Litoranea</title>

     <!-- JQUERY 3.7 -->
     <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

     <!-- BOOTSTRAP 5 -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

     <!-- SELECT 2 -->
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

     <!-- SWEETALERT-->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <!-- FONTAWESOME-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!--  CSS do DataTables -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

     <!-- jQuery e JavaScript do DataTables -->
     <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

     <!------ CSS login -------->
     <script src="{{asset('assets/css/login.css')}}?id={{rand()}}"></script>


     <script src="{{asset('assets/js/main.js')}}?id={{rand()}}"></script>
     <script src="{{asset('assets/js/modal.js')}}?id={{rand()}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="{{asset('assets/js/validators.js')}}?id={{rand()}}"></script>

</head>

<body>

    @include('layouts.layouthome')

    <div style="position: relative; background: url('{{ asset('assets/images/whitebg.jpg') }}') no-repeat center center; background-size: cover; min-height: 60vh; display: flex; align-items: center; justify-content: center;">

        <!-- Conteúdo acima da imagem -->
        <div class="container text-center position-relative" style="z-index: 2;">
            <img style="height:300px;" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            <br><br>
            <h3 class="text-dark">Seja bem-vindo!</h3>
        </div>
    </div>
    <section style="max-height:40vh;"class="container my-5">
        <h2 class="text-center mb-4">Nossos Parceiros</h2>

        <div class="logos-carousel overflow-hidden">
          <div class="logos-track d-flex">
            <div class="logo-item"><img src="assets/images/logos/1.png" class="img-fluid" alt="Logo 1"></div>
            <div class="logo-item"><img src="assets/images/logos/2.png" class="img-fluid" alt="Logo 2"></div>
            <div class="logo-item"><img src="assets/images/logos/3.png" class="img-fluid" alt="Logo 3"></div>
            <div class="logo-item"><img src="assets/images/logos/4.png" class="img-fluid" alt="Logo 4"></div>
            <div class="logo-item"><img src="assets/images/logos/5.png" class="img-fluid" alt="Logo 5"></div>
            <div class="logo-item"><img src="assets/images/logos/6.png" class="img-fluid" alt="Logo 6"></div>
            <div class="logo-item"><img src="assets/images/logos/7.png" class="img-fluid" alt="Logo 7"></div>
            <div class="logo-item"><img src="assets/images/logos/8.png" class="img-fluid" alt="Logo 8"></div>
            <div class="logo-item"><img src="assets/images/logos/9.png" class="img-fluid" alt="Logo 9"></div>
            <div class="logo-item"><img src="assets/images/logos/10.png" class="img-fluid" alt="Logo 10"></div>
            <!-- DUPLICAÇÃO para looping infinito -->
            <div class="logo-item"><img src="assets/images/logos/1.png" class="img-fluid" alt="Logo 1"></div>
            <div class="logo-item"><img src="assets/images/logos/2.png" class="img-fluid" alt="Logo 2"></div>
          </div>
        </div>
      </section>



    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">

                <!-- Card 1 -->
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm border-0 p-4">
                        <h2><span>+</span><span class="counter" data-target="160">0</span></h2>
                        <p class="mt-2 mb-0">Clientes</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm border-0 p-4">
                        <h2><span>+</span><span class="counter" data-target="45">0</span></h2>
                        <p class="mt-2 mb-0">Anos de experiência</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm border-0 p-4">
                        <h2><span>+</span><span class="counter" data-target="11">0</span></h2>
                        <p class="mt-2 mb-0">Parceiros</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm border-0 p-4">
                        <h2><span>+</span><span class="counter" data-target="3">0</span></h2>
                        <p class="mt-2 mb-0">Estados atendidos</p>
                    </div>
                </div>

            </div>
        </div>
    </section>





      <style>
        .logos-carousel {
          position: relative;
          width: 100%;
          height: 150px; /* estava 120px, agora mais alto */
          overflow: hidden;
        }

        .logos-track {
          display: flex;
          width: calc(250px * 13); /* largura logo * quantidade */
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
          max-height: 200px; /* limite para as logos não ficarem gigantes */
          object-fit: contain;
        }

        @keyframes scroll {
          0% { transform: translateX(0); }
          100% { transform: translateX(calc(-250px * 2)); }
        }
        </style>





    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Coluna da imagem -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('assets/images/foto.png') }}" alt="Sobre a Litorânea" class="img-fluid rounded">
                </div>

                <!-- Coluna do texto -->
                <div class="col-md-6">
                    <h2 class="text-center">Sobre a Litorânea</h2><br>
                    <p>Antônio Carlos de Moura Dill, natural de Lages (SC), deu início à sua trajetória empreendedora ao fundar, em 1979, a Litorânea Representações Comerciais Ltda, após se estabelecer no município de São José. Com espírito visionário, começou sua atuação focado no setor de autopeças, abrindo portas e construindo relacionamentos sólidos com empresas do segmento.</p>

                    <p>Com o passar dos anos, a Litorânea se consolidou como uma das principais representantes comerciais do Sul do Brasil. A expertise adquirida ao longo de décadas permitiu a ampliação da rede de parcerias e o fortalecimento da presença da empresa em diversos estados da região.</p>

                    <p>Atualmente, a Litorânea atende mais de 160 clientes ativos, entre distribuidores e grandes redes varejistas especializadas em peças para colisão automotiva — abrangendo veículos leves e pesados, além de acessórios automotivos. Seu portfólio é reconhecido pela qualidade e pela confiabilidade das marcas representadas.</p>

                    <p>A empresa se destaca pelo atendimento consultivo e personalizado, oferecendo suporte presencial e remoto conforme as necessidades de cada cliente. Essa proximidade proporciona agilidade nas negociações, melhor entendimento das demandas do mercado e construção de parcerias duradouras.</p>

                    <p>Com mais de quatro décadas de história, a Litorânea mantém o compromisso com a excelência, a ética e a inovação no setor de autopeças. Sua trajetória é marcada pela confiança, pelo profissionalismo e pelo constante aperfeiçoamento, sempre guiada pelo propósito de gerar valor e resultado para todos os envolvidos.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5 text-center">
        <h2 class="mb-4">Fale comigo</h2>

        <a href="https://wa.me/5548999934493" target="_blank" class="btn btn-success btn-lg px-5 py-3">
            Clique aqui para falar no WhatsApp
        </a>
    </section>




<!-- Script para animar os números -->
<script>
    const counters = document.querySelectorAll('.counter');
    const speed = 200; // menor = mais rápido, maior = mais lento

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








    </div>



    <!-- Modal global -->
<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Conteúdo será carregado via JS -->
      </div>
    </div>
  </div>


</body>
</html>
