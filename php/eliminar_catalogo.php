<?php
include 'conexion.php'; // Conexión a la base de datos

if (isset($_GET['id_categoria'])) { // Asegúrate de que usas 'id_categoria'
    $id_categoria = intval($_GET['id_categoria']); // Convertir el ID a número entero para mayor seguridad

    // Elimina el catálogo de la base de datos
    $sql = "DELETE FROM categoria WHERE id_categoria = ?"; // Cambiado 'id' por 'id_categoria'
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_categoria);

    if ($stmt->execute()) {
        echo "Catálogo eliminado correctamente.";
    } else {
        echo "Error al eliminar el catálogo: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de catálogo no proporcionado."; // Si no se proporciona el id_categoria
}

$conn->close();
?>
