@extends('layouts.app')

@section('title', __('Como Funciona - Simular Triagem'))

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Simular Triagem</h1>
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
                        Simular Triagem
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-consultation">
    <div class="container-fluid">
        <div class="row d-md-flex">
            <div class="half order-md-last mt-md-0 d-flex justify-content-center align-items-center img" style="background-image: url(/images/bg_1.jpg);">
                <div class="overlay"></div>
                <div class="desc text-center">
                    <div class="icon" id="icone">
                        
                    </div>
                    <h1>
                        <a href="#" onclick="return false;">
                            <span id="mensagem" style="font-size: 28px;">Seu resultado aparecerá aqui...</span>
                        </a>
                    </h1>
                </div>
            </div>
            <div class="half p-3 p-md-5 ftco-animate">
                <h3 class="mb-4">Por favor, insira as informações necessárias</h3>
                <form id="dadostriagem">

                    <label for="renda">Sua renda</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" class="form-control" id="renda" name="renda" placeholder="" required="">
                    </div>

                    <label for="dividas">Somatória de dívidas por mês</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" class="form-control" id="dividas" name="dividas" placeholder="" required="">
                    </div>

                    <label for="despesas">Somatória de despesas por mês</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" class="form-control" id="despesas" name="despesas" placeholder="" required="">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-outline-secondary btn-lg btn-block">Simular Triagem <i class="ion-ios-done-all"></i></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('javascript')
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>  
<script>

$(function () {
    $('#renda').mask('#.##0,00', {reverse: true});
    $('#dividas').mask('#.##0,00', {reverse: true});
    $('#despesas').mask('#.##0,00', {reverse: true});

    $("#dadostriagem").submit(function (event) {
        var renda = converteMoedaFloat($('#renda').val());
        var dividas = converteMoedaFloat($('#dividas').val());
        var despesas = converteMoedaFloat($('#despesas').val());

        var rendaSobraDivida = renda - dividas;
        var rendaSobraDespesas = renda - despesas;

        if (rendaSobraDivida < 1000 || rendaSobraDespesas < 1000) {
            $("#icone").html(`<span class="flaticon-auction"></span>`);
            $("#mensagem").html("Você poderá utilizar os serviços oferecidos pelo EMAJ");
            $('#dadostriagem')[0].reset();
        }else{
            $("#icone").html(`<span class="oi oi-ban"></span>`);
            $("#mensagem").html("Infelizmente você não poderá utilizar os serviços <br> oferecidos pelo EMAJ");
            $('#dadostriagem')[0].reset();
        }


        event.preventDefault();
    });

});

function converteMoedaFloat(valor) {

    if (valor === "") {
        valor = 0;
    } else {
        valor = valor.replace(".", "");
        valor = valor.replace(",", ".");
        valor = parseFloat(valor);
    }
    return valor;

}
</script>         
@endsection