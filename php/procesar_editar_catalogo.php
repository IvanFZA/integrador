<?php
include 'conexion.php'; // Asegúrate de que este archivo esté correctamente configurado

// Mostrar errores para depuración (desactívalo en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['id'], $_POST['nombre'], $_POST['descripcion'])) {
    // Sanitizar y validar entradas
    $id = intval(trim($_POST['id']));
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];

        // Crear directorio si no existe
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Mover archivo a la carpeta de uploads
        move_uploaded_file($imagen_tmp, "uploads/" . $imagen);

        // Consulta para actualizar con imagen
        $sql = "UPDATE categoria SET nombre = ?, descripcion = ?, imagen = ? WHERE id_categoria = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $descripcion, $imagen, $id);
    } else {
        // Consulta para actualizar sin imagen
        $sql = "UPDATE categoria SET nombre = ?, descripcion = ? WHERE id_categoria = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $descripcion, $id);
    }

    // Ejecutar consulta y manejar resultado
    if ($stmt->execute()) {
        echo "Categoría actualizada correctamente.";
    } else {
        echo "Error al actualizar la categoría: " . $stmt->error . "";
    }

    $stmt->close();
} else {
    echo "Datos incompletos. Por favor, verifica e inténtalo de nuevo.";
}

$conn->close();
?>
