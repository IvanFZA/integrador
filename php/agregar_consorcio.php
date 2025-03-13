<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Consorcio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <!-- Estilos personalizados -->
    <style>
        .map-container {
            margin-bottom: 20px;
            width: 100%;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        #map {
            height: 50vh;
            width: 100%;
            margin-top: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            #map {
                height: 40vh;
            }
        }

        @media (max-width: 480px) {
            #map {
                height: 30vh;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-success fw-bold mb-4">Agregar Consorcio</h2>

        <!-- Formulario -->
        <form id="formulario2" class="shadow p-4 rounded bg-white" method="POST" enctype="multipart/form-data">
            <!-- Nombre del Consorcio -->
            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">Nombre del Consorcio:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>

            <!-- Descripción del Consorcio -->
            <div class="mb-3">
                <label for="descripcion" class="form-label fw-bold">Descripción del Consorcio:</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
            </div>

            <!-- Imagen del Consorcio -->
            <div class="mb-3">
                <label for="imagen" class="form-label fw-bold">Imagen del Consorcio:</label>
                <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*" required>
            </div>

            <!-- Coordenadas con mapa integrado -->
            <div class='mb-3'>
                    <label for='coordenadas' class='form-label'>Coordenadas del Consorcio:</label>
                    <input type='text' id='coordenadas' name='coordenadas' class='form-control' required
                           pattern='^-?\d{1,3}(\.\d+)?,\s*-?\d{1,3}(\.\d+)?$'
                           title='Ingresa las coordenadas en el formato: latitud, longitud (ejemplo: 19.4326, -99.1332)'>
                    <div id='error-message' class='text-danger mt-1' style='display: none;'></div>
                </div>
                <!-- Contenedor del mapa -->
                <div class="map-container">
                    <div id="map"></div>
                </div>
            </div>

            <!-- Botón Agregar -->
            <div class="text-center">
                <button type="button" id="boton1" class="btn btn-success btn-lg px-5" onclick="agregarConsorcio()">Agregar Consorcio</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Script para el mapa -->
    <script src="../Js/mapa.js"></script>
</body>
</html>