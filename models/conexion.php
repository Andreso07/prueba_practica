<?php

require_once "../config/config.php";

class Conexion
{
   /**
    * Obtiene una instancia de la conexión a la base de datos.
    *
    * @return PDO|null Una instancia de la conexión a la base de datos o null si hay un error.
    */
   public static function getConnect()
   {
      $connect ="pgsql:host=" . DB_HOST . ";port=5432;dbname=" . DB_NAME . ";";
      try {
            $conn = new PDO($connect, DB_USER, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo '<script>alert("conexion exitosa!");</script>';
            return $conn;
      } catch (PDOException $e) {
         echo "ERROR " . $e->getMessage();
      }
      return null;
   }
}
