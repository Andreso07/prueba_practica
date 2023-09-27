<?php require "../controllers/registro_controller.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>

<body class="py-3">
    <div class="container">
        <form class="row g-3" method="post">
            <div class="col-6">
                <label class="form-label" for="nombre">Nombre:</label>
                <input class="form-control" type="text" id="nombre" name="nombre" required>
            </div>
            <div class="col-6">
                <label class="form-label" for="apellido">Apellido:</label>
                <input class="form-control" type="text" id="apellido" name="apellido" required>
            </div>
            <div class="col-6">
                <label class="form-label" for="usuario">Usuario:</label>
                <input class="form-control" type="text" id="usuarioSo" name="usuarioSo" required>
            </div>
            <div class="col-6">
                <label class="form-label" for="password">Contraseña:</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="correo">Correo:</label>
                <input class="form-control" type="email" id="correo" name="correo" required>
            </div>
            <div class="col-12">
                <button class="btn btn-success" type="submit">Enviar</button>
                <a href="index.php" class="btn btn-primary">Regresar</a>
            </div>

            <?php
            $registro = new RegistroUsuarioController();
            $registro->ctrRegistroUsuario();
            ?>
        </form>
    </div>
</body>

</html>