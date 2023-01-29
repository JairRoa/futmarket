@extends('connect.master')

@section('title', 'login')

@section('content')
    <div class="box box_login shadow">
        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ url('/static/images/berenjena.png') }}">
            </a>
        </div>

        <div class="fut">
            <h3>FutMarket</h3>
            <h5>Del campo a tu puerta</h5>
        </div>

        <div class="inside">
            {!! Form::open([ 'url' => '/login']) !!}
            <label for="email" class="mtop16">Email</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa-solid fa-user-lock"></i></i>
                    </div>
                </div>
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>

            <label for="password" class="mtop16">Contraseña</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa-solid fa-key"></i>
                    </div>
                </div>
                    {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>


            {!! Form::submit('Iniciar sesión', ['class' => 'btn btn-success mtop16']) !!}

            {!! Form::close() !!}

            @if(Session::haS('message'))
            <div class="container">
                <div class="alert alert{{ Session::get('typealert') }}" style="display: none;">
                    {{ Session::get('message') }}
                    @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error )
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <script>
                        $(' .alert').slideDown();
                        setTimeout(function(){ $(' .alert').slideUp(); }, 10000);
                    </script>
                </div>
            </div>
            @endif



            <div class="register mtop16">
                <h54>No tengo cuenta</h5>
            </div>

            <div class="footer mtop16">
                <a href="{{ url('/register') }}">Crear cuenta</a>
                <a href="{{ url('/recover') }}">Olvidé mi contraseña</a>
            </div>

        </div>


    </div>
@stop
