function confirmarEliminarPlanta(id_planta, id_consorcio) {
    if (confirm('¿Estás seguro de que deseas eliminar esta planta del consorcio?')) {
        fetch(`php/desasociar_planta_proceso.php?id_planta=${id_planta}&id_consorcio=${id_consorcio}`)
            .then(response => response.text())
            .then(data => {
                alert(data); // Muestra el mensaje de éxito o error
                location.reload(); // Recarga la página para actualizar la lista de plantas
            })
            .catch(error => console.error('Error al desasociar la planta:', error));
    }
}
