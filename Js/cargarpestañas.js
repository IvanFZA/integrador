// Referencias a elementos del DOM
const hamburger = document.getElementById('hamburger');
const menu = document.getElementById('menu');
const overlay = document.getElementById('overlay');
const closeMenuButton = menu.querySelector('.close-menu');
const adminLogin = document.getElementById('admin-login');

// Abrir el menú lateral
hamburger.addEventListener('click', () => {
    menu.classList.toggle('open');
    overlay.classList.toggle('active');
});

// Cerrar el menú lateral al hacer clic en el overlay
overlay.addEventListener('click', () => {
    menu.classList.remove('open');
    overlay.classList.remove('active');
});

// Cerrar el menú lateral al hacer clic en el botón de cierre
closeMenuButton.addEventListener('click', () => {
    menu.classList.remove('open');
    overlay.classList.remove('active');
});

// Función para inicializar el mapa
function inicializarMapa() {
    const map = L.map('map').setView([19.4326, -99.1332], 13); // Ciudad de México

    // Añadir capa base (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Corregir problemas de visualización del mapa
    setTimeout(() => {
        map.invalidateSize();
    }, 0);

    // Variable para el marcador
    let marker;

    // Manejar clics en el mapa
    function onMapClick(e) {
        const { lat, lng } = e.latlng;

        // Eliminar marcador previo si existe
        if (marker) {
            map.removeLayer(marker);
        }

        // Crear nuevo marcador
        marker = L.marker([lat, lng]).addTo(map)
            .bindPopup(`Coordenadas seleccionadas: ${lat.toFixed(6)}, ${lng.toFixed(6)}`)
            .openPopup();

        // Actualizar campo de coordenadas
        document.getElementById('coordenadas').value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
    }

    // Escuchar clics en el mapa
    map.on('click', onMapClick);
}

// Cargar el módulo para agregar la planta y generar el script que se utiliza en ella
document.getElementById('agregarPlanta').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('php/agregar_planta.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            // Verificar si el script ya ha sido agregado
            if (!document.getElementById('agregarPlantaScript')) {
                const script = document.createElement("script");
                script.id = 'agregarPlantaScript'; // Asignar un ID al script
                script.src = "Js/agregar_planta.js";
                document.body.appendChild(script);
            }
        })
        .catch(error => console.error('Error cargando agregar_planta.php:', error));
});

// Cargar el módulo de ver planta y generar el script para mostrar los detalles de la planta y abrir el formulario para modificarla
document.getElementById('VerPlanta').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('php/editar_planta.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            if (!document.getElementById('verPlantaScript')) {
                const script = document.createElement("script");
                script.id = 'verPlantaScript'; 
                script.src = "Js/ver_planta.js";
                document.body.appendChild(script);
            }         
            if (!document.getElementById('modificarPlantaScript')) {
                const script = document.createElement("script");
                script.id = 'modificarPlantaScript'; 
                script.src = "Js/modificar_planta.js";
                document.body.appendChild(script);
            }    
            if (!document.getElementById('formularioModificarPlantaScript')) {
                const script = document.createElement("script");
                script.id = 'formularioModificarPlantaScript'; 
                script.src = "Js/formulario_modificar_planta.js";
                document.body.appendChild(script);
            }                
        })
        .catch(error => console.error('Error cargando editar_planta.php:', error));
});

// Cargar el módulo de eliminar planta y cargar el script que se utiliza
document.getElementById('eliminarPlanta').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('php/eliminar_planta.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            if (!document.getElementById('eliminarPlantaScript')) {
                const script = document.createElement("script");
                script.id = 'eliminarPlantaScript'; 
                script.src = "Js/eliminar_planta.js";
                document.body.appendChild(script);
            }            
        })
        .catch(error => console.error('Error cargando eliminar_planta.php:', error));
});

// Cargar el módulo de agregar consorcio y cargar el script que se utiliza
document.getElementById('agregarConsorcio').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('php/agregar_consorcio.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;

            // Inicializar el mapa después de cargar el contenido
            inicializarMapa();

            // Verificar si el script ya ha sido agregado
            if (!document.getElementById('agregarConsorcioScript')) {
                const script = document.createElement("script");
                script.id = 'agregarConsorcioScript'; 
                script.src = "Js/agregar_consorcio.js";
                document.body.appendChild(script);
            }       
        })
        .catch(error => console.error('Error cargando agregar_consorcio.php:', error));
});

