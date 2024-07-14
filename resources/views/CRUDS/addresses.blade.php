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
            <label for="user_name" style="font-size: 125%; margin-bottom: 10px">Ingresa Nombre de Usuario</label><br>
            <input class="form-control" type="text" id="user_name" name="user_name" ><br>
            <button type="submit" class="btn btn-success" onclick="obtenerDirecciones()" style="width: 50%">Buscar</button>
        </div>
        <div class="col"></div>
    </div><br>

    <div>
        <table id="table-address" class="table table-dark table-striped text-center">
            <thead>
                <tr class="row row-cols-7">
                    <th class="col">Calle</th>
                    <th class="col">Numero</th>
                    <th class="col">Codigo Postal</th>
                    <th class="col">Ciudad</th>
                    <th class="col">Pais</th>
                    <th class="col">Principal</th>
                    <th class="col">Accion</th>    
                </tr>
            </thead>
            <tbody id="tbody-addresses">
            </tbody>
        </table>    
    </div>
</div>
@endsection

@section('js')
    <script>
        function obtenerDirecciones(){
            $('#table-address').show();
            var user_name = $('#user_name').val();
            $.ajax({
                url: `/addresses/show/${user_name}`,
                method: `GET`,
                success: function(data) {
                    const tableBody = $('#tbody-addresses');
                    tableBody.empty();
                    data.forEach(address => {
                        const row = `<tr class="row row-cols-7">
                            <td class="col">${address.street}</td>
                            <td class="col">${address.number_ext}</td>
                            <td class="col">${address.zip_code}</td>
                            <td class="col">${address.city}</td>
                            <td class="col">${address.country}</td>
                            <td class="col">${address.principal}</td>
                            <td class="col">
                                <button class="btn btn-warning" onclick="obtenerDatos(${address.id})" data-bs-toggle="modal" data-bs-target="#editCategoryModal" >Actualizar</button>
                                <button class="btn btn-danger" onclick="eliminarCategoria(${address.id})">X</button>
                            </td>
                        </tr>`;
                        tableBody.append(row);
                    });
                }
            });
        }

        $(document).ready(function() {
            $('#table-address').hide();
        })
    </script>
@endsection
