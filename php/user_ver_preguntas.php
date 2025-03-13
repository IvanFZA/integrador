<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Frecuentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/targeta.css">
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
            flex-wrap: wrap;
            gap: 10px;
        }

        /* Estilo para las tarjetas FAQ */
        .faq-card {
            border: 1px solid #ccc;
            padding: 10px;
            width: 300px;
            height: 200px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .faq-card .content {
            flex-grow: 1;
            overflow-y: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Preguntas Frecuentes</h2>

<div id="faq-container">
    <?php
    include 'conexion.php'; // Conexión a la base de datos

    // Consulta para obtener todas las preguntas frecuentes
    $sql = "SELECT id_pregunta, pregunta, respuesta FROM preguntas_frecuentes ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar cada pregunta frecuente en una tarjeta
        while ($row = $result->fetch_assoc()) {
            $pregunta = $row['pregunta'];
            $respuesta = $row['respuesta'];

            echo "
            <div class='faq-card'>
                <div class='content'>
                    <h3>{$pregunta}</h3>
                    <p>{$respuesta}</p>
                </div>
            </div>";
        }
    } else {
        echo "No hay preguntas frecuentes disponibles.";
    }

    $conn->close();
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
