function confirmarEliminarCatalogo(id_categoria) {
    if (confirm('¿Estás seguro de que deseas eliminar este catálogo?')) {
        fetch('php/eliminar_catalogo.php?id_categoria=' + id_categoria) // Corregido: Usamos id_categoria
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrar el mensaje de confirmación o error
                fetch('php/gestionar_catalogos.php')
                .then(response => response.text())
                .then(data => {
                    console.log('Cargando gestionar_catalogos.php');
                    document.getElementById('content').innerHTML = data;
                })
                .catch(error => console.error('Error cargando gestionar_catalogos.php:', error));   
            })
            .catch(error => console.error('Error al eliminar el catálogo:', error));
    }
}
