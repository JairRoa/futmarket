@extends('admin.master')

@section('title','Categorías')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/categories') }}"><i class="fa-solid fa-layer-group"></i> Categorías</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-plus"></i> Agregar categoría</h2>
                </div>

                <div class="inside">
                    @if(kvfj(Auth::user()->permissions, 'category_add'))
                        {!! Form::open( ['url' => '/admin/category/add']) !!}

                            <label for="name">Nombre de la categoría:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-database"></i>
                                    </span>
                                </div>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>

                            <label for="module" class="mtop16">Módulo </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-database"></i>
                                    </span>
                                </div>
                                {!! Form::select('module', getModulesArray(),  0 , ['class' => 'custom-select']) !!}
                            </div>

                            <label for="icon" class="mtop16">Icono </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-database"></i>
                                    </span>
                                </div>
                                {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                            </div>

                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    @endif



                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-layer-group"></i> Categorías</h2>
                </div>

                <div class="inside">
                    <nav class="nav nav-pills nav-fill">
                        @foreach (getModulesArray() as $m => $k)
                        <a class="nav-link" href="{{ url('/admin/categories/'.$m) }}"><i class="fa-solid fa-rectangle-list"></i> {{ $k }}</a>
                        @endforeach
                    </nav>
                    <table class="table mtop16">
                        <thead>
                            <tr>
                                <td width="50"></td>
                                <td>Nombre</td>
                                <td width="140"></td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($cats as $cat)
                            <tr>
                                <td>{!! htmlspecialchars_decode($cat->icono) !!}</td>
                                <td>{{ $cat->name }}</td>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'category_edit'))
                                        <a href=" {{ url('/admin/category/' .$cat->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'category_delete'))
                                        <a href=" {{ url('/admin/category/' .$cat->id.'/delete')}}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash-can"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
