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
                <a href="#" class="block-20" style="background-image: url('images/si_uniplac_emaj.png');">
                </a>
                <div class="text p-4 float-right d-block">
                    <div class="topper d-flex align-items-center">
                        <div class="one py-2 pl-3 pr-1 align-self-stretch">
                            <span class="day">04</span>
                        </div>
                        <div class="two pl-0 pr-3 py-2 align-self-stretch">
                            <span class="yr">2019</span>
                            <span class="mos">Outubro</span>
                        </div>
                    </div>
                    <h3 class="heading mt-2"><a href="#">A plataforma do Escritório Modelo de Assistência Jurídica – EMAJ</a></h3>
                    <p>
                        Desenvolvida pelo acadêmico <i><b>Gabriel Silva Schenato</b></i> do curso de Sistemas de Informação para o trabalho de conclusão de curso,
                        jutamente com a parceria do Escritório Modelo de Assistência Jurídica da Uniplac.
                        </br>
                        A plataforma visa facilitar o trabalho e evitar o retrabalho dos professores orietadores e secretárias que 
                        atendem à população hipossuficiente.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
