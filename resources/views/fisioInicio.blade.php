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
            <button class="navbar-toggler  navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>                  
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active"><a class="nav-link" href="/Fisioterapeuta/Inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Fisioterapeuta/MisCitas">Mis Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Fisioterapeuta/Datos">Mi Datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>
        <div class="container mt-4">
            <div class="row">   
                <div class="col-12"> 
                     <h3>Bienvenido fisio {{$Arreglo['nombre']}} </h3>
                </div>
                @if(!empty($detallesExito))
                    <div class="col-12 mt-2">
                    @if($detallesExito=="Se ha incorporado confirmada la cita correctamente")
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

                @if((sizeOf($citasConfirmadas)!=0)||(sizeOf($citasPorConfirmar)!=0))
                <div class="col-12 mt-4">                  
                    <nav class="cabeceraTab">
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Cita Confirmadas</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cita por confirmar</a>
                        </div>
                    </nav>
                    <div class="card BodyCardFondo">
                        <div class="card-body">
                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    @if(sizeOf($citasConfirmadas)!=0)
                                    <div class="container">
                                        <div class="row">                            
                                        @foreach($citasConfirmadas as $citaSi)
                                            <div class="col-12 col-md-6 mt-3">
                                                <div class="card alert alertaCitaSi text-center mt-3">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Tiene una cita el dia {{fechaEspaniol($citaSi['diaCita'])}}</h4>
                                                        <h5 class="card-subtitle mb-2 text-muted">con <strong>{{$citaSi['nombreCliente']}}</strong></h5>
                                                        <h5 class="card-subtitle mb-2 text-muted">en {{$citaSi['direccionCita']}}</h5>
                                                        <a  href="/Fisioterapeuta/MisCitas"><button class="btn btn-primary mt-3">Más detalles</button></a>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>                            
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    @if(sizeOf($citasPorConfirmar)!=0)
                                    <div class="container">
                                        <div class="row">
                                            @foreach($citasPorConfirmar as $cita)
                                            <div class="col-12 col-md-6 mt-3">
                                                <div class="card alert alertaCitaNo m-2 text-center">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Posible cita con <strong>{{$cita['nombreCliente']}}</strong></h4>
                                                        <h5 class="card-subtitle mb-2">El dia {{fechaEspaniol($cita['diaCita'])}} a las {{$cita['horaCita']}} </h5>
                                                        <a  href="/Fisioterapeuta/MisCitas"><button class="btn btn-primary mt-3">Confirmar Cita</button></a>
                                                    </div>
                                                </div>
                                            </div>   
                                            @endforeach
                                        </div>   
                                    </div>  
                                    @endif 
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