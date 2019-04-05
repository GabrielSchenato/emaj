@extends('errors::illustrated-layout')

@section('code', '503')
@section('title', __('Serviço indisponível'))

@section('image')
    <div style="background-image: url({{ asset('/svg/503.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __($exception->getMessage() ?: 'Desculpe, estamos fazendo alguma manutenção. Por favor, volte em breve.'))
