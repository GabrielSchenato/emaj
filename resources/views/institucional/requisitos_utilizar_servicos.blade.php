@extends('layouts.app')

@section('title', __('Como Funciona - Outras Informações - Requisitos para Utilizar os Serviços'))

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Requisitos para Utilizar os Serviços</h1>
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
                        Requisitos para Utilizar os Serviços
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-counter" id="section-counter">
    <div class="container-fluid">
        <div class="row d-flex">
            <div class="col-md-6 d-flex">
                <div class="img d-flex align-self-stretch align-items-center justify-content-center" style="background-image:url(/images/martelo_livro.jpg);">
                </div>
            </div>
            <div class="col-md-6 px-5 py-5">
                <div class="row justify-content-start pt-3 pb-3">
                    <div class="col-md-12 heading-section ftco-animate">
                        <h2 class="mb-4">O que você deve saber</h2>
                        <p>Algumas informações são necessárias no momento do seu cadastro na plataforma do EMAJ e para prosseguir seu atendimento, algumas delas são:</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center py-4 bg-light mb-4">
                            <div class="text">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-money"></span>
                                </div>
                                <span>Sua renda mensal e a da família</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center py-4 bg-light mb-4">
                            <div class="text">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-house"></span>
                                </div>
                                <span>Se possui outros bens</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center py-4 bg-light mb-4">
                            <div class="text">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="ion-ios-car"></span>
                                </div>
                                <span>Se possui dívidas</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center py-4 bg-light mb-4">
                            <div class="text">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-medicine"></span>
                                </div>
                                <span>Se possui despesas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
