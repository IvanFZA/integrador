function agregarCategoria() {
    const datos = new FormData(document.getElementById("formulario4"));
    fetch('php/procesar_agregar_catalogo.php', {
            method: 'POST',
            body: datos
        })
        .then(response => response.text())
        .then(datos =>{
        alert(datos); // Mostrar el mensaje de éxito o error  
        fetch('php/gestionar_catalogos.php')
        .then(response => response.text())
        .then(data => {
            console.log('Cargando gestionar_catalogos.php');
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error cargando gestionar_catalogos.php:', error));   
        var myModalEl = document.getElementById('addCatalogModal');
        var modal = bootstrap.Modal.getInstance(myModalEl);
        modal.hide();
    } )
}
