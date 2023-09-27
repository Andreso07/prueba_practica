<?php
require "../controllers/registro_controller.php";

// Verifica si se recibió un valor "id" a través de POST o GET y lo asigna a $idUser.
if (isset($_POST["id"])) {
    $idUser = $POST["id"];
} else {
    $idUser = $_GET["id"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>

<body class="py-3">
    <div class="container">

    <?php
    $usuarioResult = ConsultasModel::mdlMostrarDatosPorId($idUser);

    if ($usuarioResult !== null && is_array($usuarioResult["usuario"])) {
        $usuarioArray = $usuarioResult["usuario"]; // Datos en formato de array
        $usuarioJSON = $usuarioResult["usuarioJSON"]; // Datos en formato JSON

        // Aquí puedes utilizar los datos del usuario en formato de array
        $nombre = $usuarioArray["nombre"];
        $apellido = $usuarioArray["apellido"];
        $usuarioSo = $usuarioArray["usuario_so"];
        $password = $usuarioArray["password"];
        $correo = $usuarioArray["correo"];

        // echo "Datos en formato JSON: " . $usuarioJSON;

        ?>
        <form class="row g-3" method="post">
            <div class="col-6">
                <label class="form-label" for="nombre">Nombre:</label>
                <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="col-6">
                <label class="form-label" for="apellido">Apellido:</label>
                <input class="form-control" type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required>
            </div>
            <div class="col-6">
                <label class="form-label">Usuario:</label>
                <input class="form-control" type="text" id="usuarioSo" name="usuarioSo" value="<?php echo $usuarioSo; ?>" required>
            </div>
            <div class="col-6">
                <label class="form-label">Contraseña:</label>
                <input class="form-control" type="password" id="passw" name="passw" value="<?php echo $password; ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="correo">Correo:</label>
                <input class="form-control" type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required>
            </div>
            <div class="col-12">
                <button class="btn btn-success" type="submit">Actualizar</button>
                <a href="index.php" class="btn btn-primary">Regresar</a>
            </div>

            <input type="text" id="idUser" name="idUser" value="<?php echo $idUser; ?>" hidden>

            <?php
            $registro = new RegistroUsuarioController();
            $registro->ctrEditar();
            ?>
        </form>

<?php

    } else {
        // Manejo de caso en el que no se encontró el usuario
    }
    ?>

    </div>

</body>

</html>