<?php
include 'conexion.php'; // Conexión a la base de datos

// Verificamos si el parámetro está presente y si es un número válido
if (isset($_GET['id_planta']) && is_numeric($_GET['id_planta'])) {
    $id_planta = intval($_GET['id_planta']); // Convertir el valor a entero

    // Mostrar el ID recibido para verificar
    echo "ID de planta recibido: $id_planta<br>";

    // Eliminar la planta
    $sql = "DELETE FROM plantas WHERE id_planta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_planta);

    if ($stmt->execute()) {
        echo "Planta eliminada correctamente.";
    } else {
        echo "Error al eliminar la planta: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se proporcionó un ID de planta válido.";
}

$conn->close();
?>
