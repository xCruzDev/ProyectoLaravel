@extends('templates.principal')

@section('style')
@endsection

@section('body')
<div class="container">
    <h2 class="text-center">JSON DINAMICO</h2><br>
    <div class="row row-cols-2" style="margin-bottom: 20px">
        Key:
        <input class="form-control" type="text" id="txbKey"><br>
        Value:
        <input class="form-control" type="text" id="txbVal" style="margin-bottom: 15px">
        <div class="col">
            <button class="btn btn-primary">Agregar Datos Al Objeto</button>
            <button class="btn btn-secondary">Crear Nuevo Objeto</button>
        </div>
    </div>
    <div>
        objetos:
        <select class="form-select" name="" id="#cbxObj" style="margin-bottom: 20px">
            <option value="" selected disabled hidden>-- Seleciona un Objeto --</option>
        </select>
        <h3>Datos del objeto Seleccionado</h3><br>
        <table class="table table-hover table-striped">
            <thead class="table-info">
                <tr class="row row-cols-2">
                    <th>Key</th>
                    <th>Value</th>    
                </tr>
            </thead>
            <tbody></tbody>
        </table>    
    </div>
</div>
@endsection

@section('js')
    
@endsection