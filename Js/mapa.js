document.addEventListener("DOMContentLoaded", function () {
    var map = L.map('map').setView([20.123456, -99.654321], 6);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marcador = L.marker([20.123456, -99.654321], { draggable: true }).addTo(map);

    function actualizarCoordenadas(lat, lng) {
        document.getElementById('coordenadas').value = lat.toFixed(6) + ", " + lng.toFixed(6);
    }

    marcador.on('dragend', function () {
        var latLng = marcador.getLatLng();
        actualizarCoordenadas(latLng.lat, latLng.lng);
    });

    map.on('click', function (e) {
        marcador.setLatLng(e.latlng);
        actualizarCoordenadas(e.latlng.lat, e.latlng.lng);
    });

    // Guardar coordenadas en localStorage al agregar el consorcio
    window.agregarConsorcio = function () {
        var nombre = document.getElementById("nombre").value;
        var coordenadas = document.getElementById("coordenadas").value;

        if (!nombre || !coordenadas) {
            alert("Por favor, ingrese todos los datos.");
            return;
        }

        var consorcios = JSON.parse(localStorage.getItem("consorcios")) || [];
        consorcios.push({ nombre: nombre, coordenadas: coordenadas });
        localStorage.setItem("consorcios", JSON.stringify(consorcios));

        alert("Consorcio agregado correctamente.");
        window.location.reload(); // Opcional, para actualizar la página
    };
});
