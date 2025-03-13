function verPlanta(id) {
    if (id) {
        fetch('php/detalle_planta.php?id_planta=' + id)
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data;
            })
            .catch(error => console.error('Error cargando detalles de la planta:', error));
    } else {
        console.error('No se proporcionó un ID válido.');
    }
}