// Cargar el módulo de ver consorcio y cargar los scripts que se utilizan para su funcionamiento
document.getElementById('modificarConsorcio').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('php/modificar_consorcio.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            if (!document.getElementById('verConsorcioScript')) {
                const script = document.createElement("script");
                script.id = 'verConsorcioScript'; 
                script.src = "Js/ver_consorcio.js";
                document.body.appendChild(script);
            }       
            if (!document.getElementById('modificarConsorcioScript')) {
                const script = document.createElement("script");
                script.id = 'modificarConsorcioScript'; 
                script.src = "Js/modificar_consorcio.js";
                document.body.appendChild(script);
            }       
            if (!document.getElementById('eliminarPlantaConsorcioScript')) {
                const script = document.createElement("script");
                script.id = 'eliminarPlantaConsorcioScript'; 
                script.src = "Js/eliminar_planta_consorcio.js";
                document.body.appendChild(script);
            }       
            if (!document.getElementById('formularioModificarConsorcioScript')) {
                const script = document.createElement("script");
                script.id = 'formularioModificarConsorcioScript'; 
                script.src = "Js/formulario_modificar_consorcio.js";
                document.body.appendChild(script);
            }              
        })
        .catch(error => console.error('Error cargando modificar_consorcio.php:', error));
});

// Resto del código (eliminarConsorcio, gestionarCatalogos, agregarAdministrador, cerrarSesion, verPreguntasFrecuentes)...
document.getElementById('eliminarConsorcio').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('php/eliminar_consorcio.php')
        .then(response => response.text())
        .then(data => {
            console.log('Cargando ver_catalogos.php');
            document.getElementById('content').innerHTML = data;
            if (!document.getElementById('eliminarConsorcioScript')) {
                const script = document.createElement("script");
                script.id = 'eliminarConsorcioScript'; 
                script.src = "Js/eliminar_consorcio.js";
                document.body.appendChild(script);
            }       
        })
        .catch(error => console.error('Error cargando eliminar_consorcio.php:', error));
});

document.getElementById('gestionarCatalogos').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('php/gestionar_catalogos.php')
        .then(response => response.text())
        .then(data => {
            console.log('Cargando gestionar_catalogos.php');
            document.getElementById('content').innerHTML = data;
            if (!document.getElementById('verCatalogoScript')) {
                const script = document.createElement("script");
                script.id = 'verCatalogoScript'; 
                script.src = "Js/ver_categoria.js";
                document.body.appendChild(script);
            }       
            if (!document.getElementById('eliminarCatalogoScript')) {
                const script = document.createElement("script");
                script.id = 'eliminarCatalogoScript'; 
                script.src = "Js/eliminar_categoria.js";
                document.body.appendChild(script);
            }       
            if (!document.getElementById('agregarCategoriaScript')) {
                const script = document.createElement("script");
                script.id = 'agregarCategoriaScript'; 
                script.src = "Js/agregar_categoria.js";
                document.body.appendChild(script);
            }  
            if (!document.getElementById('editarCategoriaScript')) {
                const script = document.createElement("script");
                script.id = 'editarCategoriaScript'; 
                script.src = "Js/editar_categoria.js";
                document.body.appendChild(script);
            }   
        })
        .catch(error => console.error('Error cargando gestionar_catalogos.php:', error));
});

document.getElementById('agregarAdministrador').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('php/agregar_administrador.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
            if (!document.getElementById('agregarAdministradorScript')) {
                const script = document.createElement("script");
                script.id = 'agregarAdministradorScript'; 
                script.src = "Js/agregar_administrador.js";
                document.body.appendChild(script);
            }   
        });
});

document.getElementById('cerrarSesion').addEventListener('click', function(event) {
    event.preventDefault();
    if (confirm('¿Estás seguro de que deseas cerrar la sesión?')) {
        window.location.href = 'php/cerrar_sesion.php';
    }
});

document.getElementById('verPreguntasFrecuentes').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('php/gestionar_preguntas.php')
        .then(response => response.text())
        .then(data => {
            console.log('Cargando gestionar_preguntas.php');
            document.getElementById('content').innerHTML = data;
            if (!document.getElementById('verPreguntaScript')) {
                const script = document.createElement("script");
                script.id = 'verPreguntaScript'; 
                script.src = "Js/ver_pregunta.js";
                document.body.appendChild(script);
            }       
            if (!document.getElementById('eliminarPreguntaScript')) {
                const script = document.createElement("script");
                script.id = 'eliminarPreguntaScript'; 
                script.src = "Js/eliminar_pregunta.js";
                document.body.appendChild(script);
            }       
            if (!document.getElementById('agregarPreguntaScript')) {
                const script = document.createElement("script");
                script.id = 'agregarPreguntaScript'; 
                script.src = "Js/agregar_pregunta.js";
                document.body.appendChild(script);
            }   
            if (!document.getElementById('editarPreguntaScript')) {
                const script = document.createElement("script");
                script.id = 'editarPreguntaScript'; 
                script.src = "Js/editar_pregunta.js";
                document.body.appendChild(script);
            }   
        })
        .catch(error => console.error('Error cargando gestionar_preguntas.php:', error));
});