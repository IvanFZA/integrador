<?php
session_start();
include 'conexion.php'; // Asegúrate de que este archivo esté correctamente configurado

// Mostrar errores para depuración (desactívalo en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['pregunta'], $_POST['respuesta'])) {
        // Sanitizar y validar entradas
        $id = intval(trim($_POST['id']));
        $pregunta = trim($_POST['pregunta']);
        $respuesta = trim($_POST['respuesta']);

        if (empty($pregunta) || empty($respuesta)) {
            echo "Por favor, completa todos los campos.";
            exit;
        }

        // Preparar y ejecutar la consulta de actualización
        $sql = "UPDATE preguntas_frecuentes SET pregunta = ?, respuesta = ? WHERE id_pregunta = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "Error al preparar la consulta: " . addslashes($conn->error) . "";
            exit;
        }

        $stmt->bind_param("ssi", $pregunta, $respuesta, $id);

        if ($stmt->execute()) {
            echo "Pregunta actualizada con éxito.";
        } else {
            echo "Error al actualizar la pregunta: " . addslashes($stmt->error) . "";
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos requeridos.";
    }
} else {
    echo "Solicitud no válida.";
}

$conn->close();
?>
