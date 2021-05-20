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
                    <li class="nav-item"><a class="nav-link" href="/Login">Inicio</a></li>
                    <li class="nav-item active"><a class="nav-link" href="/Fisioterapeuta/MisClientes">Mis Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Login">Mi Calendario</a></li>
                    <li class="nav-item "><a class="nav-link" href="/Fisioterapeuta/Datos">Mi Datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/PicadosAdmin">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">FISIO</a>            
        </nav>
        <div class="container mt-4 text-center">
            <div class="row">
                <div class="col-12">
                    <h1>Mis Clientes</h1>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Ver citas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Julio</td>
                                <td>Constant</td>
                                <td>example@example.com</td>
                                <td><button type="button" class="btn btn-primary">Citas</button></td>
                            </tr>
                            <tr>
                                <td>Julio</td>
                                <td>Constant</td>
                                <td>example@example.com</td>
                                <td><button type="button" class="btn btn-primary">Citas</button></td>
                            </tr>
                            <tr>
                                <td>Julio</td>
                                <td>Constant</td>
                                <td>example@example.com</td>
                                <td><button type="button" class="btn btn-primary">Citas</button></td>
                            </tr>
                            <tr>
                                <td>Julio</td>
                                <td>Constant</td>
                                <td>example@example.com</td>
                                <td><button type="button" class="btn btn-primary">Citas</button></td>
                            </tr>
                        </tbody>
                    </table>                
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>