<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

// Consulta para obtener las preguntas frecuentes
$sql = "SELECT id_pregunta, pregunta, respuesta FROM preguntas_frecuentes ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Preguntas Frecuentes</h2>";
    // Bucle para mostrar cada pregunta y respuesta
    while ($row = $result->fetch_assoc()) {
        $id_pregunta = $row['id_pregunta']; // Cambié el nombre del campo según la base de datos modificada
        $pregunta = $row['pregunta'];
        $respuesta = $row['respuesta'];

        echo "
        <div>
            <h3>$pregunta</h3>
            <p>$respuesta</p>
            <button onclick='cargarFormularioEditarPregunta($id_pregunta)'>Editar</button>
            <button onclick='confirmarEliminarPregunta($id_pregunta)'>Eliminar</button>
        </div>";
    }
} else {
    echo "<p>No se encontraron preguntas frecuentes.</p>";
}

$conn->close();
?>
