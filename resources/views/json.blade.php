@extends('templates.principal')

@section('style')
<style>

        h1,h2 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
        }

        button {
            background-color: #256db4;
            cursor: pointer;
            padding: 8px 20px;
            color: black;
            border-style: solid;
            border-color: black;
            border-width: 0px;
            width: auto;
            height: auto;
            font-size: 12px;
            font-weight: bold;
            position: relative;
            border-radius: 20px;
        }

        .textBoxesMat {
            height: auto;
            width: 75px;
            border-style: solid;
            border-color: white;
            border-width: 1px;
            border-radius: 10px;
            font-size: large;
            text-align: center;
        }

        .textBoxes {
            height: auto;
            width: auto;
            border-style: solid;
            border-color: white;
            border-width: 1px;
            border-radius: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: large;
        }

        .textUI {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .alumno {
            margin-bottom: 10px;
        }

        .alumno input {
            margin-right: 10px;
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        body{
        background: #3399ff;
        }


        .circle{
        position: absolute;
        border-radius: 50%;
        background: white;
        animation: ripple 15s infinite;
        box-shadow: 0px 0px 1px 0px #508fb9;
        }

        .small{
        width: 200px;
        height: 200px;
        left: -100px;
        bottom: -100px;
        }

        .medium{
        width: 400px;
        height: 400px;
        left: -200px;
        bottom: -200px;
        }

        .large{
        width: 600px;
        height: 600px;
        left: -300px;
        bottom: -300px;
        }

        .xlarge{
        width: 800px;
        height: 800px;
        left: -400px;
        bottom: -400px;
        }

        .xxlarge{
        width: 1000px;
        height: 1000px;
        left: -500px;
        bottom: -500px;
        }

        .shade1{
        opacity: 0.2;
        }
        .shade2{
        opacity: 0.5;
        }

        .shade3{
        opacity: 0.7;
        }

        .shade4{
        opacity: 0.8;
        }

        .shade5{
        opacity: 0.9;
        }

        @keyframes ripple{
        0%{
            transform: scale(0.8);
        }
        
        50%{
            transform: scale(1.2);
        }
        
        100%{
            transform: scale(0.8);
        }
        }
</style>
@endsection

@section('body')
<body>

    <!-- Fondo y Animacion -->
    <div class='ripple-background'>
        <div class='circle xxlarge shade1'></div>
        <div class='circle xlarge shade2'></div>
        <div class='circle large shade3'></div>
        <div class='circle mediun shade4'></div>
        <div class='circle small shade5'></div>
    </div>
    <!-- ----------------------------------------- -->

    <div style="text-align: center;">
        <h1>Gestión de Alumnos</h1>

        <div id="listaAlumnos" style="margin-bottom: 25px;"></div>

        <button onclick="mostrarModal()" style="margin-bottom: 20px;">Agregar Alumno</button>
        <h2>Ordenar Por :</h2>
        <button onclick="OrdAgeMenorMayor()" style="margin-right: 15px;">Edad : Menor a Mayor</button>
        <button onclick="OrdAgeMayorMenor()" style="margin-right: 15px;">Edad : Mayor a Menor</button><br><br>
        <!-- <button onclick="Ord_AZ()"></button> -->
 
    </div>



    <!-- Modal para agregar alumnos -->
    <div id="modalAgregar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Agregar Alumno</h2>

            <label for="matricula" class="textUI" style="margin-right: 5px;">Matricula: </label>
            <input type="number" id="matricula" class="textBoxesMat" style="border-color: black; width: 100px; margin-bottom: 20px;">

            <label for="nombre" class="textUI" style="margin-right: 5px;">Nombre:</label>
            <input type="text" id="nombre" style="margin-right: 30px; border-color: black; width: 250px;" class="textBoxes">

            <label for="apellido" class="textUI" >Apellido:</label>
            <input type="text" id="apellido" class="textBoxes" style="border-color: black; width: 250px;">

            <label for="edad" class="textUI" style="margin-right: 5px;">Edad: </label>
            <input type="number" id="edad" class="textBoxes" style="border-color: black;"><br>

            <label for="birthday" class="textUI" style="margin-right: 5px;">Fecha de Nacimiento: </label>
            <input type="date" id="birthday" min="1900-01-01" max="2099-12-31" class="textBoxes" style="margin-bottom: 20px; border-color: black;"><br><br>

            <button onclick="confirmarAgregarAlumno()">Agregar</button>
        </div>
    </div>
</body>
@endsection

@section('js')
<script>
        var alumnos = [
        {matricula: '1', nombre: 'Gerardo', apellido: 'Cruz', edad: '18', birthday: '2005-07-04'},
        {matricula: '2', nombre: 'Abigail', apellido: 'Ramirez', edad: '17', birthday: '2005-06-13'},
        {matricula: '3', nombre: 'Edwin', apellido: 'Lopez', edad: '19', birthday: '2005-02-25'},
    ];

    function dibujarAlumnos() {
        var listaAlumnos = document.getElementById('listaAlumnos');
        listaAlumnos.innerHTML = '';

        alumnos.forEach(function(alumnos, index) {
            var div = document.createElement('div');
            div.className = 'alumno';
            div.setAttribute('style','text-align: center; margin-bottom: 5px');

            var inputMatricula = document.createElement('input');
            inputMatricula.type = 'number';
            inputMatricula.value = alumnos.matricula;
            inputMatricula.setAttribute('data-index', index);
            inputMatricula.setAttribute('placeholder', 'Matricula');
            inputMatricula.setAttribute('class', 'textBoxesMat');

            var inputNombre = document.createElement('input');
            inputNombre.type = 'text';
            inputNombre.value = alumnos.nombre;
            inputNombre.setAttribute('data-index', index);
            inputNombre.setAttribute('placeholder', 'Nombre');
            inputNombre.setAttribute('class', 'textBoxes');


            var inputApellido = document.createElement('input');
            inputApellido.type = 'text';
            inputApellido.value = alumnos.apellido;
            inputApellido.setAttribute('data-index', index);
            inputApellido.setAttribute('placeholder', 'Apellido');
            inputApellido.setAttribute('class', 'textBoxes');

            var inputEdad = document.createElement('input');
            inputEdad.type = 'number';
            inputEdad.value = alumnos.edad;
            inputEdad.setAttribute('data-index', index);
            inputEdad.setAttribute('placeholder', 'Edad');
            inputEdad.setAttribute('class', 'textBoxesMat');

            var inputBirthday = document.createElement('input');
            inputBirthday.type = 'date';
            inputBirthday.value = alumnos.birthday;
            inputBirthday.setAttribute('data-index', index);
            inputBirthday.setAttribute('placeholder', 'fecha de nacimiento');
            inputBirthday.setAttribute('class', 'textBoxes');


            var button = document.createElement('button');
            button.textContent = 'Borrar';
            button.setAttribute('style','margin-right: 10px; margin-left: 10px; background-color: red');
            button.onclick = function() {
                borrarAlumno(index);
            };

            // var buttonEdit = document.createElement('button');
            // buttonEdit.textContent = 'Editar';
            // buttonEdit.onclick = function() {
            //     editarAlumno(index);
            // }



            div.appendChild(inputMatricula);
            div.appendChild(inputNombre);
            div.appendChild(inputApellido);
            div.appendChild(inputEdad);
            div.appendChild(inputBirthday);
            div.appendChild(button);
            // div.appendChild(buttonEdit);

            listaAlumnos.appendChild(div);
        });
    }

    function OrdAgeMenorMayor() {
        alumnos.sort(function(a,b){return a.edad - b.edad });
        dibujarAlumnos();
    }

    function OrdAgeMayorMenor() {
        alumnos.sort(function(a,b){return a.edad - b.edad });
        alumnos.reverse();
        dibujarAlumnos();
    }

    function mostrarModal() {
        document.getElementById('modalAgregar').style.display = 'block';
    }

    function cerrarModal() {
        document.getElementById('modalAgregar').style.display = 'none';
    }

    function confirmarAgregarAlumno() {
        
        var nuevoMatricula = document.getElementById('matricula').value;
        var nuevoNombre = document.getElementById('nombre').value;
        var nuevoApellido = document.getElementById('apellido').value;
        var nuevoEdad = document.getElementById('edad').value;
        var nuevoBirthday = document.getElementById('birthday').value;

        if (nuevoMatricula && nuevoNombre && nuevoApellido && nuevoEdad && nuevoBirthday) {
            alumnos.push({matricula: nuevoMatricula , nombre: nuevoNombre , apellido: nuevoApellido , edad: nuevoEdad, birthday: nuevoBirthday});
            dibujarAlumnos();
            cerrarModal();
            matricula.value = "";
            nombre.value = "";
            apellido.value = "";
            edad.value = "";
            birthday.value = "";

        } else {
            alert('Por favor, complete el campo restante');
        }
    }

    function borrarAlumno(index) {
        alumnos.splice(index, 1);
        dibujarAlumnos();
    }

    dibujarAlumnos();
</script>
@endsection


