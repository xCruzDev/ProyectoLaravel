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
<h1>Direcciones</h1><br><br>
<div class="container">
    <div class="row row-cols-3">
        <div class="col"></div>
        <div class="col text-center">
            <form action="{{ url('/addresses') }}" method="GET">
                <label for="user_name" style="font-size: 125%; margin-bottom: 10px">Ingresa Nombre de Usuario</label><br>
                <input class="form-control" type="text" id="user_name" name="user_name" value="{{ request('user_name') }}"><br>
                <button type="submit" class="btn btn-success" style="width: 50%">Buscar</button>
            </form>
        </div>
        <div class="col"></div>
    </div><br>
</div>

@if ($results -> isNotEmpty())
<div class="container text-center">
    <table id="table-clients" class="table table-dark table-striped">
        <thead>
            <tr class="row row-cols-7">
                <th>Calle</th>
                <th>Numero</th>
                <th>Codigo Postal</th>
                <th>Ciudad</th>
                <th>Pais</th>
                <th>Principal</th>
                <th>Accion</th>    
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
            <tr class="row row-cols-7">
                <th>{{ $result->STREET }}</th>
                <th>{{ $result->NUMBER_EXT }}</th>
                <th>{{ $result->ZIP_CODE }}</th>
                <th>{{ $result->CITY }}</th>
                <th>{{ $result->COUNTRY }}</th>
                <th>{{ $result->PRINCIPAL }}</th>
                <th>
                    <button>Edit</button>
                    <button>X</button>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
@endif

<div class="container text-center">
    <table id="table-clients" class="table table-dark table-striped">
        <thead>
            <tr class="row row-cols-6">
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Saldo</th>
                <th>Limite de Credito</th>
                <th>Descuento</th>    
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
@endsection
