<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Plantas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/targeta.css">
</head>
<body>
    <div class="container mt-5">
        <?php
        include 'conexion.php'; // Incluye la conexión a la base de datos

        $stmt = $conn->prepare("SELECT id_planta, nombre_cientifico, nombre_comun, fotografia FROM plantas");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0): ?>
            <h2 class='mb-4 text-center'>Descubre nuestras Plantas</h2>
            <div class='row'>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class='col-md-4'>
                        <div class='card mb-4'>
                            <img src='uploads/<?= htmlspecialchars($row['fotografia']) ?>' class='card-img-top' alt='Imagen de <?= htmlspecialchars($row['nombre_cientifico']) ?>'>
                            <div class='card-body'>
                                <h5 class='card-title'><?= htmlspecialchars($row['nombre_cientifico']) ?></h5>
                                <p class='card-text'><?= htmlspecialchars($row['nombre_comun']) ?></p>
                                <button class='btn btn-primary w-100' onclick="window.location.href='php/user_detalle_planta.php?id_planta=<?= htmlspecialchars($row['id_planta'], ENT_QUOTES, 'UTF-8') ?>'">
                                    Ver Detalles
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class='alert alert-warning text-center'>No se encontraron plantas.</div>
        <?php endif;

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
