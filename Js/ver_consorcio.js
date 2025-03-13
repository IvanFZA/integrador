function cargarInformacionConsorcio(id_consorcio) {
    console.log('Cargando la información del consorcio con ID:', id_consorcio); // Depuración: verificar el ID

    // Cargar la información del consorcio seleccionado
    fetch('php/formulario_ver_consorcio.php?id_consorcio=' + id_consorcio)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data; // Cargar la información en el <main>
        })
        .catch(error => console.error('Error:', error));
}
