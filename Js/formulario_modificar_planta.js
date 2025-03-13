function formulario_modificar_planta(){
    const datos = new FormData(document.getElementById("formulario4"));
    fetch('php/actualizar_planta.php',{
            method: 'POST',
            body: datos
        })
        .then(response => response.text())
        .then(datos =>{
        alert(datos); // Mostrar el mensaje de éxito o error  
        fetch('php/editar_planta.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error cargando editar_planta.php:', error));      
    } )
}