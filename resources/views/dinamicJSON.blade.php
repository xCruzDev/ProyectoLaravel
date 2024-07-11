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
            <button class="btn btn-primary" id="addObject">Agregar Datos Al Objeto</button>
            <button class="btn btn-secondary" id="newObject">Crear Nuevo Objeto</button>
        </div>
    </div>
    <div>
        objetos:
        <select class="form-select" id="cbxObj" style="margin-bottom: 20px">
        <option selected disabled hidden>-- Seleciona un Objeto --</option>
        </select>
        <h3>Datos del objeto Seleccionado</h3><br>
        <table class="table table-hover table-striped">
            <thead class="table-info">
                <tr class="row row-cols-2">
                    <th>Key</th>
                    <th>Value</th>    
                </tr>
            </thead>
            <tbody id="tbody-objs">

            </tbody>
        </table>    
    </div>
</div>
@endsection

@section('js')
<script>
var array = [];

    $(document).ready(function(){

        $('#newObject').click(function(){
            array.push({});
            console.log(array);

            $('#cbxObj').empty().append('<option selected disabled hidden>-- Seleciona un Objeto --</option>)');

            array.forEach((item, index) => {
                $('#cbxObj').append('<option value="' + index +'"> Objeto ' + (index+1));
            });
        });

        $('#addObject').click(function() {
            var posicion = $('#cbxObj').val();
            var key = $('#txbKey').val();
            var value = $('#txbVal').val();

            array[posicion][key] = value;
            loadObject(posicion);

            $('#txbKey').val('');
            $('#txbVal').val('');
            $('#txbKey').focus();

        });

        $('#cbxObj').change(function() {
            var SelectedIndex = $(this).val();
            console.log(SelectedIndex);
            loadObject(SelectedIndex);

        });

        function loadObject (index){
            console.log(array[index]);

            const tableBody = $('#tbody-objs');
            tableBody.empty();

            var objeto = array[index];
            for(const key in objeto) {
                const row = `<tr class="row row-cols-2">
                    <td>${key}</td>
                    <td>${objeto[key]}</td>
                    </tr>`
                tableBody.append(row);
            }
        }

    });
</script>
@endsection 