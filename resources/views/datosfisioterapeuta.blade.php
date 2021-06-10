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
                    <li class="nav-item"><a class="nav-link" href="/Fisioterapeuta/MisCitas">Mis Citas</a></li>
                    <li class="nav-item active"><a class="nav-link" href="/Fisioterapeuta/Datos">Mi Datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>
        <div class="container mt-4 text-center">            
            <div class="card">
                <div class="card-header CabeceraCardFondo">
                    <h1>Mis datos</h1>
                </div>
                <div class="card-body BodyCardFondo">
                <form method="POST" action="/ActualizacionDatosFisio">
                @csrf
                <div class="row mt-4">
                    <div class="col-12 col-md-6">
                        <label for="nombreInput">Nombre</label>
                        <input type="text" placeholder="Aqui ha de yacer el nombre" class="form-control" 
                        name="nombre" id="nombreInput" value="{{$datosFisio['nombreFisioterapeuta']}}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="apellidoInput">Apellido</label>
                        <input type="text" placeholder="Aqui ha de yacer el apellido" class="form-control"
                        name="apellido" id="apellidoInput" value="{{$datosFisio['apellidoFisioterapeuta']}}">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-6">
                        <label for="emailInput">Email</label>
                        <input type="email" placeholder="Aqui ha de yacer el email" class="form-control" 
                        name="email" id="emailInput" value="{{$datosFisio['correoFisioterapeuta']}}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="passInput">Contraseña</label>
                        <input type="password" autocomplete="off" placeholder="Aqui ha de yacer el contraseña si quiere resetearla" class="form-control" name="contrasenia" id="passInput">
                    </div> 
                </div>
                <div class="row mt-4">                
                    <div class="col-12 col-md-6">
                        <label for="especialidadInput">Especialidad</label>
                        <input type="textarea" placeholder="Aqui ha de yacer el especialidad" class="form-control"
                         name="especialidad" id="especialidadInput" value="{{$datosFisio['especialidadFisioterapeuta']}}">
                    </div> 
                    <div class="col-12 col-md-6">
                        <label for="provinciaInput">Provincia</label>
                        <select class="form-control" name="provincia" id="provinciaSelect">
                            @foreach($provincias as $provincia)
                                @if($provincia==$datosFisio['provinciaFisioterapeuta'])
                                    <option selected value="{{$provincia}}">{{$provincia}}</option>
                                @else
                                    <option value="{{$provincia}}">{{$provincia}}</option>
                                @endif
                            @endforeach                             
                        </select>
                    </div>
                </div>
                <div class="row mt-4">   
                    <div class="col-12 col-md-6">
                        <label for="precioInput">Precio por Minuto</label>
                        <input type="number" placeholder="Aqui ha de yacer el precio" 
                        value="{{$datosFisio['precioFisioterapeuta']}}"
                        class="form-control" name="precio" id="precioInput">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="tiempoInput">Minimo tiempo en minutos</label>
                        <input type="number" placeholder="Aqui ha de yacer el tiempo en minutos" 
                        class="form-control" name="tiempo" id="tiempoInput" value="{{$datosFisio['tiempoFisioterapeuta']}}">
                    </div>                     
                    <div class="col-12 mt-2">
                        <label for="descripcionInput">Descripción</label>
                        <input type="textarea" placeholder="Aqui ha de yacer el descripcion" class="form-control" 
                        value="{{$datosFisio['descripcionFisioterapeuta']}}"
                        name="descripcion" id="descripcionInput">
                    </div> 
                </div>
                <div class="row mt-4">   
                    <div class="col-12 col-md-6">
                        <button type="submmit" class="btn btn-primary">
                            Enviar
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <a class="btn btn-info" href="/Fisio/Horario?idFisio=<?php echo $Arreglo['idActual'] ?>">Modificar horario</a>
                    </div>
                </div>
                </form>
                </div>            
            </div>
            <div class="row">              
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
                    <div id="errorJavascript">
                
                    </div>               
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>