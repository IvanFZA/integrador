function confirmarEliminar(id_planta) {
    if (confirm('¿Estás seguro de que deseas eliminar esta planta?')) {
        fetch('php/eliminar_planta_proceso.php?id_planta=' + id_planta)
            .then(response => response.text())
            .then(data => {
            alert(data); // Mostrar el mensaje de confirmación o error
            fetch('php/eliminar_planta.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data;
            })
            .catch(error => console.error('Error cargando eliminar_planta.php:', error));
            })
            .catch(error => console.error('Error al eliminar la planta:', error));
    }
}
