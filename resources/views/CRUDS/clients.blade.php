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
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#clientModal"> + Nuevo Cliente</button>
        </div>   
    </div>

    <!-- Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLabel">Nuevo Cliente</h1>
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

        $(document).ready(function() {
            let students = [];

            const renderStudents = (studentsToRender) => {
                const $studentsList = $('#students-list');
                $studentsList.empty();
                studentsToRender.forEach((student, index) => {
                    const $listItem = $(`
                        <tr>
                            <td>${student.matricula}</td>
                            <td>${student.nombre}</td>
                            <td>${student.apellido}</td>
                            <td>${student.edad}</td>
                            <td>${student.fechaNacimiento}</td>
                            <td><button class="btn btn-danger btn-sm remove-student" data-index="${index}">Eliminar</button></td>
                        </tr>
                        `);
                    $studentsList.append($listItem);
                });
                $('#json-output').text(JSON.stringify(students, null, 2));
            };

            const filterStudents = () => {
                const searchTerm = $('#search-input').val().toLowerCase();
                const searchBy = $('#search-field').val();
                const start = new Date($('#start-date').val());
                const end = new Date($('#end-date').val());

                const filteredStudents = students.filter(student => {
                    const studentField = student[searchBy].toLowerCase();
                    const studentDate = new Date(student.fechaNacimiento);
                    return studentField.includes(searchTerm) &&
                        (!$('#start-date').val() || studentDate >= start) &&
                        (!$('#end-date').val() || studentDate <= end);
                });

                renderStudents(filteredStudents);
            };

            var formStudent = document.getElementById('student-form')
            $('#student-form').submit(function(e) {
                e.preventDefault();
                const student = {
                    matricula: $('#student-matricula').val(),
                    nombre: $('#student-nombre').val(),
                    apellido: $('#student-apellido').val(),
                    edad: $('#student-edad').val(),
                    fechaNacimiento: $('#student-fecha-nacimiento').val()
                };

                students.push(student);
                renderStudents(students);
                $('#studentModal').modal('hide');
                this.reset();
            });

            $('#students-list').on('click', '.remove-student', function() {
                const index = $(this).data('index');
                students.splice(index, 1);
                renderStudents(students);
            });

            $('#search-btn').click(filterStudents);

            $('#add-student-btn').click(function() {
                $('#student-form')[0].reset();
            });

            renderStudents(students);
        });



     document.addEventListener("DOMContentLoaded", function() {
        // Agregar nuevo cliente
        document.querySelector(".btn-success").addEventListener("click", function() {
            document.getElementById('user_name').value;
            document.getElementById('name').value;
            document.getElementById('last_name').value;
            document.getElementById('balance').value;
            document.getElementById('credit_limit').value;
            document.getElementById('discount').value;
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