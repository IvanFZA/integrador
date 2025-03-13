function agregarAdministrador() {
    const datos = new FormData(document.getElementById("formulario6"));
    fetch('php/procesar_agregar_administrador.php', {
            method: 'POST',
            body: datos
        })
        .then(response => response.text())
        .then(datos =>{
        alert(datos); // Mostrar el mensaje de éxito o error  
        fetch('php/agregar_administrador.php')
        .then(response => response.text())
        .then(data => {
            console.log('Cargando agregar administrador.php');
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error cargando agregar administrador.php:', error));   
        var myModalEl = document.getElementById('registroAdminModal');
        var modal = bootstrap.Modal.getInstance(myModalEl);
        modal.hide();
    } )
}