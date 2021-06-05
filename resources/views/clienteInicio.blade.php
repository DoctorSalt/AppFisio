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
        <!-- Nav conteniendo blog -->
        <!-- Nav datos cambiar -->
        <!-- Historial citas -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>                  
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active"><a class="nav-link" href="/Cliente/Inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Cliente/RealizarCitas">Realizar Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Cliente/MisCitas">Mi Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Cliente/Datos">Mis datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>        
        <div class="container">
            <div class="row mt-4">   
                <div class="col-12 text-left"> 
                     <h4>Bienvenido cliente {{$Arreglo['nombre']}} </h4>
                </div>
                <!--
                <div class="col-12 col-lg-6 mt-4 text-center">
                    <h3>Cita más reciente</h3>
                    <div class="card alert alert alert-info text-center mt-3">                    
                        <div class="card-body">
                            <h4 class="card-title">Tiene una cita dentro de 20 dias</h4>
                            <h5 class="card-subtitle mb-2 text-muted">con <strong>Juan Diego Rodriguez</strong></h5>
                            <h5 class="card-subtitle mb-2 text-muted">en Localizacion X</h5>
                            <button class="btn btn-success mt-3">Más detalles</button>
                        </div>
                    </div>                    
                </div> -->
                @if((sizeOf($citasConfirmadas)!=0)||(sizeOf($citasPorConfirmar)!=0))
                <div class="col-12 mt-4">                  
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Cita Confirmadas</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cita por confirmar</a>
                    </div>
                  </nav>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                @if(sizeOf($citasConfirmadas)!=0)
                                    <div class="container">
                                        <div class="row">                            
                                            @foreach($citasConfirmadas as $citaSi)
                                            <div class="col-12 col-md-6 mt-2">
                                                <div class="card alert alert alert-info text-center mt-3">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Tiene una cita el dia {{fechaEspaniol($citaSi['diaCita'])}}</h4>
                                                        <h5 class="card-subtitle mb-2 text-muted">con <strong>{{$citaSi['nombreFisioterapeuta']}}</strong></h5>
                                                        <h5 class="card-subtitle mb-2 text-muted">en {{$citaSi['direccionCita']}}</h5>
                                                        <button class="btn btn-success mt-3">Más detalles</button>
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
                                    <div class="container text-center">
                                        <div class="row">
                                            @foreach($citasPorConfirmar as $cita)
                                                <div class="col-12 col-md-6 mt-2">
                                                    <div class="card alert alert-warning m-2">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Su cita con <strong>{{$cita['nombreFisioterapeuta']}}</strong></h4>
                                                            <h5 class="card-subtitle mb-2 text-muted">El dia {{fechaEspaniol($cita['diaCita'])}} a las {{$cita['horaCita']}} </h5>
                                                            <button href="" class="btn btn-success">Más detalles</button>
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
                @endif
               
                    
            </div>
            @if(sizeOf($citasConfirmadas)==0)
            <div class="row mt-2 text-center">
                <div class="col-12">
                    <button class="btn btn-primary mt-3" type="button">Pedir una cita</button>
                </div>
            </div>
            @endif              
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>