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
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#productModal"> + Nuevo Producto</button>
        </div>   
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4" id="exampleModalLabel">Nuevo Producto</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-3" style="margin-bottom: 20px;">
                    <div class="col">
                        Usuario:
                        <input type="text" placeholder="USERNAME" class="form-control" id="user_name">
                    </div>
                </div>
                <div class="row row-cols-2">
                    <div class="col">
                        Nombre:
                        <input type="text" placeholder="NOMBRE" class="form-control" id="name" style="margin-right: 10px;">    
                    </div>
                    <div class="col">
                        Apellido:
                        <input type="text" placeholder="APELLIDO" class="form-control" id="last_name">
                    </div>
                </div><br>
                <div class="row row-cols-2">
                    <div class="col">
                        Saldo:
                        <input type="number" placeholder="SALDO" class="form-control" id="balance">
                    </div>
                    <div class="col">
                        Limite de Credito:
                        <input type="number" placeholder="LIMITE CREDITO" class="form-control" id="credit_limit">
                    </div>
                </div><br>
        </div>
            <div class="text-center">
                <button type="button" class="btn btn-success" id="confirm-reg" onclick="location.href='/clients/insert';" style="margin-bottom:25px; width: 50%;">Registrar</button>
            </div>
          </div>
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