<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos


if (!isset($_SESSION['id_administrador'])) {
    echo "Debe iniciar sesión para agregar una pregunta.";
    exit();
}

if (isset($_POST['pregunta'], $_POST['respuesta'])) {
    // Validar que los campos no estén vacíos
    $pregunta = trim($_POST['pregunta']);
    $respuesta = trim($_POST['respuesta']);

    if (empty($pregunta) || empty($respuesta)) {
        echo "Por favor, complete todos los campos.";
    } else {
        $id_administrador = $_SESSION['id_administrador'];

        // Insertar la pregunta en la base de datos
        $sql = "INSERT INTO preguntas_frecuentes (pregunta, respuesta, id_administrador) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $pregunta, $respuesta, $id_administrador);

        if ($stmt->execute()) {
            echo "Pregunta agregada correctamente.";
        } else {
            echo "Error al agregar la pregunta: " . $stmt->error . "";
        }

        $stmt->close();
    }
} else {
    echo "Por favor, complete todos los campos.'";
}

$conn->close();
?>
