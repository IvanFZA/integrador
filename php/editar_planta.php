<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Plantas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/targeta.css"> 
</head>
<body>
<div class="container mt-5">
    <?php
    include 'conexion.php'; // Incluye la conexión a la base de datos

    // Consulta para obtener todas las plantas
    $sql = "SELECT id_planta, nombre_cientifico, nombre_comun, fotografia FROM plantas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Selecciona una Planta para Editar</h2>";
        echo "<div class='row'>";

        while ($row = $result->fetch_assoc()) {
            $id_planta = $row['id_planta'];
            $nombre_cientifico = $row['nombre_cientifico'];
            $nombre_comun = $row['nombre_comun'];
            $fotografia = $row['fotografia'];

            echo "
            <div class='col-md-4'>
                <div class='card mb-4'>
                    <img src='uploads/$fotografia' class='card-img-top' alt='$nombre_cientifico'>
                    <div class='card-body'>
                        <h5 class='card-title'>$nombre_cientifico</h5>
                        <p class='card-text'>$nombre_comun</p>
                        <a href='#' class='btn btn-primary' onclick='verPlanta($id_planta)'>Ver Planta</a>
                    </div>
                </div>
            </div>";
        }
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning'>No se encontraron plantas.</div>";
    }

    $conn->close();
    ?>
</div>

<!-- Contenedor para contenido dinámico -->
<main id="content" class="container mt-5"></main>

</body>
</html>
