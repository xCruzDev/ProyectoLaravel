@extends('templates.principal')

@section('style')

@endsection

@section('body')
<div class="container" style="margin-top: 5%">
    <div class="row">
        <div class="col text-center">
            <select name="ColorCBX" id="colorType">
                <option value="1">---Selecionar---</option>
                <option value="colorRandom">Color Aleatorio</option>
                <option value="colorText">Color Texto</option>
            </select><br><br>
        </div>
        <div class="col" id="RandColor">
            <button class="btn btn-primary">Clickeame</button><br><br>
        </div>
        <div class="col" id="textColor">
            Texto
            <input type="text" id="txb">
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function(){
    
    $('#RandColor').hide();
    $('#textColor').hide();


    $('#colorType').change(function() {
    if ($(this).val() === 'colorRandom') {
        $('#textColor').hide();
        $('#RandColor').show();
    }
    else if ($(this).val() === 'colorText'){
        $('#RandColor').hide();
        $('#textColor').show();
    }
    });

    $('.btn-primary').click(function (){
        var colorRand = "#"+ Math.floor(Math.random()*16777215).toString(16);
        $('body').css("background-color",colorRand);
    });

    $('input').on('input', function() {
        var texto = $(this).val();
        $('body').css("background-color",texto);
        console.log(texto);
});

})
</script>
@endsection
