<?php

require_once "../config/config.php";

class Conexion
{
   public static function getConnect()
   {
      $connect =
            "pgsql:host=" . DB_HOST . ";port=5432;dbname=" . DB_NAME . ";";
      try {
            $conn = new PDO($connect, DB_USER, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo '<script>alert("conexion exitosa!");</script>';
      } catch (PDOException $e) {
         echo "ERROR " . $e->getMessage();
      }
      return $conn;
   }
}
