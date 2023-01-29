@extends('admin.master')

@section('title','Productos')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/products/all') }}"><i class="fa-solid fa-carrot"></i> Productos</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-carrot"></i> Productos</h2>
            <ul>
                @if(kvfj(Auth::user()->permissions, 'product_add'))
                <li>
                    <a href="{{ url('/admin/products/add') }}"><i class="fa-solid fa-plus"></i> Agregar producto</a>
                </li>
                @endif
                <li>
                    <a href="#"><i class="fa-solid fa-arrow-down-wide-short"></i> Filtrar </a>
                    <ul class="shadow">
                        <li><a href="{{ url('/admin/products/1') }}"><i class="fa-solid fa-earth-americas"></i> Públicos </a></li>
                        <li><a href="{{ url('/admin/products/0') }}"><i class="fa-solid fa-eraser"></i> Borradores </a></li>
                        <li><a href="{{ url('/admin/products/all') }}"><i class="fa-solid fa-table-cells"></i> Todos </a></li>
                        <li><a href="{{ url('/admin/products/trash') }}"><i class="fa-solid fa-trash-can"></i> Eliminados </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="btn_search"><i class="fa-solid fa-magnifying-glass"></i> Buscar</a>

                </li>
            </ul>
        </div>

        <div class="inside">

            <div class="form_search" id="form_search">
                {!! Form::open(['url' => '/admin/products/search']) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Buscar']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::select('filter', ['0' => 'Nombre del producto', '1' => 'Código'], 0, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('status', ['0' => 'Borradores', '1' => 'Públicos'], 0, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                </div>
            </div>

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <td style="font-weight: bold; font-size: 18px;">ID</td>
                        <td></td>
                        <td style="font-weight: bold; font-size: 18px;">NOMBRE</td>
                        <td style="font-weight: bold; font-size: 18px;">CATEGORÍA</td>
                        <td style="font-weight: bold; font-size: 18px;">PRECIO</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                    <tr>
                        <td width="50">{{ $p->id }}</td>
                        <td width="60">
                            <a href="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" data-fancybox="gallery">
                                <img src="{{ url('/uploads/'.$p->file_path.'/t_'.$p->image) }}" width="50">
                            </a>
                        </td>
                        <td>{{ $p-> name}}</td>
                        <td>{{ $p->cat->name}}</td>
                        <td>{{ $p->price}}</td>
                        <td>
                            <div class="opts">
                                @if(kvfj(Auth::user()->permissions, 'product_edit'))
                                <a href=" {{ url('/admin/products/' .$p->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                @endif
                                @if(kvfj(Auth::user()->permissions, 'product_delete'))
                                    @if(is_null($p->deleted_at))
                                        <a href="#" data-path="admin/products" data-action="delete" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn-deleted"><i class="fa-solid fa-trash-can"></i></a>
                                    @else
                                    <a href="{{ url('/admin/produscts/' .$p->id. '/restore') }}" data-path="admin/products" data-action="restore" data-object="{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn-deleted"><i class="fa-solid fa-trash-can-arrow-up"></i></a>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>

                    @endforeach
                    <div class="d-flex justify-content-end">
                        <tr>
                            <td>{!! $products->links() !!} </td>
                        </tr>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
