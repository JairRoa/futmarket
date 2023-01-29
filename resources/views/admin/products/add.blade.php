@extends('admin.master')

@section('title', 'Agregar Productos')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('admin/products') }}"><i class="fa-solid fa-carrot"></i> Productos</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ url('admin/products/add') }}"><i class="fa-solid fa-plus"></i> Agregar Productos</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-plus"></i> Agregar productos</h2>
        </div>
        <div class="inside">
            {!! Form::open(['url' => '/admin/products/add' , 'files' => true]) !!}
            <div class="row">

                <div class="col-md-6">
                    <label for="name">Nombre del producto:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa-solid fa-lemon"></i>
                            </span>
                        </div>
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
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
                        {!! Form::select('category', $cats,  0 , ['class' => 'custom-select']) !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="img">Imagen:</label>
                    <div class="custom-file">
                        {!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile' , 'accept' => 'image/*']) !!}
                        <label for="customFile" class="custom-file-label">Examinar </label>
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
                            {!! Form::number('price', null , ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
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
                        {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], 0 , ['class' => 'custom-select']) !!}
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
                        {!! Form::number('discount', 0.00, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
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
                            {!! Form::number('inventory', 0, ['class' => 'form-control', 'min' => '0.00']) !!}
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
                            {!! Form::number('code', 0, ['class' => 'form-control']) !!}
                        </div>
                </div>
            </div>



            <div class="row mtop16">
                <div class="col-md-12">
                    <label for="content">Descripción: </label>
                    {!! Form::textarea('content', null , ['class' => 'form-control', 'id' => 'editor']) !!}
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
@endsection
