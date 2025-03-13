<?php
include 'conexion.php'; // Asegúrate de que este archivo esté correctamente configurado para la conexión

// Verifica si los campos requeridos están presentes
if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Manejo de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Procesar la imagen
        $imagen = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        move_uploaded_file($imagen_tmp, "../uploads/" . $imagen);

        // Inserta los datos en la base de datos con imagen
        $sql = "INSERT INTO categoria (nombre, descripcion, imagen) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $descripcion, $imagen);

        // Verificar si la ejecución es exitosa
        if ($stmt->execute()) {
            echo "Categoría agregada correctamente.";
        } else {
            echo "Error al agregar la categoría: " . $stmt->error . "";
        }

        $stmt->close();
    } else {
        // Inserta los datos en la base de datos sin imagen
        $sql = "INSERT INTO categoria (nombre, descripcion, imagen) VALUES (?, ?, ?)";
        $imagen = NULL; // Si no se sube una imagen, se inserta NULL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $descripcion, $imagen);

        // Verificar si la ejecución es exitosa
        if ($stmt->execute()) {
            echo "Categoría agregada correctamente sin imagen.";
        } else {
            echo "Error al agregar la categoría: " . $stmt->error . "";
        }

        $stmt->close();
    }
} else {
    echo "Datos incompletos. Por favor, completa el nombre y la descripción.";
}

$conn->close();
?>
