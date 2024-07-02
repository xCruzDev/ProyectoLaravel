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
<h1>Categorias de Productos</h1><br><br>
<div class="container text-center">
    <div class="row row-cols-3">
        <div class="col text-start" >
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
            <button class="btn btn-success">Nueva Categoria</button>
        </div>   

    <table id="table-clients" class="table table-hover table-striped">
        <thead class="table-info">
            <tr class="row row-cols-3">
                <th>ID</th>
                <th>Description</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr data-id="{{$category->id}}" class="row row-cols-3">
                    <td>{{$category->id}}</td>
                    <td>{{$category->description}}</td>
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
