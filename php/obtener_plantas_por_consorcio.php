<?php
include 'conexion.php'; // Conexión a la base de datos

if (isset($_GET['consorcio_id'])) {
    $consorcio_id = intval($_GET['consorcio_id']);
    
    $sql = "SELECT nombre_cientifico, nombre_comun FROM plantas WHERE consorcio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $consorcio_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $plantas = [];
    while ($row = $result->fetch_assoc()) {
        $plantas[] = $row;
    }

    echo json_encode($plantas);
}

$conn->close();
?>
