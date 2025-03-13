<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

// Consulta para obtener las imágenes de las plantas
$stmt = $conn->prepare("SELECT id_planta, fotografia FROM plantas");
if ($stmt === false) {
    die(json_encode(["error" => "Error en la preparación de la consulta"]));
}

$stmt->execute();
$result = $stmt->get_result();

$imagenes = [];
while ($row = $result->fetch_assoc()) {
    $imagenes[] = [
        'id_planta' => $row['id_planta'],
        'fotografia' => $row['fotografia']
    ];
}

$stmt->close();
$conn->close();

// Devolver las imágenes en formato JSON
header('Content-Type: application/json');
echo json_encode($imagenes);
?>