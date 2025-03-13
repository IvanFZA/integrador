function cargarFormularioEditarPregunta(id) {
    fetch('php/editar_pregunta.php?id=' + id)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el formulario de editar pregunta:', error));
}
