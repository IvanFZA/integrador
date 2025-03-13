function cargarFormularioModificar(id_consorcio) {
    fetch('php/formulario_modificar_consorcio.php?id_consorcio=' + id_consorcio)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}
