@extends('layouts.app')

@section('title', __('Início'))

@section('content')
<div class="hero-wrap js-fullheight background-01" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-10 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                <h2 class="subheading" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Escritório Modelo de Assistência Jurídica – EMAJ</h2>
                <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                    <span>Assistência jurídica</span> <span>gratuita à</span> <span>população hipossuficiente</span>
                </h1>
                <p>
                    <a class="btn btn-primary py-3 px-4 disabled" data-placement="bottom" data-toggle="tooltip" title="Não disponível">Fazer um agendamento</a>
                </p>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-no-pb services-section">
    <div class="container">
        <div class="row no-gutters d-flex">
            <div class="col-md-3 text-center services align-self-stretch ftco-animate p-4">
                <div class="icon"><span class="flaticon-auction"></span></div>
                <div class="media-body">
                    <h3 class="heading mb-3"><a href="#">Cumprimento de Sentença</a></h3>
                    <p>É o procedimento utilizado para concretizar o que foi determinado pelo juiz na sentença.</p>
                </div>
            </div>
            <div class="col-md-3 text-center services align-self-stretch ftco-animate p-4">
                <div class="icon"><span class="flaticon-money"></span></div>
                <div class="media-body">
                    <h3 class="heading mb-3"><a href="#">Inventário</a></h3>
                    <p>É o processo pelo qual se faz um levantamento de todos os bens de determinada pessoa após sua morte.</p>
                </div>
            </div>
            <div class="col-md-3 text-center services align-self-stretch ftco-animate p-4">
                <div class="icon"><span class="flaticon-family"></span></div>
                <div class="media-body">
                    <h3 class="heading mb-3"><a href="#">Investigação de Paternidade</a></h3>
                    <p>Se ao realizar um registro de nascimento, a pessoa indicada pela mãe como suposto pai se nega a efetuar o reconhecimento da criança, inicia-se o processo investigativo de tal situação.</p>
                </div>
            </div>
            <div class="col-md-3 text-center services align-self-stretch ftco-animate p-4">
                <div class="icon"><span class="ion-ios-help-circle-outline"></span></div>
                <div class="media-body">
                    <h3 class="heading mb-3"><a href="#">Consulta Jurídica</a></h3>
                    <p>Consiste no esclarecimento técnico sobre o direito aplicável a questões ou casos concretos nos quais avultem interesses pessoais legítimos ou direitos próprios lesados ou ameaçados de lesão, apreciando da existência ou não de fundamento legal para a pretensão do utente.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-counter" id="section-counter">
    <div class="container-fluid">
        <div class="row d-flex">
            <div class="col-md-6 d-flex">
                <div class="img d-flex align-self-stretch align-items-center justify-content-center background-02">
                </div>
            </div>
            <div class="col-md-6 px-5 py-5">
                <div class="row justify-content-start pt-3 pb-3">
                    <div class="col-md-12 heading-section ftco-animate">
                        <span class="subheading">Alguns fatos</span>
                        <h2 class="mb-4">EMAJ, do Curso de Direito da UNIPLAC, de Lages (SC), foi instalado em 11 de agosto de 1988.</h2>
                        <p>Para prestar sua atividade precípua que é proporcionar o estágio profissionalizante, inicialmente aos alunos das quatro últimas fases, tendo outra finalidade de cunho social: a de prestar assistência jurídica gratuita à população carente.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center py-4 bg-light mb-4">
                            <div class="text">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="fa fa-graduation-cap"></span>
                                </div>
                                <strong class="number" data-number="{{ $estatistica['alunos'] }}">0</strong>
                                <span>Acadêmicos</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center py-4 bg-light mb-4">
                            <div class="text">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="fa fa-gavel"></span>
                                </div>
                                <strong class="number" data-number="{{ $estatistica['tipoDemandasAtendidas'] }}">0</strong>
                                <span>Tipo de Demandas Atendidas</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center py-4 bg-light mb-4">
                            <div class="text">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="fa fa-users"></span>
                                </div>
                                <strong class="number" data-number="{{ $estatistica['clientes'] }}">0</strong>
                                <span>Clientes</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center py-4 bg-light mb-4">
                            <div class="text">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="fa fa-user-plus"></span>
                                </div>
                                <strong class="number" data-number="{{ $estatistica['atendimentosMes'] }}">0</strong>
                                <span>Atendimentos Mês</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Áreas de Atuação</span>
                <h2 class="mb-4">Algumas Áreas de Atuação</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-3 col-lg-2 text-center">
                <div class="practice-area ftco-animate">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-family"></span>
                    </div>
                    <h3><a href="#">Investigação de Paternidade</a></h3>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 text-center">
                <div class="practice-area ftco-animate">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-auction"></span>
                    </div>
                    <h3><a href="#">Embargos à Execução Fiscal</a></h3>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 text-center">
                <div class="practice-area ftco-animate">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-shield"></span>
                    </div>
                    <h3><a href="#">Defesa em Medida Protetiva</a></h3>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 text-center">
                <div class="practice-area ftco-animate">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-handcuffs"></span>
                    </div>
                    <h3><a href="#">Cumprimento de Sentença</a></h3>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 text-center">
                <div class="practice-area ftco-animate">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-house"></span>
                    </div>
                    <h3><a href="#">Inventário</a></h3>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 text-center">
                <div class="practice-area ftco-animate">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-employee"></span>
                    </div>
                    <h3><a href="#">Previdenciária</a></h3>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection

@section('stylesheet')
<style>
    .disabled{
        pointer-events: auto !important;
        cursor: not-allowed;
    }
</style>
@endsection