@extends('templates.dashboard')

@section('style')
<style>
    h1{
        text-align: center;
        margin-top: 20px;
    }
</style>
@endsection

@section('body')
<h1>Productos</h1><br><br>
<div class="container">
    <div class="row row-cols-3">
        <div class="col" >
            <div class="dropdown me-1">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">
                Ordenar Por
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="ordMatAsc()">Usuario: Ascendente</a></li>
                <li><a class="dropdown-item" href="#" onclick="ordMatDesc()">Usuario: Descendente</a></li>
                <li><a class="dropdown-item" href="#" onclick="ordNameAZ()">A - Z</a></li>
                <li><a class="dropdown-item" href="#" onclick="ordNameZA()">Z - A</a></li>
            </ul>
            </div><br>
        </div>
        <div class="col">
            <label for="nombre" class="text">Nombre:</label>
            <input type="text" id="nombreBuscar">
            <button type="button" class="btn btn-secondary" onclick="searchName()">BUSCAR</button>
        </div>
        <div class="col" style="text-align: end;">
            <button class="btn btn-success">Nuevo Producto</button>
        </div>   
    </div>

    <table class="table table-hover table-striped text-center">
        <thead class="table-info">
            <tr class="row row-cols-5">
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Existencias</th>
                <th>Categoria</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr data-id="{{$product->id}}" class="row row-cols-5">
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->categories->description}}</td>
                    <td>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">X</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection