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
<div class="container">
    <div class="row row-cols-3">
        <div class="col text-start" ></div>
        <div class="col"></div>
        <div class="col" style="text-align: end;">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#categoryModal">+ Nueva Categoria</button>
        </div>
    </div><br>

    <!-- Modal Registro -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4" id="exampleModalLabel">Nueva Categoria</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/categories/new" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            Nombre de Categoria:
                            <input type="text" class="form-control" name="description" id="description" style="margin-right: 10px;" required>    
                        </div>
                    </div><br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" id="confirm-reg" style="margin-bottom:25px; width: 50%;">Registrar</button>
                    </div>            
                </form>
            </div>
          </div>
        </div>
    </div>

    <!-- Modal Edicion -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4" id="exampleModalLabel">Actualizar Categoria</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/categories/update" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            ID:
                            <input type="number" class="form-control" name="id" id="E_id" readonly>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            Nombre de Categoria:
                            <input type="text" class="form-control" name="description" id="E_description" style="margin-right: 10px;" required>    
                        </div>
                    </div><br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" id="confirm-reg" style="margin-bottom:25px; width: 50%;">Actualizar</button>
                    </div>            
                </form>
            </div>
          </div>
        </div>
    </div>

    <table id="table-categories" class="table table-hover table-striped text-center">
        <thead class="table-info">
            <tr class="row row-cols-3">
                <th>ID</th>
                <th>Description</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody id="tbody-cat">
        </tbody>
    </table>
</div>
@endsection

@section('js')
    <script>

        function cargarCategorias() {
            $.ajax({
                url: '/categories/get',
                method: 'GET',
                success: function(data) {
                    const tableBody = $('#tbody-cat');
                    tableBody.empty();
                    data.forEach(category => {
                        const row = `<tr class="row row-cols-3">
                            <td>${category.id}</td>
                            <td>${category.description}</td>
                            <td>
                                <button class="btn btn-warning" onclick="obtenerDatos(${category.id})" data-bs-toggle="modal" data-bs-target="#editCategoryModal" >Actualizar</button>
                                <button class="btn btn-danger" onclick="eliminarCategoria(${category.id})">Eliminar</button>
                            </td>
                        </tr>`;
                        tableBody.append(row);
                    });
                }
            });
            
        }

        function obtenerDatos(id){
            $.ajax({
            url: `/categories/get/${id}`,
            method: `GET`,
            success: function(dataCategory) {
                $('#E_id').val(dataCategory.id);
                $('#E_description').val(dataCategory.description);
            }
            });
        }
        
        function eliminarCategoria(id) {
            $.ajax({
            url: `/categories/delete/${id}`,
            method: 'GET',
            success: function() {
                cargarCategorias();
            },
            error: function(error){
                console.log(error)
            }
            });
        }

    $(document).ready(function() {
        cargarCategorias();
    });

    </script>
    
@endsection
