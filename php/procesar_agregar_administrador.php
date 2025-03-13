<?php
include 'conexion.php'; // Conexión a la base de datos

try {
    // Validar campos requeridos
    if (!isset($_POST['nombre_completo'], $_POST['nombre_usuario'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
        throw new Exception("Por favor, complete todos los campos obligatorios.");
    }

    // Limpiar y validar entradas
    $nombre_completo = htmlspecialchars($_POST['nombre_completo']);
    $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        throw new Exception("Las contraseñas no coinciden.");
    }

    // Cifrar la contraseña
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo administrador en la base de datos
    $sql = "INSERT INTO administradores (nombre_completo, nombre_usuario, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre_completo, $nombre_usuario, $email, $password_hashed);

    if (!$stmt->execute()) {
        throw new Exception("Error al registrar el administrador: " . $stmt->error);
    }

    // Mostrar mensaje de éxito en una alerta visual y regresar
    echo "Administrador registrado correctamente.";

} catch (Exception $e) {
    // Mostrar mensaje de error en una alerta visual
    echo "Error: " . $e->getMessage() . "";
} finally {
    $conn->close();
}
?>
