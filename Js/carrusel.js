document.addEventListener('DOMContentLoaded', function () {
    fetch('php/get_imagenes.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const carruselContainer = document.getElementById('carrusel-container');

            if (data.error) {
                carruselContainer.innerHTML = `<div class="alert alert-warning text-center">${data.error}</div>`;
                return;
            }

            if (data.length === 0) {
                carruselContainer.innerHTML = '<div class="alert alert-warning text-center">No hay imágenes disponibles.</div>';
                return;
            }

            // Generar el carrusel con las imágenes
            let carruselHTML = `
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
            `;

            data.forEach((imagen, index) => {
                carruselHTML += `
                    <div class="carousel-item ${index === 0 ? 'active' : ''}">
                        <img src="uploads/${imagen.fotografia}" class="d-block w-100" alt="Imagen de planta" 
                             data-bs-toggle="modal" data-bs-target="#modalPlanta" 
                             onclick="cargarDetallesPlanta(${imagen.id_planta})">
                    </div>
                `;
            });

            carruselHTML += `
                    </div>
                    <!-- Controles del carrusel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            `;

            // Insertar el carrusel en el contenedor
            carruselContainer.innerHTML = carruselHTML;
        })
        .catch(error => {
            console.error('Error al cargar las imágenes:', error);
            document.getElementById('carrusel-container').innerHTML = '<div class="alert alert-danger text-center">Error al cargar las imágenes.</div>';
        });
});

function cargarDetallesPlanta(id_planta) {
    console.log("ID de la planta:", id_planta); // Verifica que el ID se esté pasando correctamente

    fetch(`php/get_detalles_planta.php?id_planta=${id_planta}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.text(); // Usamos text() porque el PHP devuelve HTML
        })
        .then(data => {
            console.log("Datos recibidos:", data); // Verifica los datos recibidos
            document.getElementById('modalPlantaBody').innerHTML = data;
        })
        .catch(error => {
            console.error('Error al cargar los detalles de la planta:', error);
            document.getElementById('modalPlantaBody').innerHTML = '<div class="alert alert-danger">Error al cargar los detalles de la planta.</div>';
        });
}