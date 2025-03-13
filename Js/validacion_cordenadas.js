function validarCoordenadas(coordenadas) {
    const regex = /^-?\d+(\.\d+)?,\s*-?\d+(\.\d+)?$/;
    return regex.test(coordenadas);
}

function agregarConsorcio() {
    const coordenadas = document.getElementById('coordenadas').value;
    if (!validarCoordenadas(coordenadas)) {
        alert('Por favor, ingresa coordenadas válidas en formato "Latitud, Longitud".');
        return;
    }
    // Aquí puedes continuar con la lógica para agregar el consorcio
}