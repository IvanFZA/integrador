<?php
include 'conexion.php'; // Asegúrate de tener la conexión a la base de datos

if (isset($_GET['id_pregunta'])) {
    $id_pregunta = intval($_GET['id_pregunta']);

    // Consulta para eliminar la pregunta frecuente
    $sql = "DELETE FROM preguntas_frecuentes WHERE id_pregunta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pregunta);

    if ($stmt->execute()) {
        echo "Pregunta eliminada con éxito.";
    } else {
        echo "Error al eliminar la pregunta: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se proporcionó un ID válido.";
}

$conn->close();
?>
