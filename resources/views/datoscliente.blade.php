<?php 
    $nombre=session('Nombre');
    $idActual=session('id');
    $tipo=session('tipo');
    session()->flash('id',$idActual);
    session()->flash('tipo',$tipo);
    session()->flash('Nombre',$nombre);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>                  
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/Cliente/Inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Cliente/MisCitas">Mi Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Login">Mis Bonos</a></li>
                    <li class="nav-item active"><a class="nav-link" href="/Cliente/Datos">Mis datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>
        <div class="container mt-4 text-center">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Mis datos</h1>
                </div>
                @if(isset($detallesError))
                    <div class="alert alert-danger" role="alert">
                        {{$detallesError}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(isset($detallesExito))
                    <div class="alert alert-success" role="alert">
                        {{$detallesExito}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif        
            </div>
            <form method="POST" action="/ActualizacionDatosCliente">
            @csrf
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="nombreInput">Nombre</label>
                        <input type="text" placeholder="Aqui ha de yacer el nombre" class="form-control"
                         name="nombre" id="nombreInput" value="{{$datosCliente['nombreCliente']}}">
                    </div>
                    <div class="col-6">
                        <label for="apellidoInput">Apellido</label>
                        <input type="text" placeholder="Aqui ha de yacer el apellido" class="form-control" 
                        name="apellido" id="apellidoInput" value="{{$datosCliente['apellidoCliente']}}">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="dniInput">DNI</label>
                        <input type="text" maxlength="9" placeholder="Aqui ha de yacer el dni" max="9" 
                        class="form-control" name="dni" id="dniInput" value="{{$datosCliente['dniCliente']}}">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="emailInput">Email</label>
                        <input type="email" placeholder="Aqui ha de yacer el email"
                         class="form-control" name="email" id="emailInput" value="{{$datosCliente['correoCliente']}}">
                    </div>
                    <div class="col-6">
                        <label for="passInput">Contraseña</label>
                        <input type="password" placeholder="Aqui ha de yacer el contraseña" class="form-control" name="contrasenia" id="passInput">
                    </div> 
                </div>
                <div class="row mt-4">   
                    <div class="col-12">
                        <button type="submmit" class="btn btn-success">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>