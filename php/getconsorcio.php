<?php
header("Content-Type: application/json");
include 'conexion.php';

// Consultar los consorcios con coordenadas
$sql = "SELECT id_consorcio, nombre, coordenadas, descripcion FROM consorcios WHERE coordenadas IS NOT NULL";
$result = $conn->query($sql);

$consorcios = [];

while ($row = $result->fetch_assoc()) {
    $coords = explode(",", $row["coordenadas"]);
    if (count($coords) == 2) {
        $lat = floatval(trim($coords[0]));
        $lng = floatval(trim($coords[1]));

        $consorcios[] = [
            "id" => $row["id_consorcio"],
            "nombre" => $row["nombre"],
            "lat" => $lat,
            "lng" => $lng,
            "descripcion" => $row["descripcion"]
        ];
    }
}

echo json_encode($consorcios);
$conn->close();
?>
