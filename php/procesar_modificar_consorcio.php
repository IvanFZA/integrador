<?php
include 'conexion.php'; // Conexión a la base de datos

if (isset($_POST['id_consorcio'], $_POST['nombre'], $_POST['coordenadas'], $_POST['descripcion'])) {
    $id_consorcio = $_POST['id_consorcio'];
    $nombre = $_POST['nombre'];
    $coordenadas = $_POST['coordenadas'];
    $descripcion = $_POST['descripcion'];
    $imagen_actual = $_POST['imagen_actual'];

    // Verificar si se ha subido una nueva imagen
    if (!empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        
        // Mover la nueva imagen al directorio 'uploads'
        move_uploaded_file($imagen_tmp, "uploads/" . $imagen);
    } else {
        // Mantener la imagen actual si no se sube una nueva
        $imagen = $imagen_actual;
    }

    // Consulta para actualizar el consorcio
    $sql = "UPDATE consorcios SET nombre = ?, imagen = ?, coordenadas = ?, descripcion = ? WHERE id_consorcio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $imagen, $coordenadas, $descripcion, $id_consorcio);

    if ($stmt->execute()) {
        echo "Consorcio modificado correctamente.";
    } else {
        echo "Error al modificar el consorcio: " . $stmt->error . "";
    }

    $stmt->close();
} else {
    echo "Por favor, completa todos los campos requeridos.";
}

$conn->close();
?>