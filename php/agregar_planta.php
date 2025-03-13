<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Planta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-success fw-bold mb-4">Agregar Planta</h2>

        <form id="formulario1" class="shadow p-4 rounded bg-white">
            <!-- 🔬 Nombre Científico -->
            <div class="mb-3">
                <label for="nombre_cientifico" class="form-label fw-bold">Nombre Científico:</label>
                <input type="text" id="nombre_cientifico" name="nombre_cientifico" class="form-control" required>
            </div>

            <!-- 🌱 Nombre Común -->
            <div class="mb-3">
                <label for="nombre_comun" class="form-label fw-bold">Nombre Común:</label>
                <input type="text" id="nombre_comun" name="nombre_comun" class="form-control" required>
            </div>

            <!-- 📝 Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
            </div>

            <!-- 🤝 Consorcio -->
            <div class="mb-3">
                <label class="form-label fw-bold">Consorcio:</label>
                <div class="d-flex flex-wrap">
                    <?php
                    include 'conexion.php';
                    $sql = "SELECT id_consorcio, nombre FROM consorcios";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='form-check form-check-inline'>
                                <input class='form-check-input' type='checkbox' name='id_consorcio[]' value='{$row['id_consorcio']}'>
                                <label class='form-check-label'>{$row['nombre']}</label>
                              </div>";
                    }
                    ?>
                </div>
            </div>

            <!-- 📂 Categoría -->
            <div class="mb-3">
                <label for="id_categoria" class="form-label fw-bold">Categoría:</label>
                <div class="input-group">
                    <select id="id_categoria" name="id_categoria" class="form-select" required>
                        <option value="">Selecciona una categoría</option>
                        <?php
                        $sql = "SELECT id_categoria, nombre FROM categoria";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id_categoria']}'>{$row['nombre']}</option>";
                        }
                        ?>
                    </select>
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                </div>
            </div>

            <!-- 🌿 Usos -->
            <div class="mb-3">
                <label for="usos" class="form-label fw-bold">Usos:</label>
                <textarea id="usos" name="usos" class="form-control" rows="3"></textarea>
            </div>

            <!-- 📸 Fotografía -->
            <div class="mb-3">
                <label for="fotografia" class="form-label fw-bold">Fotografía:</label>
                <input type="file" id="fotografia" name="fotografia" class="form-control" accept="image/*" required>
            </div>

            <!-- 📌 Botón Agregar -->
            <div class="text-center">
                <button type="button" id="boton1" class="btn btn-success btn-lg px-5" onclick="agregarPlanta()">
                    <i class="fas fa-plus-circle me-2"></i> Agregar Planta
                </button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
