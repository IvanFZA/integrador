<?php
include 'conexion.php'; // Conexión a la base de datos

// Verificamos si el parámetro 'id_planta' está presente y si es un número válido
if (isset($_GET['id_planta']) && is_numeric($_GET['id_planta'])) {
    $id_planta = intval($_GET['id_planta']); // Convertir el valor a entero
    
    // Primero, eliminar las asociaciones en la tabla intermedia
    $sql_relacion = "DELETE FROM planta_consorcio WHERE id_planta = ?";
    $stmt_relacion = $conn->prepare($sql_relacion);

    if ($stmt_relacion) {
        $stmt_relacion->bind_param("i", $id_planta);
        $stmt_relacion->execute();
        $stmt_relacion->close();
    } else {
        echo "Error al preparar la consulta para eliminar las relaciones de consorcio: " . $conn->error;
        exit();
    }

    // Después, eliminar la planta de la tabla `plantas`
    $sql = "DELETE FROM plantas WHERE id_planta = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la consulta fue preparada correctamente
    if ($stmt) {
        $stmt->bind_param("i", $id_planta);
        
        // Intentar ejecutar la consulta
        if ($stmt->execute()) {
            echo "Planta eliminada correctamente.";
        } else {
            echo "Error al eliminar la planta: " . $stmt->error;
        }

        $stmt->close(); // Cerrar la consulta preparada
    } else {
        // Si hay un error al preparar la consulta
        echo "Error al preparar la consulta SQL: " . $conn->error;
    }
} else {
    echo "No se proporcionó un ID de planta válido o el valor no es numérico.";
}

$conn->close(); // Cerrar la conexión a la base de datos
?>
