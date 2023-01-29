@extends('connect.master')

@section('title', 'Recuperar Contraseña')

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
            {!! Form::open([ 'url' => '/reset']) !!}
            <label for="email" class="mtop16">Correo electrónico</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa-solid fa-at"></i>
                    </div>
                </div>
                    {!! Form::email('email', $email, ['class' => 'form-control', 'required']) !!}
            </div>

            <label for="code" class="mtop16">Código</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa-solid fa-hashtag"></i>
                    </div>
                </div>
                    {!! Form::number('code', null, ['class' => 'form-control', 'required']) !!}
            </div>

            {!! Form::submit('Restablecer Contraseña', ['class' => 'btn btn-success mtop16']) !!}

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


            <div class="footer mtop16">
                <a href="{{ url('/register') }}">Crear cuenta</a>
                <a href="{{ url('/login') }}">Ingresar a mi cuenta</a>
            </div>

        </div>


    </div>
@stop
