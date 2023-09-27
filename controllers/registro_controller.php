<?php
require "../models/consultas_model.php";

class RegistroUsuarioController
{
    /**
     * Controla el proceso de registro de un nuevo usuario.
     * Esta función verifica si se enviaron datos de registro desde un formulario POST,
     * y si es así, procesa esos datos y llama al modelo para registrar al nuevo usuario
     * en la base de datos. Si el registro es exitoso, muestra un mensaje de éxito.
     */
    public static function ctrRegistroUsuario()
    {
        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $usuarioSo = $_POST["usuarioSo"];
            $password = $_POST["password"];
            $correo = $_POST["correo"];

            $resultado = ConsultasModel::mdlRegistroUsuario(
                $nombre,
                $apellido,
                $usuarioSo,
                $password,
                $correo
            );

            if ($resultado == "ok") {
                echo '<script>alert("registro exitoso!");</script>';
            }
        }
    }

    /**
     * Controla el proceso de edición de los datos de un usuario.
     * Esta función verifica si se enviaron datos de edición desde un formulario POST,
     * y si es así, procesa esos datos y llama al modelo para editar los datos del usuario
     * en la base de datos. Si la edición es exitosa, muestra un mensaje de éxito y redirige al index.
     */
    public static function ctrEditar()
    {
        if (isset($_POST["idUser"])) {
            $idUser = $_POST["idUser"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $usuarioSo = $_POST["usuarioSo"];
            $password = $_POST["passw"];
            $correo = $_POST["correo"];

            $resultado = ConsultasModel::mdlEditar(
                $idUser,
                $nombre,
                $apellido,
                $usuarioSo,
                $password,
                $correo
            );

            if ($resultado == "ok") {
                echo '<script>
            alert("registro editado!");
            window.location.href = "index.php";
            </script>';
            }
        }
    }
}
