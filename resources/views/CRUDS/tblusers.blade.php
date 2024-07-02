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
    <h1>Usuarios (Prueba)</h1><br><br>
<div class="container-fluid">
    <div class="row row-cols-10">
        <div class="col">
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
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col">
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                  Buscar Por Fechas
                </button>
                <form class="dropdown-menu p-4">
                  <div class="mb-3">
                    <label for="exampleDropdownFormEmail2" class="form-label">Desde :</label>
                    <input type="date" class="form-control" id="startDate">
                  </div>
                  <div class="mb-3">
                    <label for="exampleDropdownFormPassword2" class="form-label">Hasta :</label>
                    <input type="date" class="form-control" id="endDate">
                  </div><br>
                  <button type="button" class="btn btn-primary" onclick="searchDate()">Buscar</button>
                </form>
              </div>
        </div>
        <div class="col" style="text-align: end;">
            <button class="btn btn-success">Nuevo Usuario</button>
        </div>   
    </div>
    <table id="table-user" class="table table-hover table-striped text-center">
        <thead class="table-info">
            <tr class="row row-cols-10">
                <th class="col-lg-1">Usuario</th>
                <th class="col-lg-1">Nombre</th>
                <th class="col-lg-1">Sexo</th>
                <th class="col-lg-1">Nivel</th>
                <th class="col-lg-2">E-Mail</th>
                <th class="col-lg-1">Telefono</th>
                <th class="col-lg-1">Marca</th>
                <th class="col-lg-1">Compañia</th>
                <th class="col-lg-1">Saldo</th>
                <th class="col-lg-1">Activo</th>
                <th class="col-lg-1">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tblusers as $tbluser)
                <tr data-id="{{$tbluser->idx}}" class="row row-cols-10">
                    <td class="col-lg-1">{{$tbluser->usuario}}</td>
                    <td class="col-lg-1">{{$tbluser->nombre}}</td>
                    <td class="col-lg-1">{{$tbluser->sexo}}</td>
                    <td class="col-lg-1">{{$tbluser->nivel}}</td>
                    <td class="col-lg-2">{{$tbluser->email}}</td>
                    <td class="col-lg-1">{{$tbluser->telefono}}</td>
                    <td class="col-lg-1">{{$tbluser->marca}}</td>
                    <td class="col-lg-1">{{$tbluser->compania}}</td>
                    <td class="col-lg-1">{{$tbluser->saldo}}</td>
                    <td class="col-lg-1">{{$tbluser->activo ? 'Si' : 'No'}}</td>
                    <td class="col-lg-1">
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">X</button>
                    </td>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

</script>
@endsection

