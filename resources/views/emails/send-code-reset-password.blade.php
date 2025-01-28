@component('mail::message')
    <h1>{{__('We have received your request to reset your account password')}}</h1>
    <p>{{__('You can use the following code to recover your account')}}:</p>
    <p>{{ $code }}</p>
    <p>{{__('The allowed duration of the code is one hour from the time the message was sent')}}</p>
@endcomponent
