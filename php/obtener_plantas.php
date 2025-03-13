<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

// Consulta para obtener las plantas
$sql = "SELECT id_planta, nombre_cientifico, fotografia FROM plantas"; // Cambiado `id` a `id_planta`
$result = $conn->query($sql);

$plantas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $plantas[] = array(
            'id' => $row['id_planta'], // Cambiado a `id_planta` para mantener consistencia con la base de datos
            'nombre' => $row['nombre_cientifico'],
            'imagen' => 'uploads/' . $row['fotografia']
        );
    }
}

// Retornar los datos de las plantas en formato JSON
header('Content-Type: application/json');
echo json_encode($plantas);

$conn->close();
?>
