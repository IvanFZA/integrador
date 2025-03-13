function confirmarEliminarConsorcio(id_consorcio) {
    if (confirm('¿Estás seguro de que deseas eliminar este consorcio? Todas las plantas serán desasociadas.')) {
        fetch('php/eliminar_consorcio_proceso.php?id_consorcio=' + id_consorcio)
            .then(response => response.text())
            .then(data => {
            alert(data); // Mostrar el mensaje de éxito o error
            fetch('php/eliminar_consorcio.php')
            .then(response => response.text())
            .then(data => {
                console.log('Cargando ver_catalogos.php');
                document.getElementById('content').innerHTML = data;
            })
            .catch(error => console.error('Error cargando eliminar_consorcio.php:', error));
            })
            .catch(error => console.error('Error al eliminar el consorcio:', error));
    }
}
