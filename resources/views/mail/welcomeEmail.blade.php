@component('mail::message')
    <h1>Cadastro realizado com sucesso!</h1>

    Olá, {{ $mailData['name'] }}! É um prazer ter você conosco!
@endcomponent()
