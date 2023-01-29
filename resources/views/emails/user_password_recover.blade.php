@extends('emails.master')

@section('content')

<p><strong> Hola: {{ $name }} </strong></p>
<p>Restablece la contraseña de tu cuenta</p>
<p>por favor haz click en el siguiente enlace e introduce el código <h2><strong>  {{ $code }} </strong></h2> </p>
<p><a href="{{ url('/reset') }}" style="display: inline-block; background-color: #2E0071; color: #fff; padding: 12px; border-radius: 10px; text-decoration: none;">Recuperar contraseña</a></p>
<p>O ingrese al siguiente enlace</p>
<p>{{ url('/reset?email='.$email) }}</p>
@stop
