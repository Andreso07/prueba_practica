<?php require "../controllers/registro_controller.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>

<body class="py-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto text-right justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h3>Registrar</h3>
        <a href="registrar.php" class="btn btn-primary float-right">Nuevo registro</a>

        <div class="row py-3">
            <div class="col">
                <table class="table table-border">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $usuarioResult = ConsultasModel::mdlMostrarDatos();

                        $id = "";
                        $nombre = "";
                        $apellido = "";
                        $correo = "";

                        if (
                            $usuarioResult !== null &&
                            is_array($usuarioResult["usuario"])
                        ) {
                            $usuarioArray = $usuarioResult["usuario"]; // Datos en formato de array
                            $usuarioJSON = $usuarioResult["usuarioJSON"]; // Datos en formato JSON

                            // Para mostrar el JSON
                            // echo "Datos en formato JSON: " . $usuarioJSON;

                            // Aquí puedes utilizar los datos del usuario en formato de array

                            foreach ($usuarioArray as $usuario) {

                                $id = $usuario["id"];
                                $nombre = $usuario["nombre"];
                                $apellido = $usuario["apellido"];
                                $correo = $usuario["correo"];

                                // Aquí puedes mostrar los datos de cada usuario
                                ?>
                        <tr>

                            <td><?php echo $id; ?></td>
                            <td><?php echo $nombre; ?></td>
                            <td><?php echo $apellido; ?></td>
                            <td><?php echo $correo; ?></td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a href="editar.php?id=<?php echo $id; ?>" class="btn btn-warning">Editar</a>
                                        <a href="eliminar.php?id=<?php echo $id; ?>"class="btn btn-danger">Eliminar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            // Manejo de caso en el que no se encontró el usuario
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>