@extends('emails.master')

@section('content')

<p><strong> Hola: {{ $name }} </strong></p>
<p>Restablece la contraseña de tu cuenta</p>
<p> Esta es la nueva contraseña para que ingreses a tu cuenta </p>
<p><h2><strong>  {{ $password }} </strong></h2></p>
<p>Para iniciar sesión haz click en el botón</p>
<p><a href="{{ url('/login') }}" style="display: inline-block; background-color: #2E0071; color: #fff; padding: 12px; border-radius: 10px; text-decoration: none;">Recuperar cuenta</a></p>
<p>O ingrese al siguiente enlace</p>
<p>{{ url('/login') }}</p>
@stop
