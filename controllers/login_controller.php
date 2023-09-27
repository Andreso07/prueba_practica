<?php

require_once "../Models/consultas_model.php";

class ControladorLogin
{
    /**
     * Controla el proceso de inicio de sesión del usuario.
     * Esta función inicia una sesión, verifica las credenciales proporcionadas por el usuario
     * y, si son válidas, inicia sesión y redirige al usuario a la página principal.
     * En caso de credenciales inválidas, muestra un mensaje de error y destruye la sesión.
     */
    public static function ctrIngresoUsuario()
    {
        session_start();

        if (isset($_POST["ingUsuario"])) {
            $usuario = $_POST["ingUsuario"];
            $contrasena = $_POST["ingPassword"];

            // Realiza la autenticación en el modelo
            $verificarLogin = ConsultasModel::mdlLoginUsuario(
                $usuario,
                $contrasena
            );

            if ($verificarLogin !== null) {
                // Inicio de sesión exitoso
                // session_start();
                $_SESSION["usuario_so"] = $verificarLogin->usuario;
                $_SESSION["password"] = $verificarLogin->password;
                header("location:index.php"); // Redirige a la página principal
            } else {
                echo '<br><div class="alert alert-danger">Error, vuelve a intentarlo</div>';
                session_destroy();
            }
        }
    }
}
