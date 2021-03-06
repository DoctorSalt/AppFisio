
<?php 
    $nombre=session('Nombre');
    $idActual=session('id');
    $tipo=session('tipo');
    session()->flash('id',$idActual);
    session()->flash('tipo',$tipo);
    session()->flash('Nombre',$nombre);
    $provincias=["Sevilla","Huelva","Granada","Málaga","Cádiz"];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('assets/js/librerias/fullcalendar-scheduler/main.min.css')}}" rel='stylesheet' />
        <script src="{{asset('assets/js/librerias/fullcalendar-scheduler/main.min.js')}}"></script>
        <script src="{{asset('assets/js/librerias/fullcalendar-scheduler/locales/es.js')}}"></script>
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
                    <li class="nav-item active"><a class="nav-link" href="/Cliente/RealizarCitas">Realizar Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Cliente/MisCitas">Mi Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Cliente/Datos">Mis datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>        
        <div class="container mt-4 text-center">        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header CabeceraCardFondo">
                            <h3>Busqueda de Fisioterapeuta</h3>
                        </div>
                        <div class="card-body BodyCardFondo">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 mt-2 text-right">
                                        <label for="provinciaSelect">Provincia</label>
                                    </div>
                                    <div class="col-5 col-md-3 text-center">
                                        <select class="form-control" name="provincia" id="provinciaSelect">
                                        @foreach($provincias as $provincia)
                                            <option value="{{$provincia}}">{{$provincia}}</option>
                                        @endforeach 
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4 mt-4  mt-md-0 text-center text-md-left">
                                        <button id="botonCrearCalendario" class="btn btn-primary">Realizar Busqueda</button>
                                    </div>
                                </div>                
                            </div>
                        </div>
                    </div>                                                  
                </div>               
            </div>
            <div class="row mt-3">
                <div class="col-12 mt-2 d-flex justify-content-center">
                    <div id="mensajeExito">
                    
                    </div>
                </div>
                <div class="col-12 mt-2 d-flex justify-content-center">
                    <div id="mensajeFallo">
                
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header CabeceraCardFondo">
                            <h4>Fisioterapeutas disponibles</h4>
                        </div>
                        <div class="card-body BodyCardFondo">
                            <div class="ml-5 mr-5" id="tablaBusqueda">
                    
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <input type="text" id="clienteInput" class="d-none" value={{$idActual}} >
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-header CabeceraCardFondo">
                            <h4>Calendario del Fisioterapeuta</h4>
                        </div>
                        <div class="card-body BodyCardFondo">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-header CabeceraCardFondo">
                            <h4>Dia seleccionado</h4>
                        </div>
                        <div class="card-body BodyCardFondo">
                            <div id="fechasResultantes">
                        
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/calendario.js')}}"></script>
    </body>
</html>