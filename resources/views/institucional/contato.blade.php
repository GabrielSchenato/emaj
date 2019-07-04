@extends('layouts.app')

@section('title', __('Contato'))

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Contato</h1>
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('institucional.home') }}">
                            Início 
                            <i class="ion-ios-arrow-forward"></i>
                        </a>
                    </span>
                    <span>
                        Contato 
                        <i class="ion-ios-arrow-forward"></i>
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">

    <div class="container">

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sucesso!</strong> 
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif        

        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-4">
                <h2 class="h3">Informações de contato</h2>
            </div>
            <div class="w-100"></div>
            <div class="col-md-3">
                <p><span>Endereço:</span> Av. Castelo Branco, nº170, Bairro Universitário - Lages - SC - Brasil</p>
            </div>
            <div class="col-md-3">
                <p><span>Telefone:</span> <a href="tel://(49) 3251-1016">(49) 3251-1016</a></p>
            </div>
            <div class="col-md-3">
                <p><span>E-mail:</span> <a href="mailto:emaj@uniplaclages.edu.br">emaj@uniplaclages.edu.br</a></p>
            </div>
            <div class="col-md-3">
                <p><span>Website:</span> <a href="https://emaj.uniplaclages.edu.br">emaj.uniplaclages.edu.br</a></p>
            </div>
        </div>
        <div class="row block-9">

            <div class="col-lg-6 order-md-last d-flex">

                {!! Form::open(['route'=>'institucional.contato_enviar', 'class' => 'bg-light p-5 contact-form']) !!}

                <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
                    <!--                    {!! Form::label('Nome:') !!}-->
                    {!! Form::text('nome', old('nome'), ['class'=>'form-control', 'placeholder'=>'Nome', 'required']) !!}
                    <span class="text-danger">{{ $errors->first('nome') }}</span>
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <!--                    {!! Form::label('E-mail:') !!}-->
                    {!! Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=>'E-mail', 'required']) !!}
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>

                <div class="form-group {{ $errors->has('assunto') ? 'has-error' : '' }}">
                    <!--                    {!! Form::label('Assunto:') !!}-->
                    {!! Form::text('assunto', old('assunto'), ['class'=>'form-control', 'placeholder'=>'Assunto', 'required']) !!}
                    <span class="text-danger">{{ $errors->first('assunto') }}</span>
                </div>

                <div class="form-group {{ $errors->has('mensagem') ? 'has-error' : '' }}">
                    <!--                    {!! Form::label('Mensagem:') !!}-->
                    {!! Form::textarea('mensagem', old('mensagem'), ['class'=>'form-control', 'placeholder'=>'Mensagem', 'required']) !!}
                    <span class="text-danger">{{ $errors->first('mensagem') }}</span>
                </div>

                <div class="form-group">
                    <input type="submit" value="Enviar" class="btn btn-primary py-3 px-5">
                </div>
                {!! Form::close() !!}

            </div>

            <div class="col-lg-6 d-flex">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2967.11411210379!2d-50.31657023459659!3d-27.824750963890594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94e01f22d33c54e3%3A0x1f0c82e2171ebf3b!2sUniversidade+do+Planalto+Catarinense!5e0!3m2!1spt-BR!2sbr!4v1562207767623!5m2!1spt-BR!2sbr" width="600" height="620" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>

@endsection
