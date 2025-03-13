function cargarFormularioEditar(id) {
    fetch('php/formulario_editar_planta.php?id_planta=' + id)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error cargando formulario de edición:', error));
}
