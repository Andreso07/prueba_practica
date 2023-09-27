<?php
require "conexion.php";

class ConsultasModel
{
    /**
     * Registra un nuevo usuario en la base de datos.
     *
     * @param string $nombre El nombre del usuario.
     * @param string $apellido El apellido del usuario.
     * @param string $usuarioSo El nickname de usuario.
     * @param string $password La contraseña del usuario (en texto plano, solo para fines de prueba).
     * @param string $correo La dirección de correo electrónico del usuario.
     * @return bool True si el registro se realiza con éxito, de lo contrario, false.
     */
    public static function mdlRegistroUsuario(
        $nombre,
        $apellido,
        $usuarioSo,
        $password,
        $correo
    ) {
        $sql = "INSERT INTO usuario (nombre, apellido, correo, usuario_so, password) VALUES (:nombre, :apellido, :correo, :usuarioSo, :password)";
        $stmt = Conexion::getConnect()->prepare($sql);

        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $apellido, PDO::PARAM_STR);
        $stmt->bindParam(":usuarioSo", $usuarioSo, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);

        $stmt->execute();

        $res = $stmt->fetch();

        if ($res != 0) {
            return "ok";
        }
    }

    /**
     * Obtiene y devuelve los datos de todos los usuarios almacenados en la base de datos.
     *
     * @return array|null Un array asociativo con los datos de los usuarios o null si no se encontraron resultados.
     * @throws Exception Si se produce un error al consultar la base de datos.
     */
    public static function mdlMostrarDatos()
    {
        try {
            $sql = "SELECT * FROM usuario";
            $stmt = Conexion::getConnect()->prepare($sql);
            $stmt->execute();

            // Verifica si se encontraron resultados
            if ($stmt->rowCount() > 0) {
                // Devuelve el primer resultado como un array asociativo
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Convierte el array asociativo a formato JSON
                $usuarioJSON = json_encode($usuarios);

                // Devuelve el array asociativo y el JSON
                return [
                    "usuario" => $usuarios,
                    "usuarioJSON" => $usuarioJSON,
                ];
            } else {
                // Retorna un valor que indica que no se encontraron resultados
                return null;
            }
        } catch (Exception $e) {
            throw new Exception(
                "Error al obtener los datos de usuarios: " . $e->getMessage()
            );
        }
    }

    /**
     * Obtiene los datos de un usuario por su identificador único.
     *
     * @param int $id El identificador único del usuario que se desea obtener.
     * @return array|null Un array asociativo con los datos del usuario si se encuentra, o null si no se encuentra.
     */
    public static function mdlMostrarDatosPorId($id)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE id = :id";
            $stmt = Conexion::getConnect()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            // Verifica si se encontraron resultados
            if ($stmt->rowCount() > 0) {
                // Devuelve el primer resultado como un array asociativo
                $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);

                // Convierte el array asociativo a formato JSON
                $usuarioJSON = json_encode($usuarios);

                // Devuelve el array asociativo y el JSON
                return [
                    "usuario" => $usuarios,
                    "usuarioJSON" => $usuarioJSON,
                ];
            } else {
                // Retorna un valor que indica que no se encontraron resultados
                return null;
            }
        } catch (Exception $e) {
            // Lanza una excepción personalizada o maneja el error según tu necesidad
            throw new Exception(
                "Error al consultar el usuario: " . $e->getMessage()
            );
        }
    }

    /**
     * Edita los datos de un usuario en la base de datos.
     *
     * @param int $idUser El identificador único del usuario que se desea editar.
     * @param string $nombre El nuevo nombre del usuario.
     * @param string $apellido El nuevo apellido del usuario.
     * @param string $usuarioSo El nuevo usuarioSo del usuario.
     * @param string $passw El nuevo password del usuario.
     * @param string $correo La nueva dirección de correo electrónico del usuario.
     * @return bool True si la edición se realiza con éxito, de lo contrario, false.
     */
    public static function mdlEditar(
        $idUser,
        $nombre,
        $apellido,
        $usuarioSo,
        $passw,
        $correo
    ) {
        try {
            $sql = "UPDATE usuario SET nombre = :nombre, apellido = :apellido, correo = :correo, usuario_so = :usuarioSo, password = :passw WHERE id = :idUser";
            $stmt = Conexion::getConnect()->prepare($sql);
            $stmt->bindParam(":idUser", $idUser, PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $stmt->bindParam(":usuarioSo", $usuarioSo, PDO::PARAM_STR);
            $stmt->bindParam(":passw", $passw, PDO::PARAM_STR);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);

            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($res != 0) {
                return "ok";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Elimina un usuario de la base de datos por su identificador único.
     *
     * @param int $id El identificador único del usuario que se desea eliminar.
     * @return bool True si la eliminación se realiza con éxito, de lo contrario, false.
     */
    public static function mdlEliminarUsuario($id)
    {
        try {
            $sql = "DELETE FROM usuario WHERE id = :id";
            $stmt = Conexion::getConnect()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            $res = $stmt->fetch();

            if ($res != 0) {
                return "ok";
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Realiza la autenticación de un usuario en la base de datos.
     *
     * @param string $usr El nombre de usuario del usuario que intenta iniciar sesión.
     * @param string $psw La contraseña del usuario que intenta iniciar sesión (texto plano, solo para fines de prueba).
     * @return object|null Un objeto con los datos del usuario autenticado si el inicio de sesión es exitoso, o null si falla.
     */
    public static function mdlLoginUsuario($usr, $psw)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE usuario_so = :usr AND password = :psw";
            $stmt = Conexion::getConnect()->prepare($sql);
            $stmt->bindParam(":usr", $usr, PDO::PARAM_STR, 25);
            $stmt->bindParam(":psw", $psw, PDO::PARAM_STR, 255); // Asegura que la longitud sea suficiente

            $stmt->execute();

            // Verifica si se encontraron resultados
            if ($stmt->rowCount() === 1) {
                $row = $stmt->fetch(PDO::FETCH_OBJ);
                return $row;
            }

            return null; // No se encontró un usuario válido
        } catch (Exception $e) {
            // Lanza una excepción personalizada o maneja el error según sea necesario
            throw new Exception("Error al autenticar: " . $e->getMessage());
        }
    }
}

?>
