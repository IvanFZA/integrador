function cargarFormularioEditarCatalogo(id) {
    console.log('Cargando formulario para editar catálogo con ID:', id);
    fetch('php/editar_catalogo.php?id=' + id)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error cargando formulario de editar catálogo:', error));

}
