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
    <h1>Clientes</h1><br><br>
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
            <button class="btn btn-success">Nuevo Cliente</button>
        </div>   
    </div>

    <table class="table table-hover table-striped text-center">
        <thead class="table-info">
            <tr class="row row-cols-7">
                <th class="col">Usuario</th>
                <th class="col">Nombre</th>
                <th class="col">Apellido</th>
                <th class="col">Saldo</th>
                <th class="col">Limite de Credito</th>
                <th class="col">Descuento</th>
                <th class="col">Accion</th>    
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr data-id="{{$client->id}}" class="row row-cols-7">
                    <td class="col">{{$client->user_name}}</td>
                    <td class="col">{{$client->name}}</td>
                    <td class="col">{{$client->last_name}}</td>
                    <td class="col">{{$client->balance}}</td>
                    <td class="col">{{$client->credit_limit}}</td>
                    <td class="col">{{$client->discount}}%</td>
                    <td class="col">
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">X</button>
                    </td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script>
     document.addEventListener("DOMContentLoaded", function() {
        // Agregar nuevo cliente
        document.querySelector(".btn-success").addEventListener("click", function() {
            // Muestra un formulario modal o redirige a una página de creación
            // Aquí puedes agregar código para manejar la creación del cliente
        });

        // Editar cliente
        document.querySelectorAll(".btn-warning").forEach(button => {
            button.addEventListener("click", function() {
                const clientId = this.closest("tr").getAttribute("data-id");
                // Muestra un formulario modal con los datos del cliente para editar
                // Aquí puedes agregar código para manejar la edición del cliente
            });
        });

        // Eliminar cliente
        document.querySelectorAll(".btn-danger").forEach(button => {
            button.addEventListener("click", function() {
                const clientId = this.closest("tr").getAttribute("data-id");
                if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
                    fetch(`/clients/${clientId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Elimina la fila del cliente de la tabla
                            this.closest("tr").remove();
                        } else {
                            alert("Error al eliminar el cliente");
                        }
                    });
                }
            });
        });

        // Buscar cliente
        document.querySelector(".btn-secondary").addEventListener("click", function() {
            const searchName = document.getElementById("nombreBuscar").value;
            fetch(`/clients/search?name=${searchName}`)
                .then(response => response.json())
                .then(data => {
                    // Actualiza la tabla con los resultados de la búsqueda
                    const tbody = document.querySelector("tbody");
                    tbody.innerHTML = "";
                    data.clients.forEach(client => {
                        tbody.innerHTML += `
                            <tr data-id="${client.id}" class="row row-cols-7">
                                <td class="col">${client.user_name}</td>
                                <td class="col">${client.name}</td>
                                <td class="col">${client.last_name}</td>
                                <td class="col">${client.balance}</td>
                                <td class="col">${client.credit_limit}</td>
                                <td class="col">${client.discount}%</td>
                                <td class="col">
                                    <button class="btn btn-warning">Edit</button>
                                    <button class="btn btn-danger">X</button>
                                </td>
                            </tr>
                        `;
                    });
                    // Reasignar los eventos de los botones de edición y eliminación
                    assignEditDeleteEvents();
                });
        });

        // Asignar eventos de edición y eliminación
        function assignEditDeleteEvents() {
            document.querySelectorAll(".btn-warning").forEach(button => {
                button.addEventListener("click", function() {
                    const clientId = this.closest("tr").getAttribute("data-id");
                    // Muestra un formulario modal con los datos del cliente para editar
                    // Aquí puedes agregar código para manejar la edición del cliente
                });
            });

            document.querySelectorAll(".btn-danger").forEach(button => {
                button.addEventListener("click", function() {
                    const clientId = this.closest("tr").getAttribute("data-id");
                    if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
                        fetch(`/clients/${clientId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Elimina la fila del cliente de la tabla
                                this.closest("tr").remove();
                            } else {
                                alert("Error al eliminar el cliente");
                            }
                        });
                    }
                });
            });
        }

        // Inicializa los eventos
        assignEditDeleteEvents();
</script>
@endsection