<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Catálogo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <?php
    $id_catalogo = $_GET['id']; // Recibe el ID del catálogo desde la URL
    
    include 'conexion.php'; // Conexión a la base de datos
    
    // Consulta usando el parámetro 'id' (que corresponde a id_categoria)
    $sql = "SELECT * FROM categoria WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_catalogo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
      $catalogo = $result->fetch_assoc(); // Obtén los datos del catálogo
    } else {
      echo "<div class='alert alert-warning'>No se encontró el catálogo.</div>";
    }
    
    $stmt->close();
    $conn->close();
    ?>
    
    <h2 class="mb-4">Editar Catálogo</h2>
    <form id="formulario9">
      <!-- Campo oculto para el id del catálogo -->
      <input type="hidden" id="idCatalogo" name="id" value="<?php echo $catalogo['id_categoria']; ?>">
      
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $catalogo['nombre']; ?>" required>
      </div>
      
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required><?php echo $catalogo['descripcion']; ?></textarea>
      </div>
      
      <div class="mb-3">
        <label for="imagen" class="form-label">Imagen de referencia:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" class="form-control">
      </div>
      
      <button type="button" class="btn btn-success" onclick="editarCategoria()">Guardar Cambios</button>
    </form>
  </div>
</body>
</html>
