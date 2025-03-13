-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2025 a las 01:26:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plantas_resilientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_administrador` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_administrador`, `nombre_completo`, `nombre_usuario`, `email`, `password`, `created_at`) VALUES
(1, 'Brian Angeles ', 'brian', 'brianmiranda7190@gmail.com', '$2y$10$fNpf57g1RPVnhy7633dyru13uRXcldcaxyFpHkiOeynMpgw/A9vSu', '2024-10-24 22:56:07'),
(2, 'Jose', 'nose', 'admin@example.com', '$2y$10$yPLZsJbGLvWakhgv7YRhpuIvQkrrjeZQh3Jeb5jp8rdXrVu4.nYjS', '2024-10-25 02:06:54'),
(3, 'kdk', 'md', 'kfnkds@g.com', '$2y$10$yf3XNw7ik4cFH1fRrZXvoOMppJwblF5jnmTECD3Wwj7jdrhy8oC/a', '2024-10-25 02:15:42'),
(4, 'da', 'dm', 'd@gamil.com', '$2y$10$2as6kREqGoGMtlck5o8h8eqBswbixQxurp89MC9sUJ/RbmWn5clMq', '2024-10-30 02:10:14'),
(5, 'ivan', 'ivan', 'ivanfransiscozenil@gmail.com', '$2y$10$h3lFqFuxjj9yqN3Je5R3kOhYnDxq7obqFCP7i2sezuw51YIdvzAFy', '2024-11-02 01:25:19'),
(7, 'ivann', 'ivann', 'ivan@gmail.com', '$2y$10$1Sl20JwuLjK5wSw59LLIcOLgZrtzlaPL7qd2LjsvGqvNkOZmbCOQ2', '2024-11-02 02:21:26'),
(8, 'saul', 'saul', 'saul@gmail.com', '$2y$10$eyLNKCq1pAhDKz.fe9CI8.eNq7JQwaRU8cZpJMoM53ag4NjvQ5deG', '2024-11-02 03:14:23'),
(9, 'saules', 'saules', 'saules@gmail.com', '$2y$10$bdfchJDFPzQp7cxpozAzm.GGNJCyVEMJczGT.cHqwQ.zarh1gN9/O', '2024-11-02 03:28:03'),
(10, 'pepe', 'pepe', 'pepe@gmail.com', '$2y$10$vmrTpxN6/pxUsyVjQeTAyek5DlZ2KBB83AFJEjJM5kxGyxXFpicBu', '2024-11-02 03:28:55'),
(11, 'xd', 'xd', 'xd@gmail.com', '$2y$10$dqyFkO.7VQM3eEtWA1ypKeGko3ufLcX5hZQyzuokyCTciboCZO.Dq', '2024-11-02 04:20:47'),
(12, 'sdmls', 'mdlm', 'sk222@dw.com', '$2y$10$dfXq/WM2HRX5imJGZOLcNuaIr7O6.fyKDIBK8AezQTB1CMHdnTwPm', '2025-01-21 02:25:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`, `imagen`) VALUES
(2, 'Hola1', 'ksmdjdokk', '23a1724d1094c0a03bebb8072db7eca5.png'),
(4, 'Pacifloras', 'body {\r\n    font-family: Arial, sans-serif;\r\n}\r\n\r\n.catalog-container {\r\n    display: flex;\r\n    flex-wrap: wrap;\r\n    gap: 20px; /* Espaciado entre elementos */\r\n    padding: 10px;\r\n    justify-content: flex-start; /* Alinea las tarjetas a la izquierda */\r\n    margin: 0 auto; /* Centra el contenedor si hay suficiente espacio */\r\n    max-width: 1200px; /* Limita el ancho máximo del contenedor */\r\n}\r\n\r\n.catalog-card {\r\n    border: 1px solid #ccc;\r\n    padding: 10px;\r\n    max-width: 300px;\r\n    flex: 1 1 calc(33.333% - 20px); /* Ajusta la tarjeta para que se distribuyan tres por fila */\r\n    box-sizing: border-box;\r\n    display: flex;\r\n    flex-direction: column;\r\n    align-items: flex-start; /* Alinea el contenido de la tarjeta a la izquierda */\r\n    text-align: left;\r\n    background-color: #f9f9f9; /* Fondo claro */\r\n    border-radius: 8px; /* Bordes redondeados */\r\n    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */\r\n}\r\n\r\n.catalog-card img {\r\n    max-width: 100%;\r\n    height: auto;\r\n    border-radius: 8px; /* Bordes redondeados para la imagen */\r\n    margin-bottom: 10px;\r\n}\r\n\r\n.catalog-card h3 {\r\n    margin: 10px 0;\r\n    font-size: 1.25rem;\r\n    color: #333;\r\n}\r\n\r\n.catalog-card p {\r\n    margin: 10px 0;\r\n    font-size: 0.95rem;\r\n    color: #555;\r\n}\r\n\r\n.catalog-card a {\r\n    margin-right: 10px;\r\n    padding: 8px 12px;\r\n    text-decoration: none;\r\n    background-color: #007BFF;\r\n    color: white;\r\n    border-radius: 5px;\r\n    font-size: 0.9rem;\r\n    font-weight: bold;\r\n    transition: background-color 0.3s;\r\n}\r\n\r\n.catalog-card a.delete {\r\n    background-color: #FF6347;\r\n}\r\n\r\n.catalog-card a:hover {\r\n    background-color: #0056b3;\r\n}\r\n\r\n.catalog-card a.delete:hover {\r\n    background-color: #d93829;\r\n}\r\n\r\n.floating-button {\r\n    position: fixed;\r\n    bottom: 20px;\r\n    right: 20px;\r\n    background-color: #4CAF50;\r\n    color: white;\r\n    border: none;\r\n    padding: 15px;\r\n    border-radius: 50%;\r\n    font-size: 24px;\r\n    cursor: pointer;\r\n    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);\r\n    transition: background-color 0.3s, transform 0.2s;\r\n}\r\n\r\n.floating-button:hover {\r\n    background-color: #45a049;\r\n    transform: scale(1.1); /* Agranda ligeramente el botón al hacer hover */\r\n}\r\n', '7481908.png'),
(7, 'Paciflora', 'd', 'nopal.jpg'),
(9, 'dnksjbj', 'kndfkwndksn dfkns  kfns', 'UTVM_Logo.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consorcios`
--

CREATE TABLE `consorcios` (
  `id_consorcio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `coordenadas` varchar(255) DEFAULT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consorcios`
--

INSERT INTO `consorcios` (`id_consorcio`, `nombre`, `imagen`, `fecha_creacion`, `coordenadas`, `descripcion`) VALUES
(5, 'Mezquitesolsd', 'cyty.jpg', '2024-11-01 19:08:38', '123,769', 'Arboles'),
(6, 'ndksndjdosjdknmslsww', 'an.jpeg', '2025-01-21 02:02:15', 'jj', 'lmjmdlam'),
(8, 'lkddm', '7481908.png', '2025-01-21 14:05:44', 'dw', 'dl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas`
--

CREATE TABLE `plantas` (
  `id_planta` int(11) NOT NULL,
  `nombre_cientifico` varchar(255) NOT NULL,
  `nombre_comun` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_administrador` int(11) DEFAULT NULL,
  `usos` text DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plantas`
--

INSERT INTO `plantas` (`id_planta`, `nombre_cientifico`, `nombre_comun`, `descripcion`, `id_categoria`, `id_administrador`, `usos`, `fotografia`, `fecha_creacion`) VALUES
(21, 'Opunti', 'Nopal', 'Opuntia es el género más diverso y más ampliamente distribuido en América. En el mundo, se conocen unas 1.600 especies. Está fuertemente asociado con la polinización por las abejas y coevolucionó con al menos dos géneros de estos insectos.\r\n\r\nEn la naturaleza se ven ejemplos espectaculares de asociaciones que forman estos cactus, conocidas como nopaleras. Las nopaleras consisten en el agrupamiento natural de cactus de diversos géneros. Dentro de estas agrupaciones puede haber alrededor de 144 variantes de Opuntia.\r\n\r\nEste cactus ha sido estudiado por sus propiedades hipoglicémicas, y su potencial uso para el tratamiento de la diabetes tipo 2.', 2, NULL, 'Usos medicinales tradicionales. En la medicina tradicional de algunas culturas, el nopal se ha utilizado para tratar una variedad de afecciones, como problemas digestivos, diabetes y heridas cutáneas. Algunos estudios científicos respaldan ciertos beneficios medicinales.\r\nEcológicos. Los nopales son especies cultivables en zonas áridas, particularmente por su alta eficiencia en convertir agua en biomasa. Por ello, son reconocidos como un cultivo ideal para regímenes áridos.\r\nAlimento animal. Las tunas son utilizadas como alimento forrajero, y como suplemento en la nutrición animal.\r\nGastronómicos. El nopal y las tunas se emplean en la cocina mexicana para elaborar platos típicos y tradicionales.\r\nOrnamental. También se cultiva como planta ornamental en jardines debido a su forma interesante y atractiva y a sus flores llamativas.', '678e5fd21c118_wp4599785.jpg', '2025-01-19 23:18:54'),
(22, 'Petunia', 'nopalus', 'nso;fodsnj', 4, NULL, '<!DOCTYPE html>\r\n<html lang=\"es\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Listado de Plantas</title>\r\n    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC\" crossorigin=\"anonymous\">\r\n</head>\r\n<body>\r\n<div class=\"container mt-5\">\r\n    <?php\r\n    // Incluir conexión a la base de datos\r\n    include \'conexion.php\';\r\n\r\n    // Consulta para obtener las plantas\r\n    $sql = \"SELECT id_planta, nombre_cientifico, nombre_comun, fotografia FROM plantas\";\r\n    $result = $conn->query($sql);\r\n\r\n    if ($result->num_rows > 0): ?>\r\n        <h2 class=\"mb-4\">Selecciona una Planta para Editar</h2>\r\n        <div class=\"row\">\r\n            <?php while ($row = $result->fetch_assoc()): ?>\r\n                <?php \r\n                // Verificar si la imagen existe y es accesible, de lo contrario usar un placeholder\r\n                $imagePath = \"./uploads/\" . $row[\'fotografia\'];\r\n                $fotografia = is_readable($imagePath) ? $imagePath : \"./uploads/placeholder.jpg\";\r\n                ?>\r\n                <div class=\"col-md-4\">\r\n                    <div class=\"card mb-4\">\r\n                        <img src=\"<?= htmlspecialchars($fotografia) ?>?t=<?= time() ?>\" class=\"card-img-top\" alt=\"<?= htmlspecialchars($row[\'nombre_cientifico\']) ?>\">\r\n                        <div class=\"card-body\">\r\n                            <h5 class=\"card-title\"><?= htmlspecialchars($row[\'nombre_cientifico\']) ?></h5>\r\n                            <p class=\"card-text\"><?= htmlspecialchars($row[\'nombre_comun\']) ?></p>\r\n                            <a href=\"#\" class=\"btn btn-primary\" onclick=\"verPlanta(<?= htmlspecialchars($row[\'id_planta\']) ?>)\">Ver Planta</a>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            <?php endwhile; ?>\r\n        </div>\r\n    <?php else: ?>\r\n        <div class=\"alert alert-warning\">No se encontraron plantas.</div>\r\n    <?php endif;\r\n\r\n    $conn->close();\r\n    ?>\r\n</div>\r\n\r\n<main id=\"content\" class=\"container mt-5\"></main>\r\n\r\n<script>\r\n// Función para cargar el formulario de edición de planta\r\nfunction cargarFormularioEditar(id_planta) {\r\n    fetch(`php/formulario_editar_planta.php?id_planta=${id_planta}`)\r\n        .then(response => {\r\n            if (!response.ok) throw new Error(\'Error al cargar el formulario\');\r\n            return response.text();\r\n        })\r\n        .then(data => {\r\n            document.getElementById(\'content\').innerHTML = data;\r\n        })\r\n        .catch(error => console.error(\'Error:\', error));\r\n}\r\n\r\n// Función para ver detalles de una planta\r\nfunction verPlanta(id_planta) {\r\n    fetch(`php/detalle_planta.php?id_planta=${id_planta}`)\r\n        .then(response => {\r\n            if (!response.ok) throw new Error(\'Error al cargar los detalles\');\r\n            return response.text();\r\n        })\r\n        .then(data => {\r\n            document.getElementById(\'content\').innerHTML = data;\r\n        })\r\n        .catch(error => console.error(\'Error:\', error));\r\n}\r\n</script>\r\n\r\n<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM\" crossorigin=\"anonymous\"></script>\r\n</body>\r\n</html>', '678e5f0c95f04_images.jpeg', '2025-01-19 23:30:52'),
(24, 'lmospm', 'mlwndpo', 'lfmsldnlo', NULL, NULL, '0', '../uploads/678e60b4e8484.jpeg', '2025-01-20 14:41:56'),
(25, 'kbcksn', 'ncklsn', 'lcnksn', 2, NULL, '0', '../uploads/678f02965ed05.jpeg', '2025-01-21 02:12:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planta_consorcio`
--

CREATE TABLE `planta_consorcio` (
  `id` int(11) NOT NULL,
  `id_planta` int(11) DEFAULT NULL,
  `id_consorcio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planta_consorcio`
--

INSERT INTO `planta_consorcio` (`id`, `id_planta`, `id_consorcio`) VALUES
(69, 22, 5),
(70, 24, 5),
(72, 25, 5),
(74, 21, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_frecuentes`
--

CREATE TABLE `preguntas_frecuentes` (
  `id_pregunta` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta` text NOT NULL,
  `id_administrador` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas_frecuentes`
--

INSERT INTO `preguntas_frecuentes` (`id_pregunta`, `pregunta`, `respuesta`, `id_administrador`, `created_at`) VALUES
(4, 'da', 'kd', 1, '2024-10-30 02:02:34'),
(6, 'que pasod', 'nadalmm', NULL, '2024-11-02 04:59:42'),
(9, 'mmfjk', 'kdk', 1, '2025-01-22 00:14:24'),
(10, 'flsdm', 'lmldm', 1, '2025-01-22 00:16:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_administrador`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `consorcios`
--
ALTER TABLE `consorcios`
  ADD PRIMARY KEY (`id_consorcio`);

--
-- Indices de la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id_planta`),
  ADD KEY `fk_planta_categoria` (`id_categoria`),
  ADD KEY `fk_planta_administrador` (`id_administrador`);

--
-- Indices de la tabla `planta_consorcio`
--
ALTER TABLE `planta_consorcio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_planta` (`id_planta`),
  ADD KEY `id_consorcio` (`id_consorcio`);

--
-- Indices de la tabla `preguntas_frecuentes`
--
ALTER TABLE `preguntas_frecuentes`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `fk_pregunta_administrador` (`id_administrador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `consorcios`
--
ALTER TABLE `consorcios`
  MODIFY `id_consorcio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id_planta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `planta_consorcio`
--
ALTER TABLE `planta_consorcio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `preguntas_frecuentes`
--
ALTER TABLE `preguntas_frecuentes`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD CONSTRAINT `fk_planta_administrador` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_planta_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `planta_consorcio`
--
ALTER TABLE `planta_consorcio`
  ADD CONSTRAINT `planta_consorcio_ibfk_1` FOREIGN KEY (`id_planta`) REFERENCES `plantas` (`id_planta`),
  ADD CONSTRAINT `planta_consorcio_ibfk_2` FOREIGN KEY (`id_consorcio`) REFERENCES `consorcios` (`id_consorcio`);

--
-- Filtros para la tabla `preguntas_frecuentes`
--
ALTER TABLE `preguntas_frecuentes`
  ADD CONSTRAINT `fk_pregunta_administrador` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
