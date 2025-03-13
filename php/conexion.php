<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Cambia esto si tienes una contraseña
$dbname = "plantas_resilientes"; // Asegúrate de que el nombre de la base de datos sea correcto

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
