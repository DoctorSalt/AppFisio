<?php 
    $sessionExito=session('exito');
    $sessionError=session('error');
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('assets/css/general.css')}}">
    </head>
    <nav class="navbar navbar-expand-lg fondoNav">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>                  
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            @if($tipoUsuario=="cliente")
                <li class="nav-item">
                    <a class="nav-link" href="/registrarse/Fisioterapeuta">Registrarse como Fisioterapeuta</a>
                </li>
            @endif
            @if($tipoUsuario=="fisio")
                <li class="nav-item active">
                    <a class="nav-link" href="/registrarse/Cliente">Registrarse como Cliente</a>
                </li>
            @endif
                <li class="nav-item">
                <li class="nav-item">
                    <a class="nav-link" href="/">Loguearse</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand">LAS FISIOS</a>            
    </nav>
    <body>
        <div class="container mt-4 text-center">      
            <div class="row">
                <div class="col-12">
                    <div class="card m-5">
                        <div class="card-header CabeceraCardFondo">
                            <h3>Registo {{$tipoUsuario}}</h3>
                        </div>
                        <div class="card-body BodyCardFondo">
                            <form method="GET" class="container" action="/registrarseProceso">
                                <div class="row">
                                    <div class="col-12">                
                                        <input type="text"  class="d-none" value="cliente" name="tipoUsuario">
                                    </div>
                                    <div class="col-12 col-md-6 mt-2">
                                        <label for="nombreInput">Nombre</label>
                                        <input type="text" placeholder="Aqui ha de yacer el nombre" class="form-control" name="nombre" id="nombreInput">
                                    </div>
                                    <div class="col-12 col-md-6 mt-2">
                                        <label for="apellidoInput">Apellido</label>
                                        <input type="text" placeholder="Aqui ha de yacer el apellido" class="form-control" name="apellido" id="apellidoInput">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-md-6">
                                        <label for="emailInput">Email</label>
                                        <input type="email" placeholder="Aqui ha de yacer el email" class="form-control" name="email" id="emailInput">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="passInput">Contraseña</label>
                                        <input type="password" placeholder="Aqui ha de yacer el contraseña" class="form-control" name="contrasenia" id="passInput">
                                    </div> 
                                </div>          
                                @if($tipoUsuario=="cliente")
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <label for="dniInput">DNI</label>
                                        <input type="text"  maxlength="9" placeholder="Aqui ha de yacer el dni" max="9" class="form-control" name="dni" id="dniInput">
                                    </div>
                                </div>
                                @endif                               
                                @if($tipoUsuario=="fisio")
                                <div class="row mt-4">                
                                    <div class="col-12 col-md-6">
                                        <label for="especialidadInput">Especialidad</label>
                                        <input type="textarea" placeholder="Aqui ha de yacer el especialidad" class="form-control" name="especialidad" id="especialidadInput">
                                    </div> 
                                    <div class="col-12 col-md-6">
                                        <label for="provinciaInput">Provincia</label>
                                        <select  class="form-control" name="provincia" id="provinciaSelect">
                                            <option value="Sevilla">Sevilla</option>
                                            <option value="Huelva">Huelva</option>
                                            <option value="Granada">Granada</option>
                                            <option value="Málaga">Málaga</option>
                                            <option value="Cádiz">Cádiz</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">                
                                    <div class="col-12 col-md-6">
                                        <label for="tiempoInput">Minimo tiempo en minutos</label>
                                        <input type="number" placeholder="Aqui ha de yacer el tiempo en minutos" class="form-control" name="tiempo" id="tiempoInput">
                                    </div> 
                                    <div class="col-12 col-md-6">
                                        <label for="precioInput">Precio por Minuto</label>
                                        <input type="number" placeholder="Aqui ha de yacer el precio" class="form-control" name="precio" id="precioInput">
                                    </div>  
                                </div>
                                <div class="row mt-4">               
                                    <div class="col-12">
                                        <label for="descripcionInput">Descripción</label>
                                        <input type="textarea" placeholder="Aqui ha de yacer el descripcion" class="form-control" name="descripcion" id="descripcionInput">
                                    </div> 
                                </div>                               
                                @endif
                                <div class="row mt-4">   
                                    <div class="col-12">
                                        <button type="submmit" class="btn btn-success">
                                            Enviar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col-12 text-center">
                </div>
            </div>
                
            </div>    
            @if(isset($sessionError))
                <div class="row mt-3">
                    <div class="col-12 alert alert-danger">
                        <div class="alert alert-danger" role="alert">
                        {{$sessionError}}
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($sessionExito))
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                        {{$sessionExito}}
                        </div>
                    </div>
                </div>
            @endif       
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        @if($tipoUsuario=="fisio")
            <script src="{{asset('assets/js/registrarse.js')}}" type="text/javascript"></script>
        @endif
    </body>   
</html>