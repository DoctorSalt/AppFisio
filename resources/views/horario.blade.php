<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <h1>Fisioterapeuta -> Horario</h1>                    
                </div>
                <div class="col-12 mt-2">
                    <div class="alert alert-warning text-center">
                    Las franjas aceptadas son: <br/>
                        8:00 hasta 14:00 para la primera franja y <br/>
                        16:00 hasta 21:00 para la segunda franja 
                    </div>
                </div>
            </div>
            <div class="row mt-2 text-center">
                <div class="col-12">
                    <label for="diaSemana">
                        Dia de la Semana
                    </label>
                    <select class="browser-default custom-select" id="diaSemana">
                        <option value="0" selected>Seleccione dia de la Semana</option>
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miercoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                    </select>
                </div>
                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-primary" id="botonAniadirForm">Añadir</button>
                </div>
            </div>
            <form method="get" action="/Fisio/InsertarHorario" onsubmit="return validateForm()">
            <div class="row mt-2">
                <div class="col-12">
                    <table class="table d-none" id="tablaForm">
                        <thead>
                            <tr>
                                <th scope="col">Dia</th>
                                <th scope="col">Input Mañana 1</th>
                                <th scope="col">Input Mañana 2</th>
                                <th scope="col">Añadir Boton</th>
                                <th scope="col">Input Tarde 1</th>
                                <th scope="col">Input Tarde 2</th>
                                <th scope="col">Eliminar Boton</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="lineas d-none" id="linea1">
                                <td>Lunes</td>
                                <td><input id="dia1-m1" class="form-control" name="diaLunesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia1-m2" class="form-control" name="diaLunesManana2" type="time" min="8:00" max="14:00"></td>
                                <td><button type="button" data-code="1" class="btn btn-success botonesAnadir">Añadir</button></td>
                                <td><input id="dia1-t1" class="d-none form-control" name="diaLunesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia1-t2" class="d-none form-control" name="diaLunesTarde2" type="time" min="16:00" max="21:00"></td>
                                <td><button type="button" data-code="1" class="btn btn-danger botonesEliminar">Eliminar</button></td>
                            </tr>
                            <tr class="lineas d-none" id="linea2">
                                <td>Martes</td>
                                <td><input id="dia2-m1" class="form-control" name="diaMartesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia2-m2" class="form-control" name="diaMartesManana2" type="time" min="8:00" max="14:00"></td>
                                <td><button type="button" data-code="2" class="btn btn-success botonesAnadir">Añadir</button></td>
                                <td><input id="dia2-t1" class="d-none form-control" name="diaMartesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia2-t2" class="d-none form-control" name="diaMartesTarde2" type="time" min="16:00" max="21:00"></td>
                                <td><button type="button" data-code="2" class="btn btn-danger botonesEliminar">Eliminar</button></td>
                            </tr>
                            <tr class="lineas d-none" id="linea3">
                                <td>Miercoles</td>
                                <td><input id="dia3-m1" class="form-control" name="diaMiercolesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia3-m2" class="form-control" name="diaMiercolesManana2" type="time" min="8:00" max="14:00"></td>
                                <td><button type="button" data-code="3" class="btn btn-success botonesAnadir">Añadir</button></td>
                                <td><input id="dia3-t1" class="d-none form-control" name="diaMiercolesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia3-t2" class="d-none form-control" name="diaMiercolesTarde2" type="time" min="16:00" max="21:00"></td>
                                <td><button type="button" data-code="3" class="btn btn-danger botonesEliminar">Eliminar</button></td>
                            </tr>
                            <tr class="lineas d-none" id="linea4">
                                <td>Jueves</td>
                                <td><input id="dia4-m1" class="form-control" name="diaJuevesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia4-m2" class="form-control" name="diaJueveslManana2" type="time" min="8:00" max="14:00"></td>
                                <td><button type="button" data-code="4" class="btn btn-success botonesAnadir">Añadir</button></td>
                                <td><input id="dia4-t1" class="d-none form-control" name="diaJuevesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia4-t2" class="d-none form-control" name="diaJuevesTarde2" type="time" min="16:00" max="21:00"></td>
                                <td><button type="button" data-code="4" class="btn btn-danger botonesEliminar">Eliminar</button></td>
                            </tr>
                            <tr class="lineas d-none" id="linea5">
                                <td>Viernes</td>
                                <td><input id="dia5-m1" class="form-control" name="diaViernesManana1" type="time" min="8:00" max="14:00"></td>
                                <td><input id="dia5-m2" class="form-control" name="diaVierneslManana2" type="time" min="8:00" max="14:00"></td>
                                <td><button type="button" data-code="5" class="btn btn-success botonesAnadir">Añadir</button></td>
                                <td><input id="dia5-t1" class="d-none form-control" name="diaViernesTarde1" type="time" min="16:00" max="21:00"></td>
                                <td><input id="dia5-t2" class="d-none form-control" name="diaViernesTarde2" type="time" min="16:00" max="21:00"></td>
                                <td><button type="button" data-code="5" class="btn btn-danger botonesEliminar">Eliminar</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <button type="submit" class="d-none btn btn-primary" id="botonEnviarForm">Enviar</button>
                    <input class="d-none" name="idUsuario" value="<?php echo $idFisio ?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12" id="error">
                    
                </div>
            </div>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/horario.js')}}" type="text/javascript"></script>
    </body>
</html>
