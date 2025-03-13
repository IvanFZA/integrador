<?php
include 'conexion.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que todos los campos estén presentes y no estén vacíos
    if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['coordenadas']) && isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $coordenadas = trim($_POST['coordenadas']);

        // Procesar la imagen
        $imagen = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $upload_dir = "../uploads/";
        $imagen_path = $upload_dir . basename($imagen);

        // Mover el archivo cargado al directorio de destino
        if (move_uploaded_file($imagen_tmp, $imagen_path)) {
            // Insertar el consorcio en la base de datos
            $sql = "INSERT INTO consorcios (nombre, descripcion, imagen, coordenadas) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $descripcion, $imagen, $coordenadas);

            if ($stmt->execute()) {
                echo "Consorcio agregado correctamente.";
            } else {
                echo "Error al agregar el consorcio: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error al cargar la imagen. Inténtelo nuevamente.";
        }
    } else {
        echo "Por favor, complete todos los campos y asegúrese de cargar una imagen válida.";
    }
}

$conn->close();
?>
