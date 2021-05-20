<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>                  
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active"><a class="nav-link" href="/Login">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Login">Mi Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Login">Mis Bonos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Login">Mis datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/PicadosAdmin">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Deslogarse">Deslogarse</a></li>
                </ul>
            </div>
            <a class="navbar-brand">Cooperativas Agro-alimentarias</a>            
    </nav>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                  <div class="form-group">
                      <label for="nombreInput">Nombre</label>
                      <input type="text" class="form-control" name="nombre" id="nombreInput" placeholder="Marc">
                  </div>
                  <div class="form-group">
                      <label for="apellidoInput">Apellido</label>
                      <input type="text" class="form-control" name="apellido" id="apellidoInput" placeholder="Dong">
                  </div>
                  <div class="form-group">
                      <label for="especialidadInput">Especialidad</label>
                      <input type="text" class="form-control" name="especialidad" id="especialidadInput" placeholder="Congo">
                  </div>
                  <div class="form-group">
                      <label for="tiempoInput">Tiempo (Minutos)</label>
                      <input type="number" class="form-control" name="tiempo" id="tiempoInput" placeholder="10">
                  </div>
                  <div class="form-group">
                      <label for="correoInput">Correo</label>
                      <input type="email" class="form-control" name="correo" id="correoInput" placeholder="email@example.com">
                  </div>
                  <div class="form-group">
                      <label for="passInput">Contraseña</label>
                      <input type="password" class="form-control" name="pass" id="passInput" placeholder="******">
                  </div>
            </div>
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
