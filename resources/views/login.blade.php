<?php 
    $sessionExito=session('exito');
    $sessionError=session('error');
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
                <div class="col-12">
                    <div class="card">                        
                        <div class="card-body text-center BodyCardFondo">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                    <h2 class="card-title">Login</h2>
                                    </div>
                                </div>
                                <form class="row" action="/login" mehtod="GET">
                                    <div class="col-12 col-md-6 mr-2 mt-4">
                                        <div class="row">
                                            <div class="col-4 col-md-12 col-lg-12  col-xl-4">
                                                <label for="exampleInputEmail1">Correo</label>
                                            </div>
                                            <div class="col-7 col-md-12 col-lg-12 col-xl-7">
                                                <input type="email" class="form-control" name="log" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">                                        
                                            </div>                                        
                                        </div>                                      
                                    </div>
                                    <div class="col-12 col-md-5 mr-2 mt-4">
                                        <div class="row">
                                            <div class="col-4 col-md-12 col-lg-12  col-xl-4">
                                            <label for="exampleInputPassword1">Password</label>
                                            </div>
                                            <div class="col-7 col-md-12 col-lg-12 col-xl-7">
                                            <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
                                            </div>                                        
                                        </div>
                                    </div>                                  
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                    </div>                               
                                </form>
                            </div>                            
                        </div>
                    </div>
                    
                </div>                
            </div>
            @if(isset($sessionError))
                <div class="row mt-3">
                    <div class="col-12 mt-2 d-flex justify-content-center">
                        
                        <div class="alert alert-danger" role="alert">
                        {{$sessionError}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($sessionExito))
                <div class="row mt-3">
                    <div class="col-12 mt-2 d-flex justify-content-center">
                        <div class="alert alert-success" role="alert">
                        {{$sessionExito}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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