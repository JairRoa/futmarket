@extends('admin.master')

@section('title','Usuarios')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/users/all') }}"><i class="fa-solid fa-users"></i> Usuarios</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-users"></i> Usuarios</h2>
        </div>
        <div class="inside">
            <div class="row">
                <div class="col-md-2 offset-md-10">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                            <i class="fa-solid fa-magnifying-glass"></i> Filtrar
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ url('/admin/users/all') }}"><i class="fa-solid fa-person-half-dress"></i> Todos</a></li>
                          <li><a class="dropdown-item" href="{{ url('/admin/users/0') }}"><i class="fa-solid fa-user-minus"></i> No verificados</a></li>
                          <li><a class="dropdown-item" href="{{ url('/admin/users/1') }}"><i class="fa-solid fa-user-plus"></i> Verificados</a></li>
                          <li><a class="dropdown-item" href="{{ url('/admin/users/100') }}"><i class="fa-solid fa-user-large-slash"></i> Suspendidos</a></li>
                        </ul>
                      </div>
                    </div>
                </div>
            </div>
            <table class="table mtop16">
                <thead>
                    <td>ID </td>
                    <td>NOMBRE </td>
                    <td>APELLIDOS </td>
                    <td>TELÉFONO </td>
                    <td>CORREO </td>
                    <td>ROLE </td>
                    <td>ESTADO </td>
                    <td></td>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ getRoleUserArray(null, $user->role) }}</td>
                        <td>{{ getUserStatusArray(null, $user->status) }}</td>
                        <td>

                            <div class="opts">
                                @if(kvfj(Auth::user()->permissions, 'user_edit'))
                                <a href=" {{ url('/admin/users/' .$user->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                @endif
                                @if(kvfj(Auth::user()->permissions, 'user_permissions'))
                                <a href=" {{ url('/admin/users/' .$user->id.'/permissions')}}" data-toggle="tooltip" data-placement="top" title="Permisos de usuario"><i class="fa-solid fa-hand"></i></a>
                                @endif
                            </div>

                        </td>
                    </tr>
                    @endforeach

                    <div class="d-flex justify-content-end">
                        <tr>
                            <td>{!! $users->links() !!} </td>
                        </tr>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
