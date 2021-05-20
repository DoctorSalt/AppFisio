<?php 
    $sessionExito=session('exito');
    $sessionError=session('error');
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
                    <li class="nav-item active">
                        <a class="nav-link" href="/registrarse/Cliente">Registrarse como Cliente</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/registrarse/Fisioterapeuta">Registrarse como Fisioterapeuta</a>
                    </li>
                </ul>
            </div>
            <a class="navbar-brand">LAS FISIOS</a>            
        </nav>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Login</h1>
                </div>
                <div class="col-12">
                    <form action="/login" mehtod="GET">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo</label>
                            <input type="email" class="form-control" name="log" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
                        </div>  
                        <div class="text-center">
                         <button type="submit" class="btn btn-primary">Inicar</button>
                        </div>
                    </form>
                </div>                
            </div>
            @if(isset($sessionError))
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                        {{$sessionError}}
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($sessionExito))
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                        {{$sessionExito}}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>