@extends('templates.principal')

@section('style')
<style>
        h1{
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            text-align: center;
            margin-top: 20px;
            color: white;
        }
        p{
            color: white;
        }

        .text {
            color: white;
        }
</style>
@endsection

@section('body')
<body style="background-color: rgb(76, 77, 80);">
    <h1>Registro de Alumnos</h1><br><br>
    <div class="container" style="margin-bottom: 1%;">
        <div class="row row-cols-3">
            <div class="col">
                <div class="dropdown me-1">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">
                    Ordenar Por
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="ordMatAsc()">Matricula: Ascendente</a></li>
                    <li><a class="dropdown-item" href="#" onclick="ordMatDesc()">Matricula: Descendente</a></li>
                    <li><a class="dropdown-item" href="#" onclick="ordNameAZ()">A - Z</a></li>
                    <li><a class="dropdown-item" href="#" onclick="ordNameZA()">Z - A</a></li>
                    <li><a class="dropdown-item" href="#" onclick="ordImcAsc()">IMC: Ascendente</a></li>
                    <li><a class="dropdown-item" href="#" onclick="ordImcDesc()">IMC: Descendente</a></li>
                </ul>
                </div><br>
            </div>
            <div class="col">
                <label for="nombre" class="text">Nombre:</label>
                <input type="text" id="nombreBuscar">
                <button type="button" class="btn btn-secondary" onclick="searchName()">BUSCAR</button>
              </div>  
            <div class="col" style="text-align: end;">
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
        </div>
    </div>
    
    <!-- Tabla -->
    <div class="container text-center">
        <table class="table table-dark table-striped">
            <thead>
                <tr class="row row-cols-9">
                    <th class="col">Matricula</th>
                    <th class="col">Nombre</th>
                    <th class="col">Apellido</th>
                    <th class="col">Peso (Kg)</th>
                    <th class="col">Estatura (M)</th>
                    <th class="col">IMC</th>
                    <th class="col">Condicion</th>
                    <th class="col">Fecha de Nacimiento</th>
                    <th class="col">Accion</th>
                </tr>
            </thead>
            <tbody id="reg"></tbody>
        </table>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registro" onclick="modal()" style="margin-bottom: 5%;">Nuevo Registro</button>
    </div>

    <!-- MODAL REGISTRO -->
    <div class="modal fade" id="registro" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title fs-5">Registrar Alumno</h2>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row row-cols-3" style="margin-bottom: 20px;">
                    <div class="col">
                        Matricula:
                        <input type="text" placeholder="MATRICULA" class="form-control" id="matricula">
                    </div>
                </div>
                <div class="row row-cols-2">
                    <div class="col">
                        Nombre:
                        <input type="text" placeholder="NOMBRE" class="form-control" id="nombre" style="margin-right: 10px;">    
                    </div>
                    <div class="col">
                        Apellido:
                        <input type="text" placeholder="APELLIDO" class="form-control" id="apellido">
                    </div>
                </div><br>
                <div class="row row-cols-2">
                    <div class="col">
                        Peso:
                        <input type="number" placeholder="PESO (KG)" class="form-control" id="peso">
                    </div>
                    <div class="col">
                        Estatura:
                        <input type="number" placeholder="ESTATURA (M)" class="form-control" id="estatura">
                    </div>
                </div><br>
                <div class="text-center">
                    Fecha de nacimiento:
                    <input type="date" class="form-control" id="birthday">    
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="button" class="btn btn-primary" id="confirm-reg" onclick="confirmarReg()" style="margin: 25px; width: 50%;">Registrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL EDICION -->
      <div class="modal fade" id="editReg" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title fs-5">Editar Alumno</h2>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row row-cols-3" style="margin-bottom: 20px;">
                    <div class="col">
                        Matricula:
                        <input type="text" placeholder="MATRICULA" class="form-control" id="e-matricula">
                    </div>
                </div>
                <div class="row row-cols-2">
                    <div class="col">
                        Nombre:
                        <input type="text" placeholder="NOMBRE" class="form-control" id="e-nombre" style="margin-right: 10px;">    
                    </div>
                    <div class="col">
                        Apellido:
                        <input type="text" placeholder="APELLIDO" class="form-control" id="e-apellido">
                    </div>
                </div><br>
                <div class="row row-cols-2">
                    <div class="col">
                        Peso:
                        <input type="number" placeholder="PESO (KG)" class="form-control" id="e-peso">
                    </div>
                    <div class="col">
                        Estatura:
                        <input type="number" placeholder="ESTATURA (M)" class="form-control" id="e-estatura">
                    </div>
                </div><br>
                <div class="text-center">
                    Fecha de nacimiento:
                    <input type="date" class="form-control" id="e-birthday">    
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="button" class="btn btn-primary" id="confirm" onclick="confirmEdit(currentIndex)" style="margin: 25px; width: 50%;">Confirmar</button>
            </div>
          </div>
        </div>
      </div>    
