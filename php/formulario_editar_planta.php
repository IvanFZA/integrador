<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Planta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
    <?php
    if (isset($_GET['id_planta']) && is_numeric($_GET['id_planta'])) {
        $id_planta = intval($_GET['id_planta']);

        include 'conexion.php';
        // Consulta principal para obtener datos de la planta
        $sql = "SELECT nombre_cientifico, nombre_comun, descripcion, id_categoria, usos, fotografia FROM plantas WHERE id_planta = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "<div class='alert alert-danger'>Error al preparar la consulta: " . $conn->error . "</div>";
            exit();
        }

        $stmt->bind_param("i", $id_planta);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Escapar valores para prevenir XSS
            $nombre_cientifico = htmlspecialchars($row['nombre_cientifico']);
            $nombre_comun = htmlspecialchars($row['nombre_comun']);
            $descripcion = htmlspecialchars($row['descripcion']);
            $categoria_seleccionada = intval($row['id_categoria']);
            $usos = htmlspecialchars($row['usos']);
            $fotografia = htmlspecialchars($row['fotografia']);

            // Obtener consorcios asociados
            $sql_consorcios_asociados = "SELECT id_consorcio FROM planta_consorcio WHERE id_planta = ?";
            $stmt_consorcios = $conn->prepare($sql_consorcios_asociados);
            $stmt_consorcios->bind_param("i", $id_planta);
            $stmt_consorcios->execute();
            $result_consorcios_asociados = $stmt_consorcios->get_result();
            
            $consorcios_asociados = [];
            while ($row_consorcio = $result_consorcios_asociados->fetch_assoc()) {
                $consorcios_asociados[] = $row_consorcio['id_consorcio'];
            }

            ?>
            <h2 class="text-center mb-4">Editar Planta</h2>
            <form id="formulario4">
                <input type="hidden" name="id_planta" value="<?php echo $id_planta; ?>">

                <div class="mb-3">
                    <label for="nombre_cientifico" class="form-label">Nombre Científico:</label>
                    <input type="text" id="nombre_cientifico" name="nombre_cientifico" class="form-control" value="<?php echo $nombre_cientifico; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="nombre_comun" class="form-label">Nombre Común:</label>
                    <input type="text" id="nombre_comun" name="nombre_comun" class="form-control" value="<?php echo $nombre_comun; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required><?php echo $descripcion; ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Consorcios:</label><br>
                    <?php
                    // Consultar todos los consorcios
                    $sql_consorcios = "SELECT id_consorcio, nombre FROM consorcios";
                    $result_consorcios = $conn->query($sql_consorcios);

                    if ($result_consorcios->num_rows > 0) {
                        while ($row_consorcio = $result_consorcios->fetch_assoc()) {
                            $checked = in_array($row_consorcio['id_consorcio'], $consorcios_asociados) ? 'checked' : '';
                            echo "
                            <div class='form-check'>
                                <input class='form-check-input' type='checkbox' name='id_consorcio[]' value='" . htmlspecialchars($row_consorcio['id_consorcio']) . "' $checked>
                                <label class='form-check-label'>" . htmlspecialchars($row_consorcio['nombre']) . "</label>
                            </div>";
                        }
                    } else {
                        echo "<div class='alert alert-warning'>No hay consorcios disponibles.</div>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="id_categoria" class="form-label">Categoría:</label>
                    <select id="id_categoria" name="id_categoria" class="form-select" required>
                        <option value="">Selecciona una Categoría</option>
                        <?php
                        $sql_categorias = "SELECT id_categoria, nombre FROM categoria";
                        $result_categorias = $conn->query($sql_categorias);

                        if ($result_categorias->num_rows > 0) {
                            while ($row_categoria = $result_categorias->fetch_assoc()) {
                                $selected = ($row_categoria['id_categoria'] == $categoria_seleccionada) ? 'selected' : '';
                                echo "<option value='" . htmlspecialchars($row_categoria['id_categoria']) . "' $selected>" . htmlspecialchars($row_categoria['nombre']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay categorías disponibles</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="usos" class="form-label">Usos:</label>
                    <textarea id="usos" name="usos" class="form-control" rows="3"><?php echo $usos; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="fotografia" class="form-label">Fotografía:</label>
                    <input type="file" id="fotografia" name="fotografia" class="form-control">
                    <?php if (!empty($fotografia)) { ?>
                        <img src="./uploads/<?php echo $fotografia; ?>" alt="<?php echo $nombre_cientifico; ?>" class="img-fluid mt-2" style="width: 150px; height: auto;">
                    <?php } ?>
                </div>

                <button type="button" id="boton1" class="btn btn-success btn-lg px-5" onclick="formulario_modificar_planta()"> Modificar Planta</button>
            </form>
            <?php
        } else {
            echo "<div class='alert alert-warning'>No se encontró la planta.</div>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<div class='alert alert-danger'>ID de planta no válido.</div>";
    }
    ?>
    </div>
</body>
</html>
