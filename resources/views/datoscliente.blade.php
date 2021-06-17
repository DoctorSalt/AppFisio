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
        <link rel="stylesheet" href="{{asset('assets/css/general.css')}}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg fondoNav">
            <button class="navbar-toggler  navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>                  
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/Cliente/Inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Cliente/RealizarCitas">Realizar Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Cliente/MisCitas">Mi Cita</a></li>
                    <li class="nav-item active"><a class="nav-link" href="/Cliente/Datos">Mis datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>
        <div class="container mt-4 text-center">            
            <div class="card">                
                <div class="card-body BodyCardFondo">        
                <div class="row">
                    <div class="col-12">
                        <h1 class="card-title">Mis datos</h1>
                    </div>
                </div>        
                <form method="POST" action="/ActualizacionDatosCliente">
            @csrf
                <div class="row mt-4">
                    <div class="col-12 col-md-5 col-lg-4 mr-2 mt-4">
                        <div class="row">
                            <div class="col-4 col-md-12 col-lg-12  col-xl-4 mt-2">
                                <label for="nombreInput">Nombre</label>
                            </div>
                            <div class="col-7 col-md-12 col-lg-12 col-xl-7">
                                <input type="text" placeholder="Aqui ha de yacer el nombre" class="form-control"
                                name="nombre" id="nombreInput" value="{{$datosCliente['nombreCliente']}}">
                            </div>
                        </div>                        
                    </div>
                    <div class="col-12 col-md-5 col-lg-4 mr-2 mt-4">
                        <div class="row">
                            <div class="col-4 col-md-12 col-lg-12  col-xl-4 mt-2">
                                <label for="apellidoInput">Apellido</label>
                            </div>
                            <div class="col-7 col-md-12 col-lg-12 col-xl-7">
                                <input type="text" placeholder="Aqui ha de yacer el apellido" class="form-control" 
                                name="apellido" id="apellidoInput" value="{{$datosCliente['apellidoCliente']}}">
                            </div>
                        </div>                       
                    </div>
                    <div class="col-12 col-md-5 col-lg-3 mr-2 mt-4">
                        <div class="row">
                            <div class="col-4 col-md-12 col-lg-12  col-xl-4 mt-2">
                                <label for="dniInput">DNI</label>
                            </div>
                            <div class="col-7 col-md-12 col-lg-12 col-xl-7">
                                <input type="text" maxlength="9" placeholder="Aqui ha de yacer el dni" max="9" 
                                class="form-control" name="dni" id="dniInput" value="{{$datosCliente['dniCliente']}}">
                            </div>
                        </div> 
                    </div>                   
                </div>
                <div class="row mt-2">
                        <div class="col-12 col-md-5 mr-2 mt-4">
                            <div class="row">
                                <div class="col-4 col-md-12 col-lg-12  col-xl-4 mt-2">
                                    <label for="emailInput">Email</label>
                                </div>
                                <div class="col-7 col-md-12 col-lg-12 col-xl-7">
                                    <input type="email" placeholder="Aqui ha de yacer el email"
                                    class="form-control" name="email" id="emailInput" value="{{$datosCliente['correoCliente']}}">                                        
                                </div>                                        
                            </div>                                      
                        </div>
                        <div class="col-12 col-md-5 mr-2 mt-4">
                            <div class="row">
                                <div class="col-4 col-md-12 col-lg-12  col-xl-4 mt-2">
                                    <label for="passInput">Contraseña</label>
                                </div>
                                <div class="col-7 col-md-12 col-lg-12 col-xl-7">
                                    <input type="password" placeholder="Aqui ha de yacer el contraseña" class="form-control" name="contrasenia" id="passInput">
                                </div>                                        
                            </div>
                        </div>                   
                </div>
                <div class="row mt-4">   
                    <div class="col-12">
                        <button type="submmit" class="btn btn-primary">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>                
                </div>
            </div>
            <div class="row mt-2">   
                <div class="col-12">             
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
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>