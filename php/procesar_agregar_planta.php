<?php
include 'conexion.php'; // Conexión a la base de datos

try {
    // Validar campos requeridos
    if (!isset($_POST['nombre_cientifico'], $_POST['nombre_comun'], $_POST['descripcion'], $_FILES['fotografia'])) {
        throw new Exception("Por favor, complete todos los campos obligatorios.");
    }

    // Limpiar y validar entradas
    $nombre_cientifico = htmlspecialchars($_POST['nombre_cientifico']);
    $nombre_comun = htmlspecialchars($_POST['nombre_comun']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $id_categoria = !empty($_POST['id_categoria']) ? (int)$_POST['id_categoria'] : NULL;
    $usos = htmlspecialchars($_POST['usos']);
    $consorcios = isset($_POST['id_consorcio']) ? $_POST['id_consorcio'] : [];

    // Procesar la fotografía
    $fotografia = $_FILES['fotografia']['name'];
    $fotografia_tmp = $_FILES['fotografia']['tmp_name'];
    $upload_dir = "../uploads/";
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Validar extensión del archivo
    $file_extension = strtolower(pathinfo($fotografia, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        throw new Exception("Formato de archivo no permitido. Solo se permiten JPG, JPEG, PNG y GIF.");
    }

    // Crear directorio si no existe
    if (!file_exists($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            throw new Exception("No se pudo crear el directorio para subir la imagen.");
        }
    }

    // Mover archivo subido
    $file_path = $upload_dir . uniqid() . "." . $file_extension;
    if (!move_uploaded_file($fotografia_tmp, $file_path)) {
        throw new Exception("Error al subir la imagen.");
    }

    // Insertar planta en la base de datos
    $sql = "INSERT INTO plantas (nombre_cientifico, nombre_comun, descripcion, id_categoria, usos, fotografia) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre_cientifico, $nombre_comun, $descripcion, $id_categoria, $usos, $file_path);

    if (!$stmt->execute()) {
        throw new Exception("Error al agregar la planta: " . $stmt->error);
    }

    // Obtener el ID de la planta insertada
    $last_id = $stmt->insert_id;

    // Insertar consorcios asociados
    $sql_consorcio = "INSERT INTO planta_consorcio (id_planta, id_consorcio) VALUES (?, ?)";
    $stmt_consorcio = $conn->prepare($sql_consorcio);

    foreach ($consorcios as $id_consorcio) {
        $stmt_consorcio->bind_param("ii", $last_id, $id_consorcio);
        $stmt_consorcio->execute();
    }

    $stmt_consorcio->close();
    $stmt->close();

    echo "Planta agregada correctamente con sus consorcios asociados.";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conn->close();
}
?>
