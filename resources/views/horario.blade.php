<?php 
$dateActual=new DateTime();
$stringFechaActual=$dateActual->format('Y-m-d');
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
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Mi Horario</h1>                    
                </div>
                <div class="col-12 mt-2 d-flex justify-content-center">
                    <div class="alert alert-info text-center">
                    Las franjas aceptadas son: <br/>
                        <strong>8:00 hasta 14:00</strong> para la <strong>primera</strong> franja y <br/>
                        <strong>16:00 hasta 21:00</strong> para la <strong>segunda</strong> franja 
                    </div>
                </div>
            </div>       
            <form class="row mt-2 BodyCardFondo" method="get" action="/Fisio/InsertarHorario" onsubmit="return validateForm()">
                <div class="col-12">
                    <table class="table text-center  table-responsive-md" id="tablaForm">
                        <thead class="tablaHeader">
                            <tr>
                                <th scope="col">Dia</th>
                                <th scope="col">Hora Inicial de Mañana</th>
                                <th scope="col">Hora Final de Mañana</th>
                                <th scope="col">Hora Inicial de Tarde</th>
                                <th scope="col">Hora Final de Tarde</th>
                            </tr>
                        </thead>
                        <tbody class="tablaBody">
                            <tr class="lineas" id="linea1">
                                <td>Lunes</td>
                                <td><input id="dia1-m1" class="form-control" name="diaLunesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia1-m2" class="form-control" name="diaLunesManana2" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia1-t1" class="form-control" name="diaLunesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia1-t2" class="form-control" name="diaLunesTarde2" type="time" min="16:00" max="21:00"></td>
                            </tr>
                            <tr class="lineas" id="linea2">
                                <td>Martes</td>
                                <td><input id="dia2-m1" class="form-control" name="diaMartesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia2-m2" class="form-control" name="diaMartesManana2" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia2-t1" class="form-control" name="diaMartesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia2-t2" class="form-control" name="diaMartesTarde2" type="time" min="16:00" max="21:00"></td>
                            </tr>
                            <tr class="lineas" id="linea3">
                                <td>Miercoles</td>
                                <td><input id="dia3-m1" class="form-control" name="diaMiercolesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia3-m2" class="form-control" name="diaMiercolesManana2" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia3-t1" class="form-control" name="diaMiercolesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia3-t2" class="form-control" name="diaMiercolesTarde2" type="time" min="16:00" max="21:00"></td>
                            </tr>
                            <tr class="lineas" id="linea4">
                                <td>Jueves</td>
                                <td><input id="dia4-m1" class="form-control" name="diaJuevesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia4-m2" class="form-control" name="diaJuevesManana2" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia4-t1" class="form-control" name="diaJuevesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia4-t2" class="form-control" name="diaJuevesTarde2" type="time" min="16:00" max="21:00"></td>
                            </tr>
                            <tr class="lineas" id="linea5">
                                <td>Viernes</td>
                                <td><input id="dia5-m1" class="form-control" name="diaViernesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia5-m2" class="form-control" name="diaViernesManana2" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia5-t1" class="form-control" name="diaViernesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia5-t2" class="form-control" name="diaViernesTarde2" type="time" min="16:00" max="21:00"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6 mt-2">
                        <label for="fechaInicioInput">Fecha Inicio</label>
                        <input type="date" placeholder="Aqui ha de yacer el dni" 
                        class="form-control" name="fechaInico" id="fechaInico" value="{{$stringFechaActual}}">
                </div>
                <div class="col-6 mt-2">
                        <label for="fechaFinInput">Fecha Fin</label>
                        <input type="date" placeholder="Aqui ha de yacer el dni" 
                        class="form-control" name="fechaFin" id="fechaFinInput" value="">
                </div>
                <div class="col-12 text-center mt-4 mb-4">
                    <input class="d-none" name="idUsuario" value="<?php echo $idFisio ?>">
                    <button type="submit" class="btn btn-primary" id="botonEnviarForm">Enviar</button>                   
                </div>
            </form>
            <div class="row mt-2">
                <div class="col-12" id="error">
                    
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/horario.js')}}" type="text/javascript"></script>
    </body>
</html>
