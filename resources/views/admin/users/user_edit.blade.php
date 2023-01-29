@extends('admin.master')

@section('title','Editar usuario')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/users') }}"><i class="fa-solid fa-users"></i> Usuarios</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page_user">

        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-circle-user"></i> Usuario</h2>
                    </div>

                    <div class="inside">

                        <div class="mini_profile">
                            @if(is_null($u->avatar))
                                <img src="{{ url('/static/images/default-avatar.png') }}" class="avatar">
                            @else
                                <img src="{{ url('/uploads/users/'.$u->id.'/'.$user->avatar) }}" class="avatar">
                            @endif
                            <div class="info mtop16">
                                <span class="title"><i class="fa-solid fa-address-card"></i> Nombre: </span>
                                <span class="text">{{ $u->name }} {{ $u->lastname }}</span>
                                <span class="title mtop16"><i class="fa-solid fa-envelope"></i> Correo: </span>
                                <span class="text">{{ $u->email }}</span>
                                <span class="title mtop16"><i class="fa-solid fa-mobile-button"></i> Teléfono: </span>
                                <span class="text">{{ $u->phone }} </span>
                                <span class="title mtop16"><i class="fa-solid fa-calendar-days"></i> Fecha de registro: </span>
                                <span class="text">{{ $u->created_at }} </span>
                                <span class="title mtop16"><i class="fa-solid fa-user-secret"></i> Role de usuario: </span>
                                <span class="text">{{ getRoleUserArray(null, $u->role) }} </span>
                                <span class="title mtop16"><i class="fa-solid fa-person-circle-question"></i> Estado de usuario: </span>
                                <span class="text">{{ getUserStatusArray(null, $u->status) }} </span>
                            </div>

                            <div class="suspend">
                                @if(kvfj(Auth::user()->permissions, 'user_banned'))
                                    @if($u->status == "100")
                                        <a href="{{ url('/admin/users/' .$u->id. '/banned') }}" class="btn btn-success mtop16">Reactivar usuario</a>
                                    @else
                                        <a href="{{ url('/admin/users/' .$u->id. '/banned') }}" class="btn btn-danger mtop16">Suspender usuario</a>
                                    @endif
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-regular fa-file-lines"></i> Editar información </h2>
                    </div>

                    <div class="inside">

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
