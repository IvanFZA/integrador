<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include 'conexion.php';

    // Inicializar mensaje
    $message = "";

    // Verificar si se pasa un mensaje de error o éxito
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'campos_vacios') {
            $message = "<p style='color: red;'>Por favor, completa todos los campos.</p>";
        } elseif ($_GET['error'] == 'consulta_fallida') {
            $message = "<p style='color: red;'>Error al preparar la consulta.</p>";
        } elseif ($_GET['error'] == 'actualizacion_fallida') {
            $message = "<p style='color: red;'>Error al actualizar la pregunta.</p>";
        }
    } elseif (isset($_GET['success'])) {
        if ($_GET['success'] == 'actualizacion_exitosa') {
            $message = "<p style='color: green;'>Pregunta actualizada con éxito.</p>";
        }
    }

    // Consulta para obtener la pregunta y respuesta con el id
    $sql = "SELECT pregunta, respuesta FROM preguntas_frecuentes WHERE id_pregunta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pregunta = htmlspecialchars($row['pregunta'], ENT_QUOTES);
        $respuesta = htmlspecialchars($row['respuesta'], ENT_QUOTES);

        // Mostrar mensaje si hay uno
        echo $message;

        echo "
        <form id='formulario8' >
            <input type='hidden' name='id' value='$id'>
            
            <div class='mb-3'>
                <label for='pregunta' class='form-label'>Pregunta:</label>
                <textarea id='pregunta' name='pregunta' class='form-control' required>$pregunta</textarea>
            </div>
            <div class='mb-3'>
                <label for='respuesta' class='form-label'>Respuesta:</label>
                <textarea id='respuesta' name='respuesta' class='form-control' required>$respuesta</textarea>
            </div>
             <button type='button' id='boton1' class='btn btn-success btn-lg px-5' onclick='editarPregunta()'> Modificar Pregunta</button>
        </form>";
    } else {
        echo "No se encontró la pregunta.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No se ha proporcionado un ID válido.";
}
?>
