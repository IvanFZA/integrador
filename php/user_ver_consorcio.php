<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Consorcios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/targeta.css">
    
</head>
<body>
<div class="container mt-5">
    <?php
    include 'conexion.php'; // Incluye la conexión a la base de datos

    $sql = "SELECT id_consorcio, nombre, imagen FROM consorcios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2 class='text-center mb-4'>Selecciona un Consorcio para Ver</h2>";
        echo "<div class='row'>";

        while ($row = $result->fetch_assoc()) {
            $id_consorcio = $row['id_consorcio'];
            $nombre = $row['nombre'];
            $imagen = $row['imagen'];

            echo "
            <div class='col-md-4'>
                <div class='card mb-4'>
                    <img src='uploads/$imagen' class='card-img-top' alt='$nombre'>
                    <div class='card-body'>
                        <h5 class='card-title'>$nombre</h5>
                        <a href='php/user_formulario_ver_consorcio.php?id_consorcio=$id_consorcio' class='btn btn-primary'>Ver</a>
                    </div>
                </div>
            </div>";
        }
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning'>No se encontraron consorcios.</div>";
    }

    $conn->close();
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
