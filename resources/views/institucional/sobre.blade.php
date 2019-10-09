@extends('layouts.app')

@section('title', __('Sobre'))

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Sobre</h1>
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('institucional.home') }}">
                            Início 
                            <i class="ion-ios-arrow-forward"></i>
                        </a>
                    </span>
                    <span>
                        Sobre 
                        <i class="ion-ios-arrow-forward"></i>
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light ftco-animate">
    <div class="container">
        <div class="col-md-8 container">
            <div class="blog-entry">
                <a href="" onclick="return false;" class="block-20" style="background-image: url('images/si_uniplac_emaj.png');">
                </a>
                <div class="text p-4 float-right d-block">
                    <h3 class="heading mt-2"><a href="#">A plataforma do Escritório Modelo de Assistência Jurídica – EMAJ</a></h3>
                    <p>
                        Desenvolvida pelo acadêmico <i><b>Gabriel Silva Schenato</b></i> do curso de Sistemas de Informação para o trabalho de conclusão de curso no ano de 2019,
                        juntamente com a parceria do Escritório Modelo de Assistência Jurídica da Uniplac.
                        </br>
                        A plataforma visa facilitar o trabalho e evitar o retrabalho dos professores orietadores e secretárias que 
                        atendem à população hipossuficiente da região.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
