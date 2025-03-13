<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/targeta.css">
    <style>
        
.floating-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 15px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s, transform 0.2s;
}

.floating-button:hover {
    background-color: #45a049;
    transform: scale(1.1); /* Agranda ligeramente el botón al hacer hover */
}

    </style>
</head>
<body>

<h2 class="text-center my-4">Categorías</h2>

<div class="card-container">
    <?php
    include 'conexion.php'; // Conexión a la base de datos

    $uploads_dir = 'php/uploads/';
    $sql = "SELECT id_categoria, nombre, descripcion, imagen FROM categoria";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagen_path = $uploads_dir . $row['imagen'];
            $img = $uploads_dir . $row['imagen'];
            echo "
            <div class='card'>
                <img src='$img' alt='Imagen de {$row['nombre']}'>
                <div class='card-body'>
                    <h3 class='card-title'>{$row['nombre']}</h3>
                    <p class='card-text'>{$row['descripcion']}</p>
                    <a href='#' class='btn btn-primary' onclick='cargarFormularioEditarCatalogo({$row['id_categoria']})'>Editar</a>
                    <a href='#' class='btn btn-danger' onclick='confirmarEliminarCatalogo({$row['id_categoria']}); return false;'>Eliminar</a>
                </div>
            </div>";
        }
    } else {
        echo "<p class='text-center'>No hay categorías disponibles.</p>";
    }
    $conn->close();
    ?>
</div>

<!-- Botón flotante para abrir el modal de agregar categoría -->
<button class="floating-button" data-bs-toggle="modal" data-bs-target="#addCatalogModal">
    +
</button>

<!-- Modal para agregar categoría -->
<div class="modal fade" id="addCatalogModal" tabindex="-1" aria-labelledby="addCatalogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCatalogModalLabel">Agregar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formulario4" >
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la Categoría:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen de referencia:</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" class="form-control">
                    </div>
                    <button type="button" id="boton1" class="btn btn-primary" onclick="agregarCategoria()"> Agregar Categoria
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
