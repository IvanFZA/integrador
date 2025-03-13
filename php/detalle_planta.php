<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalles de la Planta</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .card img {
                height: auto;
                max-width: 100%;
            }
            .card-header {
                text-align: center;
                background: none;
                border: none;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
        <?php
        include 'conexion.php'; // Incluye la conexión a la base de datos

        // Verifica si 'id_planta' está presente en la URL y es un número válido
        if (isset($_GET['id_planta']) && is_numeric($_GET['id_planta'])) {
            $id = intval($_GET['id_planta']); // Convierte el valor a entero para asegurar que sea un número

            // Consulta para obtener los detalles de la planta incluyendo la categoría
            $sql = "SELECT p.nombre_cientifico, p.nombre_comun, p.descripcion,p.usos, p.fotografia, c.nombre AS categoria_nombre
                    FROM plantas p
                    LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
                    WHERE p.id_planta = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                echo "<div class='alert alert-danger'>Error al preparar la consulta: " . $conn->error . "</div>";
                exit();
            }

            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Escapar los valores para prevenir problemas de seguridad
                $nombre_cientifico = htmlspecialchars($row['nombre_cientifico']);
                $nombre_comun = htmlspecialchars($row['nombre_comun']);
                $descripcion = htmlspecialchars($row['descripcion']);
                $usos = htmlspecialchars($row['usos']);
                $fotografia = htmlspecialchars($row['fotografia']);
                $categoria_nombre = htmlspecialchars($row['categoria_nombre'] ?? 'Sin categoría');

                echo "
                <h2 class='text-center'>Detalles de la Planta</h2>
                <div class='card mb-4' style='width: 100%; max-width: 600px; margin: auto;'>
                    <div class='card-header'>
                        <h5 class='card-title'>$nombre_cientifico</h5>
                    </div>
                    <img src='./uploads/$fotografia' class='card-img-top' alt='$nombre_cientifico'>
                    <div class='card-body'>
                        <p class='card-text'><strong>Nombre Común:</strong> $nombre_comun</p>
                        <p class='card-text'><strong>Descripción:</strong> $descripcion</p>
                        <p class='card-text'><strong>Categoría:</strong> $categoria_nombre</p>
                        <p class='card-text'><strong>Usos:</strong> $usos</p>
                        <a href='#' class='btn btn-primary' onclick='cargarFormularioEditar($id)'>Editar</a>
                    </div>
                </div>";

                // Consulta para obtener los consorcios asociados a la planta
                $sql_consorcios = "
                SELECT c.id_consorcio, c.nombre, c.imagen
                FROM consorcios c
                INNER JOIN planta_consorcio pc ON c.id_consorcio = pc.id_consorcio
                WHERE pc.id_planta = ?";
                $stmt_consorcios = $conn->prepare($sql_consorcios);

                if ($stmt_consorcios === false) {
                    echo "<div class='alert alert-danger'>Error al preparar la consulta para obtener los consorcios: " . $conn->error . "</div>";
                    exit();
                }

                $stmt_consorcios->bind_param("i", $id);
                $stmt_consorcios->execute();
                $result_consorcios = $stmt_consorcios->get_result();

                if ($result_consorcios->num_rows > 0) {
                    echo "<h3 class='text-center mt-5'>Consorcios Asociados</h3>";
                    echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";

                    while ($row_consorcio = $result_consorcios->fetch_assoc()) {
                        $consorcio_nombre = htmlspecialchars($row_consorcio['nombre']);
                        $consorcio_imagen = htmlspecialchars($row_consorcio['imagen']);

                        echo "
                        <div class='col'>
                            <div class='card h-100'>
                                <img src='./uploads/$consorcio_imagen' alt='$consorcio_nombre' class='card-img-top' style='height: 200px; object-fit: cover;'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$consorcio_nombre</h5>
                                </div>
                            </div>
                        </div>";
                    }

                    echo "</div>";
                } else {
                    echo "<p class='text-center mt-4'>No hay consorcios asociados a esta planta.</p>";
                }

                $stmt_consorcios->close();
            } else {
                echo "<div class='alert alert-warning'>No se encontró la planta.</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>ID de planta no válido.</div>";
        }

        $conn->close();
        ?>
        

        </div>
    </body>
</html>
