<?php
header('Content-Type: application/json');
include 'conexion.php';

$sql = "SELECT id_consorcio, nombre, coordenadas, descripcion, imagen FROM consorcios";
$resultado = $conn->query($sql);

$consorcios = [];

while ($row = $resultado->fetch_assoc()) {
    // Verifica que el campo 'coordenadas' no esté vacío y tenga formato válido
    if (!empty($row['coordenadas']) && strpos($row['coordenadas'], ',') !== false) {
        $latLng = explode(',', $row['coordenadas']);
        
        // Verifica que existan ambas partes (latitud y longitud)
        if (count($latLng) == 2) {
            $latitud = trim($latLng[0]);
            $longitud = trim($latLng[1]);

            // Validar que sean valores numéricos y estén en rangos válidos
            if (is_numeric($latitud) && is_numeric($longitud) && 
                $latitud >= -90 && $latitud <= 90 &&
                $longitud >= -180 && $longitud <= 180) {
                
                // Verificar si la imagen está definida y construir la ruta
                $imagen = !empty($row['imagen']) ? "uploads/" . htmlspecialchars($row['imagen'], ENT_QUOTES, 'UTF-8') : "uploads/default.jpg";

                $consorcios[] = [
                    "id" => (int) $row['id_consorcio'],
                    "nombre" => htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8'),
                    "latitud" => floatval($latitud),
                    "longitud" => floatval($longitud),
                    "descripcion" => htmlspecialchars($row['descripcion'], ENT_QUOTES, 'UTF-8'),
                    "imagen" => $imagen
                ];
            } else {
                error_log("Coordenadas fuera de rango en ID " . $row['id_consorcio'] . ": $latitud, $longitud");
            }
        } else {
            error_log("Error en coordenadas en ID " . $row['id_consorcio'] . ": " . $row['coordenadas']);
        }
    } else {
        error_log("Coordenadas vacías o inválidas en ID " . $row['id_consorcio']);
    }
}

echo json_encode($consorcios, JSON_PRETTY_PRINT);
$conn->close();
?>
