@extends('layouts.app')

@section('title', __('Como Funciona - Outras Informações'))

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Outras Informações</h1>
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
                        Outras Informações
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <h2 class="mb-4">O que você gostaria de saber mais?</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-3 col-lg-2 text-center">
                <a href="{{ route('institucional.sobre_emaj') }}">
                    <div class="practice-area ftco-animate">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="oi oi-info"></span>
                        </div>
                        <h3>Sobre o EMAJ</h3>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-lg-2 text-center">
                <a href="{{ route('institucional.requisitos_utilizar_servicos') }}">
                    <div class="practice-area ftco-animate">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="oi oi-document"></span>
                        </div>
                        <h3>Requisitos para Utilizar os Serviços</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
