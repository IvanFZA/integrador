<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: ./login.php?error=invalid_email');
            exit();
        }

        // Consulta para verificar al administrador utilizando el email
        $sql = "SELECT id_administrador, nombre_completo, password FROM administradores WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            error_log("Error en la consulta: " . $conn->error);
            header('Location: ./login.php?error=server_error');
            exit();
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verificar la contraseña con password_verify
            if (password_verify($password, $row['password'])) {
                // Guardar los datos en la sesión
                $_SESSION['email'] = $email;
                $_SESSION['nombre_completo'] = $row['nombre_completo'];
                $_SESSION['id_administrador'] = $row['id_administrador'];

                // Redirigir al menú de administración
                header('Location: ../menu_admin.html');
                exit();
            } else {
                // Contraseña incorrecta
                header('Location: ./login.php?error=wrong_password');
                exit();
            }
        } else {
            // Correo no encontrado (solo administradores pueden iniciar sesión)
            header('Location: ./login.php?error=admin_only');
            exit();
        }

        $stmt->close();
    } else {
        header('Location: ../login.php?error=missing_fields');
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
}

$conn->close();
?>