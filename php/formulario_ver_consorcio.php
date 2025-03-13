<?php
if (isset($_GET['id_consorcio']) && !empty($_GET['id_consorcio'])) {
    $id_consorcio = intval($_GET['id_consorcio']);
    include 'conexion.php';

    // Consulta para obtener los detalles del consorcio
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
            <h2 class='text-center'>Detalles del Consorcio</h2>
            <div class='card mb-4'>
                <img src='./uploads/$imagen' alt='$nombre' class='card-img-top' style='max-height: 300px; object-fit: cover;'>
                <div class='card-body'>
                    <h3 class='card-title'>$nombre</h3>
                    <p><strong>Coordenadas:</strong> $coordenadas</p>
                    <p><strong>Descripción:</strong> $descripcion</p>
                    <button class='btn btn-primary' onclick='event.stopPropagation(); cargarFormularioModificar($id_consorcio)'>Modificar</button>
                </div>
            </div>
        </div>";

        // Consulta para obtener las plantas relacionadas con el consorcio mediante la tabla intermedia
        $sql_plantas = "
        SELECT p.id_planta, p.nombre_cientifico, p.nombre_comun, p.descripcion, p.fotografia
        FROM plantas p
        INNER JOIN planta_consorcio pc ON p.id_planta = pc.id_planta
        WHERE pc.id_consorcio = ?";
        $stmt_plantas = $conn->prepare($sql_plantas);

        if ($stmt_plantas === false) {
            echo "<div class='alert alert-danger'>Error al preparar la consulta para obtener las plantas: " . $conn->error . "</div>";
            exit();
        }

        $stmt_plantas->bind_param("i", $id_consorcio);
        $stmt_plantas->execute();
        $result_plantas = $stmt_plantas->get_result();

        if ($result_plantas->num_rows > 0) {
            echo "<h3 class='text-center mt-5'>Plantas en este Consorcio</h3>";
            echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";

            while ($row_planta = $result_plantas->fetch_assoc()) {
                $planta_id = intval($row_planta['id_planta']);
                $nombre_cientifico = htmlspecialchars($row_planta['nombre_cientifico']);
                $nombre_comun = htmlspecialchars($row_planta['nombre_comun']);
                $descripcion_planta = htmlspecialchars($row_planta['descripcion']);
                $fotografia = htmlspecialchars($row_planta['fotografia']);

                echo "
                <div class='col'>
                    <div class='card h-100'>
                        <img src='uploads/$fotografia' alt='$nombre_cientifico' class='card-img-top' style='height: 200px; object-fit: cover;'>
                        <div class='card-body'>
                            <h5 class='card-title'>$nombre_cientifico</h5>
                            <p><strong>Nombre Común:</strong> $nombre_comun</p>
                            <p><strong>Descripción:</strong> $descripcion_planta</p>
                            <button class='btn btn-danger' onclick='confirmarEliminarPlanta($planta_id, $id_consorcio)'>Eliminar Planta del Consorcio</button>
                        </div>
                    </div>
                </div>";
            }
            echo "</div>";
        } else {
            echo "<p class='text-center mt-4'>No hay plantas asociadas a este consorcio.</p>";
        }

        $stmt_plantas->close();
    } else {
        echo "<div class='alert alert-warning'>No se encontró el consorcio.</div>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<div class='alert alert-danger'>No se ha proporcionado un ID de consorcio válido.</div>";
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .card-body img {
        border-radius: 8px;
    }
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .row-cols-md-3 .col {
        margin-top: 15px;
    }
</style>
