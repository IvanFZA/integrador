function agregarPregunta() {
    const datos = new FormData(document.getElementById("formulario3"));
    fetch('php/procesar_agregar_pregunta.php', {
            method: 'POST',
            body: datos
        })
        .then(response => response.text())
        .then(datos =>{
        alert(datos); // Mostrar el mensaje de éxito o error  
        fetch('php/gestionar_preguntas.php')
        .then(response => response.text())
        .then(data => {
            console.log('Cargando gestionar_preguntas.php');
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error cargando gestionar_preguntas.php:', error));   
        var myModalEl = document.getElementById('addQuestionModal');
        var modal = bootstrap.Modal.getInstance(myModalEl);
        modal.hide();   
    } )
}
