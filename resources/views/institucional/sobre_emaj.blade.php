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

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <iframe width="1280" height="720" src="https://www.youtube.com/embed/4GSAeH6XJr8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</section>

@endsection
