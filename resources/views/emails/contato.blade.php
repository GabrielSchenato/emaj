@component('mail::message')
# Olá, você recebeu uma nova mensagem de {{ $dados['nome'] }} através do portal do {{ config('app.name') }}

@component('mail::panel')
 **Nome:** {{ $dados['nome'] }} <br>
 **E-mail:** {{ $dados['email'] }}   <br>
 **Assunto:** {{ $dados['assunto'] }}   <br>
 **Mensagem:** {{ $dados['mensagem'] }}
@endcomponent

@endcomponent