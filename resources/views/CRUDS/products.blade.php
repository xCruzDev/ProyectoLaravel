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
    {{-- Seccion de busqueda y filtro --}}
    <div class="row row-cols-3">
        <div class="col">
            <div class="dropdown me-1">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">
                    Ordenar Por
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="filter_prodASC()">A-Z</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filter_prodDESC()">Z-A</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filter_quantASC()">Mayor Cantidad</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filter_quantDESC()">Menor Cantidad</a></li>
                </ul>
                <button class="btn" id="btnRst" onclick="cargarProductos()">🔄️</button>
            </div>
        </div>
        <div class="col">
            <label for="nombre" class="text">Nombre del Producto:</label>
            <input placeholder="Buscar..." type="text" id="productSearch">
        </div>
        <div class="col" style="text-align: end;">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#productModal"> + Nuevo Producto</button>
        </div>   
    </div><br>

    <!-- Modal Registro -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4" id="exampleModalLabel">Nuevo Producto</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/products/new" method="POST">
                    @csrf
                    <div class="row row-cols-2">
                        <div class="col-9">
                            Nombre de producto:
                            <input type="text" class="form-control" name="name" id="name" style="margin-right: 10px;" required>    
                        </div>
                        <div class="col-3">
                            Existencias:
                            <input type="number" class="form-control" name="quantity" id="quantity" required>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            Precio:
                            <input placeholder="$..." class="form-control" type="number" name="price" id="price" step="0.01" required>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            Descripcion:
                            <input type="text" placeholder="Descripcion...." name="description" id="description" class="form-control" id="last_name">    
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            Categoria:
                            <select class="form-select" name="category_id" id="category_id">
                                <option selected disabled hidden>-- Seleciona una Categoria --</option>
                            </select>
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
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4" id="exampleModalLabel">Actualizar     Producto</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/products/update" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            ID
                            <input type="number" class="form-control" name="id" id="E_id" style="width: 25%" readonly>
                        </div>
                    </div><br>
                    <div class="row row-cols-2">
                        <div class="col-9">
                            Nombre de producto:
                            <input type="text" class="form-control" name="name" id="E_name" style="margin-right: 10px;" required>    
                        </div>
                        <div class="col-3">
                            Existencias:
                            <input type="number" class="form-control" name="quantity" id="E_quantity" required>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            Precio:
                            <input placeholder="$..." class="form-control" type="number" name="price" id="E_price" step="0.01" required>
                        </div>
                    </div><br>
                    <div>
                        <div class="col">
                            Descripcion:
                            <input type="text" placeholder="Descripcion...." name="description" id="E_description" class="form-control" id="last_name">    
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            Categoria:
                            <select class="form-select" name="category_id" id="E_category_id">
                                <option selected disabled hidden>-- Seleciona una Categoria --</option>
                            </select>
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

    
    {{-- Tabla Productos --}}
    <table class="table table-hover table-striped text-center">
        <thead class="table-info">
            <tr class="row row-cols-6">
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Existencias</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody id="table-body-products">
        </tbody>
    </table>
</div>
@endsection

@section('js')
    <script>

        function cargarProductos() {
            $.ajax({
                url: '/products/get',
                method: 'GET',
                success: function(data) {
                    const tableBody = $('#table-body-products');
                    tableBody.empty();
                    data.forEach(product => {
                        const row = `<tr class="row row-cols-6">
                            <td>${product.name}</td>
                            <td>${product.description}</td>
                            <td>${product.quantity}</td>
                            <td>$ ${product.price}</td>
                            <td>${product.categories.description}</td>
                            <td>
                                <button class="btn btn-warning" onclick="obtenerDatos(${product.id})" data-bs-toggle="modal" data-bs-target="#editProductModal" >Actualizar</button>
                                <button class="btn btn-danger" onclick="eliminarProducto(${product.id})">Eliminar</button>
                            </td>
                        </tr>`;
                        tableBody.append(row);
                    });
                }
            });

            $('#productSearch').val('');
        }

        function cargarCategorias() {
            $.ajax({
                url: '/categories/get',
                method: 'GET',
                success: function(data) {
                    console.log(data)
                    const categorySelect = $('#category_id, #E_category_id');
                    data.forEach(category => {
                        const option = `<option value="${category.id}">${category.description}</option>`;
                        categorySelect.append(option);
                    });
                },
                error: function(error){
                    console.log(error)
                }
            });
        }

        function obtenerDatos(id){
            $.ajax({
            url: `/products/get/${id}`,
            method: `GET`,
            success: function(dataProduct) {
                $('#E_id').val(dataProduct.id);
                $('#E_name').val(dataProduct.name);
                $('#E_quantity').val(dataProduct.quantity);
                $('#E_price').val(dataProduct.price);
                $('#E_description').val(dataProduct.description);
                $('#E_category_id').val(dataProduct.category_id);
            }
            });
        }

        function searchProduct(name){
            $.ajax({
                url: `/products/search/${name}`,
                method: 'GET',
                success: function(data) {
                    const tableBody = $('#table-body-products');
                    tableBody.empty();
                    data.forEach(product => {
                        const row = `<tr class="row row-cols-6">
                            <td>${product.name}</td>
                            <td>${product.description}</td>
                            <td>${product.quantity}</td>
                            <td>$ ${product.price}</td>
                            <td>${product.categories.description}</td>
                            <td>
                                <a href="/productos/actualizar/vista?id=${product.id}" class="btn btn-warning">Actualizar</a>
                                <button class="btn btn-danger" onclick="eliminarProducto(${product.id})">Eliminar</button>
                            </td>
                        </tr>`;
                        tableBody.append(row);
                    });
                },
                error: function(error){
                    console.log(error)
                }
            });
        }

        function filter_prodASC(){
            $.ajax({
                url: '/products/filter/product/ASC',
                method: 'GET',
                success: function(data) {
                    const tableBody = $('#table-body-products');
                    tableBody.empty();
                    data.forEach(product => {
                        const row = `<tr class="row row-cols-6">
                            <td>${product.name}</td>
                            <td>${product.description}</td>
                            <td>${product.quantity}</td>
                            <td>$ ${product.price}</td>
                            <td>${product.categories.description}</td>
                            <td>
                                <a href="/products/edit/?id=${product.id}" class="btn btn-warning">Actualizar</a>
                                <button class="btn btn-danger" onclick="eliminarProducto(${product.id})">Eliminar</button>
                            </td>
                        </tr>`;
                        tableBody.append(row);
                    });
                }
            });
        }
        
        function eliminarProducto(id) {
            $.ajax({
            url: `/products/delete/${id}`,
            method: 'GET',
            success: function() {
                cargarProductos();
            },
            error: function(error){
                console.log(error)
            }
            });
        }

    $(document).ready(function() {
        cargarProductos();
        cargarCategorias();

        $('#productSearch').on('input',function (){
        var search = $(this).val();
        if(search){
            searchProduct(search);
        }
        else{
            cargarProductos();
        }
        console.log(search);
    });
});



    </script>
@endsection