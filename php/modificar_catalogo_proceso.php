<?php
include 'conexion.php'; // Incluir el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Consulta para actualizar el catálogo
    $sql = "UPDATE catalogos SET nombre='$nombre', descripcion='$descripcion' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Catálogo modificado correctamente.";
    } else {
        echo "Error al modificar el catálogo: " . $conn->error;
    }
}

$conn->close();
?>
