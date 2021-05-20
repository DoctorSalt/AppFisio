<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container text-center">
            <div class="row">
                <div class="col-12 mt-4">
                    <h1>Fisioterapeutas<h1>
                </div>                
            </div>
            <div class="row mt-4">
                <div class="col-12">
                @if(isset($listaFisio))          
                    <table class="table"> 
                        <thead class="thead-dark">
                            <tr>                  
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Tiempo en min</th>
                                <th scope="col">Precio por min</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Contraseña</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($listaFisio as $fisio)
                            <tr>
                                <td>{{$fisio['nombreFisioterapeuta']}}</td>
                                <td>{{$fisio['apellidoFisioterapeuta']}}</td>
                                <td>{{$fisio['especialidadFisioterapeuta']}}</td>
                                <td>{{$fisio['tiempoFisioterapeuta']}}</td>
                                <td>{{$fisio['precioFisioterapeuta']}}</td>
                                <td>{{$fisio['correoFisioterapeuta']}}</td>
                                <td>{{$fisio['passwordFisioterapeuta']}}</td>
                            </tr>            
                    @endforeach
                        </tbody>
                    </table>            
                @endif
                </div>
            </div>
        </div>        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>