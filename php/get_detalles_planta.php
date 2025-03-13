<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

if (isset($_GET['id_planta']) && is_numeric($_GET['id_planta'])) {
    $id = intval($_GET['id_planta']);

    // Consulta para obtener los detalles de la planta
    $sql = "SELECT p.nombre_cientifico, p.nombre_comun, p.descripcion, p.fotografia, c.nombre AS categoria_nombre
            FROM plantas p
            LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
            WHERE p.id_planta = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("<div class='alert alert-danger'>Error en la preparación de la consulta: " . $conn->error . "</div>");
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_cientifico = htmlspecialchars($row['nombre_cientifico']);
        $nombre_comun = htmlspecialchars($row['nombre_comun']);
        $descripcion = htmlspecialchars($row['descripcion']);
        $fotografia = htmlspecialchars($row['fotografia']);
        $categoria_nombre = htmlspecialchars($row['categoria_nombre'] ?? 'Sin categoría');

        // Generar el HTML con los detalles de la planta
        echo "
        <div class='card mb-4'>
            <div class='card-header'>
                <h5 class='card-title'>$nombre_cientifico</h5>
            </div>
            <img src='./uploads/$fotografia' class='card-img-top' alt='$nombre_cientifico'>
            <div class='card-body'>
                <p class='card-text'><strong>Nombre Común:</strong> $nombre_comun</p>
                <p class='card-text'><strong>Descripción:</strong> $descripcion</p>
                <p class='card-text'><strong>Categoría:</strong> $categoria_nombre</p>
            </div>
        </div>";
    } else {
        echo "<div class='alert alert-warning'>No se encontró la planta.</div>";
    }

    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>ID de planta no válido.</div>";
}

$conn->close();
?>