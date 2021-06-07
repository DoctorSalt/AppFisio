<?php 
    $detallesExito="";
    if($Exito!=""){
        $detallesExito=$Exito;
    }
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
        <link rel="stylesheet" href="{{asset('assets/css/general.css')}}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg fondoNav">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>                  
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/Fisioterapeuta/Inicio">Inicio</a></li>
                    <li class="nav-item active"><a class="nav-link" href="/Fisioterapeuta/MisCitas">Mis Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Fisioterapeuta/Datos">Mi Datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>
        <div class="container mt-4">
            <div class="row">   
                <div class="col-12 text-center"> 
                     <h1>Mis Citas</h1>
                </div>
                @if(!empty($detallesExito))
                    <div class="col-12 mt-2">
                    @if($detallesExito=="Se ha incorporado el horario correctamente")
                        <div class="alert alert-success" role="alert">
                            {{$detallesExito}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @else
                        <div class="alert alert-success" role="alert">
                            {{$detallesExito}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    </div>
                @endif               
                @if(sizeOf($citasConfirmadas)!=0)
                <div class="col-12 mt-4 text-center">
                    <div class="card">
                        <div class="card-header CabeceraCardFondo">
                            <h4>Citas Pendientes</h4>
                        </div>
                        <div class="card-body BodyCardFondo">
                            <div class="container">
                                <div class="row">                            
                                    @foreach($citasConfirmadas as $citaSi)
                                    <div class="col-12 col-md-6 mt-3">
                                        <div class="card alert alert alertaCitaSi text-center mt-3">
                                            <div class="card-body">
                                                <h4 class="card-title">Tiene una cita el dia {{fechaEspaniol($citaSi['diaCita'])}}</h4>
                                                <h5 class="card-subtitle mb-2 text-muted">con <strong>{{$citaSi['nombreCliente']}}</strong></h5>
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
                        <div class="card-header CabeceraCardFondo">
                            <h4>Queda por confirmar</h4>
                        </div>
                        <div class="card-body BodyCardFondo">
                            <div class="container">
                                <div class="row">
                                    @foreach($citasPorConfirmar as $cita)
                                    <div class="col-12 col-md-6 mt-3">
                                        <div class="card alert alertaCitaNo m-2">
                                            <div class="card-body">
                                                <h4 class="card-title">Posible cita con <strong>{{$cita['nombreCliente']}}</strong></h4>
                                                <h5 class="card-subtitle mb-2 text-muted">El dia {{fechaEspaniol($cita['diaCita'])}} a las {{$cita['horaCita']}} </h5>
                                                <form action="/ConfirmarCita" method="GET">
                                                    <div class="row mt-4">
                                                        <div class="col-12 col-sm-6">
                                                            <input class="d-none" type="text" name="idCita" value="{{$cita['idCita']}}">
                                                            <label for="localizacionInput">Localizacion</label>
                                                            <input type="text" placeholder="Aqui ha de la localizacion" class="form-control" require
                                                            name="localizacion" id="localizacionInput">
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <?php $precio=$datosFisio[0]['precioFisioterapeuta']*$datosFisio[0]['tiempoFisioterapeuta']?>
                                                            <label for="precioInput">Precio</label>
                                                            <input type="number" placeholder="Aqui ha de yacer el precio" 
                                                            value="{{$precio}}" step="any" class="form-control"
                                                            max={{$precio}} name="precio" id="precioInput" require>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <label for="descripcionInput">Descripción</label>
                                                            <input type="textarea" placeholder="Aqui ha de yacer el descripcion" class="form-control" 
                                                                value="" name="descripcion" id="descripcionInput">
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <button type="submit" class="btn btn-success">Confirmar Cita</button>
                                                        </div>
                                                    </div>
                                                </form>
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