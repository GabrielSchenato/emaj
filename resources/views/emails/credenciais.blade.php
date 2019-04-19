@component('mail::message')
# Você acaba de ser registrado no portal do {{ config('app.name') }}
Aqui estão suas credenciais para seu primeiro acesso.

@component('mail::panel')
 Usuário: **{{ $user->email }}** <br>
 Senha: **{{ $plainPassword }}**
@endcomponent

<div style="text-align: center"><small>Recomendamos a alteração da senha após o primeiro acesso.</small></div>

@component('mail::button', ['url' => config('app.url')])
Acessar a plataforma
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent