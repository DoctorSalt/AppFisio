<?php 
    $nombre=session('Nombre');
    $idActual=session('id');
    $tipo=session('tipo');
    session()->flash('id',$idActual);
    session()->flash('tipo',$tipo);
    session()->flash('Nombre',$nombre);
    function fechaEspaniol($stringFecha){
        $arrayFechas = explode('-',$stringFecha);
        return $arrayFechas[2]."/".$arrayFechas[1]."/".$arrayFechas[0];
    }
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
                    <li class="nav-item"><a class="nav-link" href="/Cliente/RealizarCitas">Realizar Citas</a></li>
                    <li class="nav-item active"><a class="nav-link" href="/Cliente/MisCitas">Mi Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Cliente/Datos">Mis datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>
        <div class="container">
            <div class="row mt-4 text-center">
                <div class="col-12">
                    <h1>Mis Citas</h1>
                </div>
            </div>
           <div class="row mt-3">
                @if(sizeOf($citasConfirmadas)!=0)
                    <div class="col-12 text-center">
                        <div class="card">
                            <div class="card-header">
                                <h3>Citas Pendientes</h3>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">                            
                                        @foreach($citasConfirmadas as $citaSi)
                                        <div class="col-12 col-md-6 mt-3">
                                            <div class="card alert alert alert-info text-center mt-3">
                                                <div class="card-body">
                                                    <h4 class="card-title">Tiene una cita el dia {{fechaEspaniol($citaSi['diaCita'])}}</h4>
                                                    <h5 class="card-subtitle mb-2 text-muted">con <strong>{{$citaSi['nombreFisioterapeuta']}}</strong></h5>
                                                    <h5 class="card-subtitle mb-2 text-muted">en {{$citaSi['direccionCita']}}</h5>
                                                </div>
                                            </div>
                                        </div>                                
                                        @endforeach
                                    </div>                            
                                </div>                            
                            </div>  
                        </div>
                    </div>
                @endif           
                @if(sizeOf($citasPorConfirmar)!=0)
                    <div class="col-12 mt-4 text-center">
                        <div class="card">
                            <div class="card-header">
                                <h3>Queda por confirmar</h3>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        @foreach($citasPorConfirmar as $cita)
                                        <div class="col-12 col-md-6 mt-3">
                                            <div class="card alert alert-warning m-2">
                                                <div class="card-body">
                                                    <h4 class="card-title">Posible cita con <strong>{{$cita['nombreFisioterapeuta']}}</strong></h4>
                                                    <h5 class="card-subtitle mb-2 text-muted">El dia {{fechaEspaniol($cita['diaCita'])}} a las {{$cita['horaCita']}} </h5>                                        
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </div>                                
                @endif
           </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>