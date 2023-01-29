@extends('admin.master')

@section('title','Productos')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/products') }}"><i class="fa-solid fa-carrot"></i> Productos</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-carrot"></i> Productos</h2>
        </div>
        <div class="inside">
            @if(kvfj(Auth::user()->permissions, 'product_add'))
            <div class="btn">
                <a href="{{ url('/admin/products/add') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Agregar producto</a>
            </div>
            @endif

            <table class="table table-striped mtop16">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td></td>
                        <td>NOMBRE</td>
                        <td>CATEGORÍA</td>
                        <td>PRECIO</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                    <tr @if($p->status == '0') class="table-danger" @endif>
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
                                <a href=" {{ url('/admin/products/' .$p->id.'/delete')}}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash-can"></i></a>
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
