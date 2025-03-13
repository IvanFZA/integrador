<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Preguntas Frecuentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #333;
            margin: 0;
        }

        /* Contenedor de las tarjetas para disponerlas en horizontal */
        #faq-container {
            display: flex;
            flex-wrap: wrap; /* Permite que las tarjetas se ajusten en múltiples filas si es necesario */
            gap: 10px; /* Espacio entre las tarjetas */
        }

        /* Estilo para las tarjetas FAQ */
        .faq-card {
            border: 1px solid #ccc;
            padding: 10px;
            width: 300px; /* Fijar el ancho de la tarjeta */
            height: 200px; /* Fijar la altura de la tarjeta */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column; /* Los elementos dentro de la tarjeta estarán en columna */
            overflow: hidden; /* Evitar que los elementos se salgan */
        }

        .faq-card .content {
            flex-grow: 1; /* El contenido ocupa el espacio disponible */
            overflow-y: auto; /* Desplazamiento si el contenido es demasiado grande */
            margin-bottom: 10px; /* Espacio para separar los botones */
        }

        .faq-card .buttons {
            display: flex;
            justify-content: space-between; /* Espacio entre los botones */
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        .button.delete {
            background-color: #FF6347;
        }

        .button.add {
            background-color: #28a745;
        }

        .add-faq {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Preguntas Frecuentes Existentes</h2>

<div id="faq-container">
    <?php
    include 'conexion.php'; // Conexión a la base de datos

    // Consulta para obtener todas las preguntas frecuentes
    $sql = "SELECT id_pregunta, pregunta, respuesta FROM preguntas_frecuentes ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar cada pregunta frecuente en una tarjeta
        while ($row = $result->fetch_assoc()) {
            $id = $row['id_pregunta'];
            $pregunta = $row['pregunta'];
            $respuesta = $row['respuesta'];

            echo "
            <div class='faq-card'>
                <div class='content'>
                    <h3>{$pregunta}</h3>
                    <p>{$respuesta}</p>
                </div>
                <div class='buttons'>
                    <a href='#' class='button' onclick='cargarFormularioEditarPregunta({$id})'>Editar</a>
                    <a href='#' class='button delete' onclick='confirmarEliminarPregunta({$id}); return false;'>Eliminar</a>
                </div>
            </div>";
        }
    } else {
        echo "No hay preguntas frecuentes disponibles.";
    }

    $conn->close();
    ?>
</div>

<div class="add-faq">
    <a href="#" class="button add" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Agregar Nueva Pregunta</a>
</div>

<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuestionModalLabel">Agregar Pregunta Frecuente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formulario3">
                    <div class="mb-3">
                        <label for="pregunta" class="form-label">Pregunta:</label>
                        <textarea id="pregunta" name="pregunta" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="respuesta" class="form-label">Respuesta:</label>
                        <textarea id="respuesta" name="respuesta" class="form-control" required></textarea>
                    </div>
                    <input type="hidden" name="id_administrador" value="<?php echo $_SESSION['id_administrador']; ?>"> <!-- Relacionar con el administrador actual -->
                    <button type="button" id="boton1" class="btn btn-success btn-lg px-5" onclick="agregarPregunta()"> Agregar Pregunta
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
