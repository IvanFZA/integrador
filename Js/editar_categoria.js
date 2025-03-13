function editarCategoria() {
    const datos = new FormData(document.getElementById("formulario9"));
    fetch('php/procesar_editar_catalogo.php', {
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
    } )
}
