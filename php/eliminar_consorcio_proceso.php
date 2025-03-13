<?php
include 'conexion.php';

if (isset($_GET['id_consorcio']) && is_numeric($_GET['id_consorcio'])) {
    $id_consorcio = intval($_GET['id_consorcio']);

    // Eliminar las asociaciones en la tabla intermedia `planta_consorcio`
    $sql_delete_associations = "DELETE FROM planta_consorcio WHERE id_consorcio = ?";
    $stmt_associations = $conn->prepare($sql_delete_associations);

    if (!$stmt_associations) {
        echo "Error al preparar la consulta de desasociación: " . $conn->error;
        exit();
    }

    $stmt_associations->bind_param("i", $id_consorcio);
    $stmt_associations->execute();
    $stmt_associations->close();

    // Eliminar el consorcio
    $sql_delete_consorcio = "DELETE FROM consorcios WHERE id_consorcio = ?";
    $stmt_delete = $conn->prepare($sql_delete_consorcio);

    if (!$stmt_delete) {
        echo "Error al preparar la consulta de eliminación: " . $conn->error;
        exit();
    }

    $stmt_delete->bind_param("i", $id_consorcio);

    if ($stmt_delete->execute()) {
        echo "Consorcio eliminado correctamente.";
    } else {
        echo "Error al eliminar el consorcio: " . $stmt_delete->error;
    }

    $stmt_delete->close();
} else {
    echo "ID de consorcio no válido.";
}

$conn->close();
?>
