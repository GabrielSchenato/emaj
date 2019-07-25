@extends('layouts.app')

@section('title', __('Como Funciona - Outras Informações - Sobre o EMAJ'))

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Sobre o EMAJ</h1>
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('institucional.home') }}">
                            Início 
                            <i class="ion-ios-arrow-forward"></i>
                        </a>
                    </span>
                    <span>
                        <a href="{{ route('institucional.como_funciona') }}">
                            Como Funciona 
                            <i class="ion-ios-arrow-forward"></i>
                        </a>
                    </span>
                    <span>
                        <a href="{{ route('institucional.outras_informacoes') }}">
                            Outras Informações
                            <i class="ion-ios-arrow-forward"></i>
                        </a>
                    </span>
                    <span>
                        Sobre o EMAJ
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1 order-md-last ftco-animate">
                <p>
                    <img src="/images/practice-1.jpg" alt="" class="img-fluid">
                </p>
                <h2 class="mb-3">Escritório Modelo de Assistência Jurídica – EMAJ</h2>
                <p>
                    A sua primeira função é pedagógica, pois nele são desenvolvidas as disciplinas de Estágio II (8ª fase do curso de Direito),
                    Estágio III (9ª fase) e Estágio IV (10ª fase). Trata-se de um espaço pedagógico, servindo de campo de estágio obrigatório e
                    supervisionado no curso, assim como proporciona acesso à Justiça a população hipossuficiente de Lages e região.
                </p>
                <p>
                    Os acadêmicos desenvolvem suas atividades práticas que englobam desde o primeiro atendimento com os clientes até a prestação
                    jurisdicional efetiva. Os estagiários não só ganham experiência como aprendem muito no estágio sobre a prática profissional, ética
                    e peticionamento assim como são inseridos na sociedade em que vivem.                    
                </p>

                <h2 class="mb-3 mt-5">Histórico</h2>
                <p>
                    Em 11 de agosto de 1988 o Escritório Modelo de Assistência Jurídica – EMAJ, do Curso de Direito da UNIPLAC, de Lages (SC), foi instalado,
                    para prestar sua atividade precípua que é proporcionar o estágio profissionalizante, inicialmente aos alunos das quatro últimas fases, tendo
                    outra finalidade de cunho social: a de prestar assistência jurídica gratuita à população carente.
                </p>
                <p>
                    Para que o EMAJ fosse instalado vários esforços foram empreendidos das seguintes instituições e órgãos: Prefeituras Municipais de Lages (SC),
                    Correia Pinto (SC) e Otacílio Costa (SC), estas duas últimas, na época ainda não eram comarca e pertenciam à comarca de Lages, Manville produtos Florestais,
                    Clube de Diretores Lojistas de Lages e Maval- Equipamentos para Escritório Ltda.                    
                </p>
                <p>
                    <img src="/images/professores_orientadores.jpg" alt="" class="img-fluid">
                </p>
                <p class="font-italic">
                    Na imagem de destaque estão os professores orientadores do EMAJ (em 2013) Profa. Ana Mirian, Profa. Sirlane, Profa. Aline e Prof.
                    Tomaz com o pioneiro do Escritório Modelo, Dr. Cassiano (ao centro).
                </p>

            </div>
        </div>
    </div>
</section>

@endsection
