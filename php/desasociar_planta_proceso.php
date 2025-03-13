<?php
include 'conexion.php'; // Conexión a la base de datos

// Verificamos si los parámetros han sido proporcionados
if (isset($_GET['id_planta']) && isset($_GET['id_consorcio'])) {
    $id_planta = intval($_GET['id_planta']);
    $id_consorcio = intval($_GET['id_consorcio']);

    // Eliminar la relación de la tabla intermedia `planta_consorcio`
    $sql = "DELETE FROM planta_consorcio WHERE id_planta = ? AND id_consorcio = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ii", $id_planta, $id_consorcio);

        // Ejecutar la eliminación
        if ($stmt->execute()) {
            echo "Planta desasociada del consorcio correctamente.";
        } else {
            echo "Error al desasociar la planta: " . $stmt->error;
        }

        $stmt->close(); // Cerrar la consulta
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

} else {
    echo "No se proporcionó un ID de planta o consorcio válido.";
}

$conn->close();
?>
