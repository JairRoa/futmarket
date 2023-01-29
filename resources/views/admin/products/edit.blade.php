@extends('admin.master')

@section('title', 'Editar Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/products') }}"><i class="fa-solid fa-carrot"></i> Productos</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Editar producto:  <h1>{!! Form::label('name', $p->name) !!}</h1></h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/admin/products/' . $p->id . '/edit' , 'files' => true]) !!}
                    <div class="row">

                        <div class="col-md-6">
                            <label for="name">Nombre del producto:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-lemon"></i>
                                    </span>
                                </div>
                                {!! Form::text('name', $p->name, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="category">Categoría:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-database"></i>
                                    </span>
                                </div>
                                {!! Form::select('category', $cats,  $p->category_id , ['class' => 'custom-select']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="img">Imagen:</label>
                            <div class="custom-file">
                                {!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile' , 'accept' => 'image/*']) !!}
                                <label for="customFile" class="custom-file-label"></label>
                            </div>

                        </div>

                    </div>

                    <div class="row mtop16">
                        <div class="col-md-3">
                            <label for="price">Precio: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-money-bill-wave"></i>
                                        </span>
                                    </div>
                                    {!! Form::number('price', $p->price , ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>
                        </div>
                    <div class="col-md-3">
                        <label for="indiscount">¿En descuento?: </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-percent"></i>
                                    </span>
                                </div>
                                {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->indiscount , ['class' => 'custom-select']) !!}
                            </div>
                    </div>

                    <div class="col-md-3">
                        <label for="discount">Descuento: </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-money-bill-wave"></i>
                                    </span>
                                </div>
                                {!! Form::number('discount', $p->discount, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>
                    </div>

                    <div class="col-md-3">
                        <label for="indiscount">Estado: </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-thumbs-up"></i>
                                    </span>
                                </div>
                                {!! Form::select('status', ['0' => 'Borrador', '1' => 'Público'], $p->status , ['class' => 'custom-select']) !!}
                            </div>
                    </div>

                    </div>

                    <div class="row mtop16">
                        <div class="col-md-3">
                            <label for="inventory">Inventario: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </span>
                                    </div>
                                    {!! Form::number('inventory', $p->inventory, ['class' => 'form-control', 'min' => '0.00']) !!}
                                </div>
                        </div>
                        <div class="col-md-3">
                            <label for="code">Código: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-barcode"></i>
                                        </span>
                                    </div>
                                    {!! Form::number('code', $p->code, ['class' => 'form-control']) !!}
                                </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            <label for="content">Descripción: </label>
                            {!! Form::textarea('content', $p->content , ['class' => 'form-control', 'id' => 'editor']) !!}
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel shadow mtop16">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-image"></i> Imagen  {!! Form::label('name', $p->name) !!}</h2>
                    <div class="inside">
                        <img src="{{ url('/uploads/'.$p->file_path.'/'.$p->image)}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="panel shasow mtop16">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-images"></i> Galería  {!! Form::label('name', $p->name) !!}</h2>
                </div>
                <div class="inside product_gallery">
                    @if(kvfj(Auth::user()->permissions, 'product_gallery_add'))
                        {!! Form::open(['url' => '/admin/products/' .$p->id. '/gallery/add', 'files' => true, 'id' => 'form_product_gallery']) !!}
                        {!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'style' => 'display: none;', 'required']) !!}
                        {!! Form::close() !!}

                        <div class="btn-submit mtop16">
                            <a href="#" id="btn_products_file_image"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    @endif


                    <div class="tumbs">
                        @foreach ($p->getGallery as $img)
                        <div class="tumb">
                            @if(kvfj(Auth::user()->permissions, 'product_gallery_delete'))
                            <a href=" {{ url('/admin/products/'.$p->id. '/gallery/'.$img->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                            @endif
                            <img src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }}">
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
