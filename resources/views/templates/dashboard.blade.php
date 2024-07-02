<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('style')
    <style>
        .textlk{
            font-size: 20px;
            color: rgb(234, 234, 255);
        }
    </style>    
</head>
<body>
    <div class="row row-cols-2">
        <div class="col-lg-1" style="background-color: rgb(49, 49, 49)">
            <div class="container">

                <a class="textlk" href="/inicio"> < Volver</a><br><br>

                <a href="/mainDashboard" class="nav-link" style="color: white; font-size: 25px">Dashboard</a><br>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link textlk" href="/tblusers">Prueba Tabla</a>
                    </li><br>   
                    <li>
                        <a class="nav-link textlk" href="/products">Productos</a>
                    </li>
                    <li>
                        <a class="nav-link textlk" href="/categories">Categorias</a>
                    </li><br>
                    <li>
                        <a class="nav-link textlk" href="/clients">Clientes</a>
                    </li>
                    <li>
                        <a class="nav-link textlk" href="/addresses">Direcciones</a>
                    </li>
                    <li>
                        <a class="nav-link textlk" href="">Pedidos</a>
                    </li>
                </ul>    
            </div>
        </div>
        <div class="col-lg-11">
            @yield('body')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @yield('js')      
</body>
</html>
