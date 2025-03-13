<?php
include 'conexion.php'; // Conexión a la base de datos

if (isset($_POST['id_planta'], $_POST['nombre_cientifico'], $_POST['nombre_comun'], $_POST['descripcion'], $_POST['id_categoria'])) {
    $id_planta = intval($_POST['id_planta']);
    $nombre_cientifico = trim($_POST['nombre_cientifico']);
    $nombre_comun = trim($_POST['nombre_comun']);
    $descripcion = trim($_POST['descripcion']);
    $id_categoria = intval($_POST['id_categoria']);
    $usos = isset($_POST['usos']) ? trim($_POST['usos']) : null;
    $id_consorcios = isset($_POST['id_consorcio']) ? $_POST['id_consorcio'] : []; // Array de consorcios seleccionados

    // Obtener la imagen actual si no se sube una nueva
    $sql = "SELECT fotografia FROM plantas WHERE id_planta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_planta);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $fotografia_actual = $row['fotografia'];
    $stmt->close();

    // Procesar la nueva fotografía si se sube
    $fotografia = $fotografia_actual;
    if (isset($_FILES['fotografia']) && $_FILES['fotografia']['error'] === UPLOAD_ERR_OK) {
        $fotografia_tmp = $_FILES['fotografia']['tmp_name'];
        $fotografia_nombre = uniqid() . "_" . basename($_FILES['fotografia']['name']); // Nombre único
        $target_path = "../uploads/" . $fotografia_nombre;

        // Verificar si la imagen se subió correctamente
        if (move_uploaded_file($fotografia_tmp, $target_path)) {
            $fotografia = $fotografia_nombre;
        } else {
            die("Error al cargar la imagen. Verifica los permisos del directorio.");
        }
    }

    // Actualizar la planta en la base de datos
    $sql_update = "UPDATE plantas 
                   SET nombre_cientifico = ?, 
                       nombre_comun = ?, 
                       descripcion = ?,
                       id_categoria = ?,
                       usos = ?,
                       fotografia = ?
                   WHERE id_planta = ?";
    $stmt_update = $conn->prepare($sql_update);

    if (!$stmt_update) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt_update->bind_param("sssissi", $nombre_cientifico, $nombre_comun, $descripcion, $id_categoria, $usos, $fotografia, $id_planta);

    if ($stmt_update->execute()) {
        // Eliminar relaciones actuales en planta_consorcio
        $sql_delete_consorcios = "DELETE FROM planta_consorcio WHERE id_planta = ?";
        $stmt_delete = $conn->prepare($sql_delete_consorcios);
        $stmt_delete->bind_param("i", $id_planta);
        $stmt_delete->execute();
        $stmt_delete->close();

        // Insertar nuevas relaciones en planta_consorcio
        if (!empty($id_consorcios)) {
            $sql_insert_consorcio = "INSERT INTO planta_consorcio (id_planta, id_consorcio) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert_consorcio);

            foreach ($id_consorcios as $id_consorcio) {
                $id_consorcio = intval($id_consorcio);
                $stmt_insert->bind_param("ii", $id_planta, $id_consorcio);
                $stmt_insert->execute();
            }
            $stmt_insert->close();
        }

        // Mostrar alerta de éxito y redirigir
        echo 'Planta actualizada correctamente.';
    } else {
        echo "Error al actualizar la planta: " . $stmt_update->error;
    }

    $stmt_update->close();
} else {
    echo "Datos incompletos. Por favor, revisa que todos los campos estén llenos.";
}

$conn->close();
?>
