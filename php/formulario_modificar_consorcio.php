<?php
include 'conexion.php';

if (isset($_GET['id_consorcio']) && !empty($_GET['id_consorcio'])) {
    $id_consorcio = intval($_GET['id_consorcio']);

    // Consulta para obtener los datos del consorcio
    $sql = "SELECT nombre, imagen, coordenadas, descripcion FROM consorcios WHERE id_consorcio = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "<div class='alert alert-danger'>Error al preparar la consulta para obtener el consorcio: " . $conn->error . "</div>";
        exit();
    }

    $stmt->bind_param("i", $id_consorcio);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = htmlspecialchars($row['nombre']);
        $imagen = htmlspecialchars($row['imagen']);
        $coordenadas = htmlspecialchars($row['coordenadas']);
        $descripcion = htmlspecialchars($row['descripcion']);

        echo "
        <div class='container mt-4'>
            <h2 class='text-center mb-4'>Modificar Consorcio</h2>
            <form id='formulario7'>
                <input type='hidden' name='id_consorcio' value='$id_consorcio'>
                <input type='hidden' name='imagen_actual' value='$imagen'>

                <div class='mb-3'>
                    <label for='nombre' class='form-label'>Nombre del Consorcio:</label>
                    <input type='text' id='nombre' name='nombre' class='form-control' value='$nombre' required>
                </div>

                <div class='mb-3'>
                    <label class='form-label'>Imagen Actual del Consorcio:</label><br>
                    <img src='uploads/$imagen' alt='$nombre' class='img-thumbnail' style='width: 150px; height: auto;'>
                </div>

                <div class='mb-3'>
                    <label for='imagen' class='form-label'>Cambiar Imagen del Consorcio:</label>
                    <input type='file' id='imagen' name='imagen' class='form-control' accept='image/*'>
                </div>

                <div class='mb-3'>
                    <label for='coordenadas' class='form-label'>Coordenadas del Consorcio:</label>
                    <input type='text' id='coordenadas' name='coordenadas' class='form-control' value='$coordenadas' required
                           pattern='^-?\d{1,3}(\.\d+)?,\s*-?\d{1,3}(\.\d+)?$'
                           title='Ingresa las coordenadas en el formato: latitud, longitud (ejemplo: 19.4326, -99.1332)'>
                    <div id='error-message' class='text-danger mt-1' style='display: none;'></div>
                </div>

                <div class='mb-3'>
                    <label for='descripcion' class='form-label'>Descripción del Consorcio:</label>
                    <textarea id='descripcion' name='descripcion' class='form-control' rows='4' required>$descripcion</textarea>
                </div>

                <div class='text-center'>
                    <button type='button' id='boton1' class='btn btn-success btn-lg px-5' onclick='formulario_modificar_consorcio()'>Modificar Consorcio</button>
                </div>
            </form>
        </div>";
    } else {
        echo "<div class='alert alert-warning'>No se encontró el consorcio.</div>";
    }

    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>No se ha proporcionado un ID de consorcio válido.</div>";
}

$conn->close();
?>