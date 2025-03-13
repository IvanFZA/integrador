function agregarConsorcio() {
    // Validar las coordenadas antes de enviar el formulario
    const coordenadasInput = document.getElementById('coordenadas');
    const regex = /^-?\d{1,3}(\.\d+)?\s*,\s*-?\d{1,3}(\.\d+)?$/; // Mejorada para espacios opcionales

    if (!regex.test(coordenadasInput.value)) {
        alert('Por favor, selecciona una ubicación válida en el mapa con el formato correcto (latitud, longitud).');
        return; // Detener la ejecución si las coordenadas no son válidas
    }

    // Convertir coordenadas a números y validar rangos
    const [latStr, lngStr] = coordenadasInput.value.split(',').map(coord => coord.trim());
    const lat = parseFloat(latStr);
    const lng = parseFloat(lngStr);

    if (isNaN(lat) || isNaN(lng) || lat < -90 || lat > 90 || lng < -180 || lng > 180) {
        alert('Las coordenadas deben estar en los rangos: Latitud (-90 a 90), Longitud (-180 a 180).');
        return; // Detener si las coordenadas no están en el rango válido
    }

    // Mostrar coordenadas formateadas para depuración
    console.log(`Coordenadas validadas: Latitud: ${lat.toFixed(6)}, Longitud: ${lng.toFixed(6)}`);

    // Obtener los datos del formulario
    const datos = new FormData(document.getElementById("formulario2"));

    // Enviar los datos al servidor
    fetch('php/procesar_agregar_consorcio.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.text())
    .then(datos => {
        alert(datos); // Mostrar el mensaje de éxito o error

        // Recargar el contenido de la página después de agregar el consorcio
        fetch('php/modificar_consorcio.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;

            // Cargar scripts dinámicamente si no están ya cargados
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
        })
        .catch(error => console.error('Error cargando modificar_consorcio.php:', error));
    })
    .catch(error => {
        console.error('Error al enviar el formulario:', error);
        alert('Ocurrió un error al enviar el formulario. Por favor, inténtalo de nuevo.');
    });
}