<?php
session_start();

// Verificar si la sesión de administrador está definida
if (!isset($_SESSION['id_administrador'])) {
    echo "redirigir"; // Enviar mensaje al script para redirigir
    exit();
}
?>
