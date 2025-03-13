<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../CSS/login.css"> <!-- Enlace al archivo CSS -->
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <h3>Solo administradores</h3>
        <form action="./procesar_login.php" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required aria-required="true" placeholder="Ingresa tu correo electrónico">
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required aria-required="true" placeholder="Ingresa tu contraseña">
            </div>

            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <!-- Botón de Regresar -->
        <button id="btn-regresar"  class="btn-regresar">Regresar</button>

        <?php
        if (isset($_GET['error']) && $_GET['error'] == 'true') {
            echo "<p class='error-message'>Usuario o contraseña incorrectos.</p>";
        }
        ?>
    </div>

    <!-- Modal para mensajes de error -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage"></p>
            <div class="modal-buttons">
                <button id="retryButton">Volver a intentar</button>
                <button id="goToMenuButton">Regresar</button>
            </div>
        </div>
    </div>

    <script src="../Js/modal.js"></script> <!-- Enlace al archivo JavaScript -->
</body>
</html>