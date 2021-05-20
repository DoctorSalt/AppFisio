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
                    <li class="nav-item active"><a class="nav-link" href="/Fisioterapeuta/Inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Fisioterapeuta/MisClientes">Mis Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Login">Mi Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Fisioterapeuta/Datos">Mi Datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>
        <div class="container mt-4">
            <div class="row">   
                <div class="col-12"> 
                     <h1>Bienvenido fisio {{$Arreglo['nombre']}} </h1>
                </div>
                <div class="col-12 col-lg-6 mt-4 text-center">
                    <!--Tiene o no tiene citas -->
                    <h3>Cita más reciente</h3>
                    <div class="card alert alert alert-info text-center mt-3">                    
                        <div class="card-body">
                            <h4 class="card-title">Tiene una cita dentro de 20 dias</h4>
                            <h5 class="card-subtitle mb-2 text-muted">con <strong>Jose Miguel</strong></h5>
                            <h5 class="card-subtitle mb-2 text-muted">en Localizacion X</h5>
                            <button class="btn btn-success mt-3">Más detalles</button>
                        </div>
                    </div>                    
                </div>
                <div class="col-12 col-lg-6 mt-4 text-center">
                    <h3>Queda por confirmar</h3>
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col-12 col-md-6">
                                <div class="card alert alert-warning m-2">
                                    <div class="card-body">
                                        <h4 class="card-title">Su cita con <strong>Juan Diego Rodriguez</strong></h4>
                                        <h5 class="card-subtitle mb-2 text-muted">Te Quedan 3 días para confirmar</h5>
                                        <button class="btn btn-success">Más detalles</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card alert alert-warning m-2">
                                    <div class="card-body">
                                    <h4 class="card-title">Cita con <strong>Juan Diego Rodriguez</strong></h4>
                                    <h5 class="card-subtitle mb-2 text-muted">Quedan 3 días para confirmar</h5>
                                    <button class="btn btn-success">Más detalles</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6">
                                <div class="card alert alert-warning m-2">
                                    <div class="card-body">
                                        <h4 class="card-title">Cita con <strong>Juan Diego Rodriguez</strong></h4>
                                        <h5 class="card-subtitle mb-2 text-muted">Quedan 3 días para confirmar</h5>
                                        <button class="btn btn-success">Más detalles</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card alert alert-warning m-2">
                                    <div class="card-body">
                                    <h4 class="card-title">Cita con <strong>Juan Diego Rodriguez</strong></h4>
                                    <h5 class="card-subtitle mb-2 text-muted">Quedan 3 días</h5>
                                    <button class="btn btn-success">Más detalles</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
                <!--Citas que tienes () con quedan x dias-->
                <!--Citas pendientes de confirmar (Resumido) con quedan x dias para el periodo de confirmacion-->
                <!-- Calendario fantasma? -->
                <!-- Bonos que ofreces --> 
                
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>