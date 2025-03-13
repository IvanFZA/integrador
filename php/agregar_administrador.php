<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Registro de Administrador</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroAdminModal">
            Agregar Administrador
        </button>

        <div class="modal fade" id="registroAdminModal" tabindex="-1" aria-labelledby="registroAdminLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="registroAdminLabel">Registrar Nuevo Administrador</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                            <form id="formulario6" action="php/procesar_agregar_administrador.php" method="POST">
                            <div class="mb-3">
                                <label for="nombre_completo" class="form-label">Nombre Completo:</label>
                                <input type="text" id="nombre_completo" name="nombre_completo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre_usuario" class="form-label">Nombre de Usuario:</label>
                                <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmar Contraseña:</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="boton1" class="btn btn-primary" onclick="agregarAdministrador()"> Registrar Administrador
                    </div>
                </div>
            </div>
        </div>

        <h2>Administradores Registrados</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Nombre de Usuario</th>
                    <th>Correo Electrónico</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include 'conexion.php'; // Incluye la conexión a la base de datos

            // Consulta para obtener los administradores
            $sql = "SELECT id_administrador, nombre_completo, nombre_usuario, email FROM administradores";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Mostrar los administradores en una tabla
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id_administrador'] . "</td>
                            <td>" . $row['nombre_completo'] . "</td>
                            <td>" . $row['nombre_usuario'] . "</td>
                            <td>" . $row['email'] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay administradores registrados.</td></tr>";
            }

            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
    <script>
        // Validación de contraseñas
        document.querySelector('form').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                alert('Las contraseñas no coinciden.');
                event.preventDefault(); // Evita que el formulario se envíe
            }
        });
    </script>

</body>
</html>