</body>
@endsection

@section('js')
<script>
    var alumno = [
    {matricula: String, nombre: String, apellido: String, peso: Float32Array, estatura: Float32Array, imc: Float32Array, condicion: String, birthday: Date}
    ];

    alumno = [
        {matricula: '23170061', nombre:'Gerardo', apellido:'Cruz', peso: 70.2, estatura: 1.72, imc: 21.9, condicion: 'Normal', birthday: '2005-07-04'},
        {matricula: "12345678", nombre: "Juan", apellido: "Pérez", peso: 70.5, estatura: 1.75, imc: 23.02, condicion: "Normal", birthday: "2005-11-21"},
        {matricula: "23456789", nombre: "María", apellido: "Gómez", peso: 65.3, estatura: 1.68, imc: 23.12, condicion: "Normal", birthday: "1999-12-15"},
        {matricula: "34567890", nombre: "Carlos", apellido: "Fernández", peso: 80.2, estatura: 1.80, imc: 24.76, condicion: "Normal", birthday: "2001-02-20"},
        {matricula: "45678901", nombre: "Lucía", apellido: "Martínez", peso: 54.0, estatura: 1.61, imc: 21.09, condicion: "Normal", birthday: "2009-07-11"},
        {matricula: "56789012", nombre: "David", apellido: "López", peso: 95.5, estatura: 1.85, imc: 27.87, condicion: "Sobrepeso", birthday: "1998-11-05"},
        {matricula: "67890123", nombre: "Ana", apellido: "Hernández", peso: 48.0, estatura: 1.55, imc: 19.97, condicion: "Normal", birthday: "2000-05-23"},
        {matricula: "78901234", nombre: "José", apellido: "Rodríguez", peso: 105.0, estatura: 1.89, imc: 29.06, condicion: "Sobrepeso", birthday: "2001-08-17"},
        {matricula: "89012345", nombre: "Laura", apellido: "Sánchez", peso: 60.2, estatura: 1.72, imc: 20.82, condicion: "Normal", birthday: "1999-09-30"},
        {matricula: "90123456", nombre: "Sofía", apellido: "Ramírez", peso: 72.5, estatura: 1.78, imc: 22.88, condicion: "Normal", birthday: "2007-04-12"},
        {matricula: "01234567", nombre: "Miguel", apellido: "Torres", peso: 89.3, estatura: 1.82, imc: 26.94, condicion: "Sobrepeso", birthday: "2000-02-28"},
        {matricula: "98765432", nombre: "Martina", apellido: "Flores", peso: 58.7, estatura: 1.65, imc: 21.56, condicion: "Normal", birthday: "2007-10-19"},
        {matricula: "87654321", nombre: "Diego", apellido: "Cruz", peso: 92.0, estatura: 1.88, imc: 26.04, condicion: "Sobrepeso", birthday: "1999-03-14"},
        {matricula: "76543210", nombre: "Valeria", apellido: "Gutiérrez", peso: 51.5, estatura: 1.62, imc: 19.63, condicion: "Normal", birthday: "2009-12-03"},
        {matricula: "65432109", nombre: "Manuel", apellido: "Jiménez", peso: 85.0, estatura: 1.80, imc: 26.23, condicion: "Sobrepeso", birthday: "2001-07-22"}
    ];


    const modalRegistro = new bootstrap.Modal('#registro');
    const modalEdit = new bootstrap.Modal('#editReg');
    mostrarAlumno();


    function mostrarAlumno (filtrado = null) {
        var reg = document.getElementById('reg');
        reg.innerHTML ="";

        (filtrado||alumno).forEach(function(alumno, index) {
            var row = document.createElement('tr');
            row.className = 'alumno';
            row.setAttribute('style','text-align: center;');
            row.setAttribute('class','row row-cols-8');

            var colMat = document.createElement('td');
            colMat.setAttribute('data-index',index);
            colMat.setAttribute('class','col');
            colMat.textContent = alumno.matricula;

            var colNombre = document.createElement('td');
            colNombre.setAttribute('data-index',index);
            colNombre.setAttribute('class','col');
            colNombre.textContent = alumno.nombre;

            var colApellido = document.createElement('td');
            colApellido.setAttribute('data-index',index);
            colApellido.setAttribute('class','col');
            colApellido.textContent = alumno.apellido;

            var colPeso = document.createElement('td');
            colPeso.setAttribute('data-index',index);
            colPeso.setAttribute('class','col');
            colPeso.textContent = alumno.peso;

            var colEst = document.createElement('td');
            colEst.setAttribute('data-index',index);
            colEst.setAttribute('class','col');
            colEst.textContent = alumno.estatura;

            var colIMC = document.createElement('td');
            colIMC.setAttribute('data-index',index);
            colIMC.setAttribute('class','col');
            colIMC.textContent = alumno.imc;

            var colCond = document.createElement('td');
            colCond.setAttribute('data-index',index);
            colCond.setAttribute('class','col');
            colCond.textContent = alumno.condicion;

            var colbirthday = document.createElement('td');
            colbirthday.setAttribute('data-index',index);
            colbirthday.setAttribute('class','col');
            colbirthday.textContent = alumno.birthday;

            var buttonDelete = document.createElement('button');
            buttonDelete.textContent = 'Borrar';
            buttonDelete.setAttribute('class','btn btn-danger')
            buttonDelete.setAttribute('style','margin: 5%')
            buttonDelete.onclick = function() {
                borrarAlumno(index);
            };

            var buttonEdit = document.createElement('button');
            buttonEdit.textContent = 'Editar';
            buttonEdit.setAttribute('class','btn btn-warning');
            buttonEdit.setAttribute('style','margin-bottom: 5%');
            buttonEdit.onclick = function() {
                modalEdit.show();
                editarAlumno(index);
            }

            var colAction = document.createElement('div');
            colAction.setAttribute('class','col');
            colAction.setAttribute('data-index','index');
            colAction.appendChild(buttonDelete);
            colAction.appendChild(buttonEdit);

            row.appendChild(colMat);
            row.appendChild(colNombre);
            row.appendChild(colApellido);
            row.appendChild(colPeso);
            row.appendChild(colEst);
            row.appendChild(colIMC);
            row.appendChild(colCond);
            row.appendChild(colbirthday);
            row.appendChild(colAction);

            reg.appendChild(row);
        }
    )}

    function confirmarReg() {
        var nuevoMatricula = document.getElementById('matricula').value;
        var nuevoNombre = document.getElementById('nombre').value;
        var nuevoApellido = document.getElementById('apellido').value;
        var nuevoPeso = parseFloat(document.getElementById('peso').value);
        var nuevoEst = parseFloat(document.getElementById('estatura').value);
        var nuevoIMC = parseFloat(calcularIMC(nuevoPeso,nuevoEst));
        var nuevoCond = condIMC(nuevoIMC);
        var nuevoBirthday = document.getElementById('birthday').value;

        if (nuevoMatricula && nuevoNombre && nuevoApellido && nuevoPeso
            && nuevoEst && nuevoBirthday) {
            alumno.push({matricula: nuevoMatricula , nombre: nuevoNombre , apellido: nuevoApellido , peso: nuevoPeso,
                estatura: nuevoEst, imc: nuevoIMC, condicion: nuevoCond, birthday: nuevoBirthday});
            mostrarAlumno();
            matricula.value = "";
            nombre.value = "";
            apellido.value = "";
            peso.value = "";
            estatura.value = "";
            birthday.value = "";
            modalRegistro.hide();
        } else {
            alert('Por favor, complete el campo restante');
        }
    }

    function calcularIMC (peso,estatura) {
            
        var IMC = (peso / (estatura ** 2)).toFixed(2);
        return IMC;
    }

    function condIMC (imc) {
        var condicion;

        if (imc <= 18.5){
            condicion = "Bajo Peso";
        }
        else if (imc >= 18.5 && imc <= 24.99){
            condicion = "Normal";
        }
        else if (imc >= 25 && imc <= 26.99){
            condicion = "Sobrepeso";
        }
        else if (imc >= 27 && imc <= 29.99){
            condicion = "Sobrepeso II";
        }
        else if (imc >= 30 && imc <= 34.99){
            condicion = "Obesidad";
        }
        else if (imc >= 35 && imc <= 39.99){
            condicion = "Obesidad II";
        }
        else if (imc >= 40 && imc <= 49.99){
            condicion = "OBESIDAD III";
        }
        else if (imc >= 50) {
            condicion = "Obesidad IV";
        }

        return condicion;
    }

    function ordMatAsc () {
        alumno.sort(function(a,b){return a.matricula - b.matricula });
        mostrarAlumno();
    }

    function ordMatDesc () {
        alumno.sort(function(a,b){return a.matricula - b.matricula });
        alumno.reverse();
        mostrarAlumno();
    }

    function ordImcAsc () {
        alumno.sort(function(a,b){return a.imc - b.imc });
        mostrarAlumno();
    }

    function ordImcDesc () {
        alumno.sort(function(a,b){return a.imc - b.imc });
        alumno.reverse();
        mostrarAlumno();
    }

    function ordNameAZ () {
        alumno.sort((c, d)=> c.nombre.toLowerCase().charCodeAt(0) - d.nombre.toLowerCase().charCodeAt(0));
        mostrarAlumno();
    }

    function ordNameZA () {
        alumno.sort((c, d)=> c.nombre.toLowerCase().charCodeAt(0) - d.nombre.toLowerCase().charCodeAt(0));
        alumno.reverse();
        mostrarAlumno();
    }

    function borrarAlumno(index) {
        alumno.splice(index, 1);
        mostrarAlumno();
    }

    function searchDate() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        var alumnosFiltrados = alumno.filter(function(alumno) {
        return (alumno.birthday >= startDate && alumno.birthday < endDate);
        });
        mostrarAlumno(alumnosFiltrados);
    }
        
        function searchName() {
        var search = document.getElementById('nombreBuscar').value;
        var alumnosSearch = alumno.filter(function(alumno) {
        return alumno.nombre == search;
        });
        mostrarAlumno(alumnosSearch);
        }

    var currentIndex

    function editarAlumno(index) {
        currentIndex = index;
        document.getElementById('e-matricula').value = alumno[index].matricula;
        document.getElementById('e-nombre').value = alumno[index].nombre;
        document.getElementById('e-apellido').value = alumno[index].apellido;
        document.getElementById('e-peso').value = alumno[index].peso;
        document.getElementById('e-estatura').value = alumno[index].estatura;
        document.getElementById('e-birthday').value = alumno[index].birthday;
    }

    function confirmEdit (index) {

        var editMat = document.getElementById('e-matricula').value;
        var editName = document.getElementById('e-nombre').value;
        var editApell = document.getElementById('e-apellido').value;
        var editPeso = document.getElementById('e-peso').value;
        var editEst = document.getElementById('e-estatura').value;
        var editIMC = calcularIMC(editPeso,editEst);
        var editCondImc = condIMC(editIMC);
        var editbirth = document.getElementById('e-birthday').value;

        if (editMat && editName && editApell && editPeso && editEst && editbirth){
            alumno[index] = {matricula: editMat, nombre: editName, apellido: editApell, peso: editPeso, estatura: editEst, imc: editIMC, condicion: editCondImc, birthday:editbirth}

            mostrarAlumno();
            modalEdit.hide();    
        }
        else{
            alert('complete los campos');
        }


    }
</script>
@endsection


