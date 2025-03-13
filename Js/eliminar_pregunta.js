function confirmarEliminarPregunta(id_pregunta) {
    if (confirm('¿Estás seguro de que deseas eliminar esta pregunta?')) {
        fetch('php/eliminar_pregunta.php?id_pregunta=' + id_pregunta)
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrar el mensaje de éxito o error
                fetch('php/gestionar_preguntas.php')
                .then(response => response.text())
                .then(data => {
                    console.log('Cargando gestionar_preguntas.php');
                    document.getElementById('content').innerHTML = data;
                })
                .catch(error => console.error('Error cargando gestionar_preguntas.php:', error));
        
            })
            .catch(error => console.error('Error al eliminar la pregunta:', error));
    }
}
