<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

// Consulta para obtener todos los consorcios
$sql = "SELECT id_consorcio, nombre, imagen FROM consorcios";
$result = $conn->query($sql);

echo "<div class='container mt-4'>";
if ($result->num_rows > 0) {
    echo "<h2 class='text-center mb-4'>Selecciona un Consorcio para Eliminar</h2>";
    echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";

    while ($row = $result->fetch_assoc()) {
        $id_consorcio = $row['id_consorcio'];
        $nombre = htmlspecialchars($row['nombre']);
        $imagen = htmlspecialchars($row['imagen']);

        echo "
        <div class='col'>
            <div class='card h-100 shadow-sm'>
                <img src='uploads/$imagen' alt='$nombre' class='card-img-top' style='height: 200px; object-fit: cover;'>
                <div class='card-body'>
                    <h5 class='card-title'>$nombre</h5>
                    <button onclick='confirmarEliminarConsorcio($id_consorcio)' class='btn btn-danger w-100 mt-3'>Eliminar</button>
                </div>
            </div>
        </div>";
    }
    echo "</div>";
} else {
    echo "<div class='alert alert-warning text-center'>No se encontraron consorcios.</div>";
}
echo "</div>";

$conn->close();
?>

<script>
function confirmarEliminarConsorcio(id_consorcio) {
    if (confirm('¿Estás seguro de que deseas eliminar este consorcio?')) {
        fetch('eliminar_consorcio_proceso.php?id_consorcio=' + id_consorcio, {
            method: 'GET'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor: ' + response.statusText);
            }
            return response.text();
        })
        .then(data => {
            alert(data); // Mostrar el mensaje de confirmación o error
            location.reload(); // Recargar la página para mostrar la lista actualizada
        })
        .catch(error => {
            console.error('Error al eliminar el consorcio:', error);
            alert('Hubo un problema al intentar eliminar el consorcio.');
        });
    }
}
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .card-img-top {
        border-radius: 8px 8px 0 0;
    }
</style>
