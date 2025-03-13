function agregarPlanta() {
    const datos = new FormData(document.getElementById("formulario1"));
    fetch('php/procesar_agregar_planta.php', {
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
            if (!document.getElementById('verPlantaScript')) {
                const script = document.createElement("script");
                script.id = 'verPlantaScript'; 
                script.src = "Js/ver_planta.js";
                document.body.appendChild(script);
            }         
            if (!document.getElementById('modificarPlantaScript')) {
                const script = document.createElement("script");
                script.id = 'modificarPlantaScript'; 
                script.src = "Js/modificar_planta.js";
                document.body.appendChild(script);
            }            
        })
        .catch(error => console.error('Error cargando editar_planta.php:', error));         
    } )
}