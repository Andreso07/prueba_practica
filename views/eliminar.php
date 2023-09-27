<?php
require "../models/consultas_model.php";

// Verifica si se recibió un valor "id" a través de POST o GET y lo asigna a $idUser.
if (isset($_POST["id"])) {
    $idUser = $POST["id"];
} else {
    $idUser = $_GET["id"];
}

// Llama a la función del modelo para eliminar un usuario con el ID especificado.
$eliminar = ConsultasModel::mdlEliminarUsuario($idUser);

// Verifica si la eliminación fue exitosa y muestra un mensaje de éxito.
if ($eliminar == "ok") {
    echo '<script>
    alert("registro Eliminado!");
    window.location.href = "index.php";
    </script>';
}

?>
