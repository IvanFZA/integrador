<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Planta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/detalles.css"> 
</head>
<body>

<div class="container">
    <?php
    if (isset($_GET['id_planta']) && is_numeric($_GET['id_planta'])) {
        $id = intval($_GET['id_planta']);

        $sql = "SELECT p.nombre_cientifico, p.nombre_comun, p.descripcion, p.fotografia, p.usos, c.nombre AS categoria_nombre
                FROM plantas p
                LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
                WHERE p.id_planta = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "<div class='alert alert-danger'>Error en la consulta: " . $conn->error . "</div>";
            exit();
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre_cientifico = htmlspecialchars($row['nombre_cientifico']);
            $nombre_comun = htmlspecialchars($row['nombre_comun']);
            $descripcion = htmlspecialchars($row['descripcion']);
            $fotografia = htmlspecialchars($row['fotografia']);
            $usos = htmlspecialchars($row['usos']);
            $categoria_nombre = htmlspecialchars($row['categoria_nombre'] ?? 'Sin categoría');

            echo "
            <h2 class='text-center mb-4'>Detalles de la Planta</h2>
            <div class='card mb-4'>
                <div class='card-header'>$nombre_cientifico</div>
                <img src='../uploads/$fotografia' class='card-img-top' alt='$nombre_cientifico'>
                <div class='card-body'>
                    <p><strong>Nombre Común:</strong> $nombre_comun</p>
                    <p><strong>Descripción:</strong> $descripcion</p>
                    <p><strong>Usos:</strong> $usos</p>
                    <p><strong>Categoría:</strong> $categoria_nombre</p>
                </div>
            </div>";

            $sql_consorcios = "
                SELECT c.id_consorcio, c.nombre, c.imagen
                FROM consorcios c
                INNER JOIN planta_consorcio pc ON c.id_consorcio = pc.id_consorcio
                WHERE pc.id_planta = ?";
            $stmt_consorcios = $conn->prepare($sql_consorcios);
            $stmt_consorcios->bind_param("i", $id);
            $stmt_consorcios->execute();
            $result_consorcios = $stmt_consorcios->get_result();

            if ($result_consorcios->num_rows > 0) {
                echo "<h3 class='mt-4'>Consorcios Asociados:</h3>";
                echo "<ul class='consorcio-list'>";
                while ($row_consorcio = $result_consorcios->fetch_assoc()) {
                    $consorcio_nombre = htmlspecialchars($row_consorcio['nombre']);
                    $consorcio_imagen = htmlspecialchars($row_consorcio['imagen']);
                    $consorcio_id = htmlspecialchars($row_consorcio['id_consorcio']);
                    
                    // Envolver el contenido en un enlace que apunta a detalle_consorcio.php
                    echo "
                        <li>
                            <a href='user_formulario_ver_consorcio.php?id_consorcio=$consorcio_id' style='text-decoration: none; color: inherit;'>
                                <img src='../uploads/$consorcio_imagen' alt='$consorcio_nombre'>
                                $consorcio_nombre
                            </a>
                        </li>
                    ";
                }
                echo "</ul>";
            } else {
                echo "<p class='text-muted'>No tiene consorcios asociados.</p>";
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

 <!-- Botón de regresar posicionado en la parte inferior -->
<div class="btn-back-container">
    <a href="javascript:history.back()" class="btn-back">
        <i class="fas fa-arrow-left"></i> Regresar
    </a>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="JS/script.js"></script> <!-- Archivo JS Externo -->
</body>
</html>