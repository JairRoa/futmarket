@extends('connect.master')

@section('title', 'register')

@section('content')
    <div class="box box_register shadow">
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
            {!! Form::open(['url' => '/register']) !!}
            <label for="name">Nombre</label>
            <div class="input-group">

                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-user"></i></i></div>
                </div>
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}

            </div>
            <label for="lastname" class="mtop16">Apellido</label>
            <div class="input-group">

                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-regular fa-user"></i></i></div>
                </div>
                    {!! Form::text('lastname', null, ['class' => 'form-control', 'required']) !!}

            </div>
            <label for="phone" class="mtop16">Teléfono</label>
            <div class="input-group">

                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-mobile"></i></i></div>
                </div>
                    {!! Form::number('phone', null, ['class' => 'form-control', 'required']) !!}

            </div>
            <label for="email" class="mtop16">Correo</label>
            <div class="input-group">

                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-envelope"></i></i></div>
                </div>
                    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}

            </div>
            <label for="password" class="mtop16">Contraseña:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                </div>
                    {!! Form::password('password',  ['class' => 'form-control', 'required']) !!}

            </div>
            <label for="cpassword" class="mtop16"> Confirmar Contraseña:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                </div>
                    {!! Form::password('cpassword',  ['class' => 'form-control', 'required']) !!}

            </div>

            {!! Form::submit('Registrar', ['class' => 'btn btn-success mtop16']) !!}

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
                <h5>Tengo una cuenta</h5>
            </div>

            <div class="footer1 mtop16">
                <a href="{{ url('/login') }}">Iniciar sesión</a>
            </div>

        </div>


    </div>
@stop

