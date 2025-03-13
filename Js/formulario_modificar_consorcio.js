function formulario_modificar_consorcio() {
  // Validar las coordenadas antes de continuar
  if (!validateCoordinates()) {
      return; // Detener la ejecución si las coordenadas no son válidas
  }

  // Obtener los datos del formulario
  const datos = new FormData(document.getElementById("formulario7"));

  // Enviar los datos al servidor
  fetch('php/procesar_modificar_consorcio.php', {
      method: 'POST',
      body: datos
  })
  .then(response => response.text())
  .then(datos => {
      alert(datos); // Mostrar el mensaje de éxito o error

      // Recargar el contenido de la página después de modificar el consorcio
      fetch('php/modificar_consorcio.php')
      .then(response => response.text())
      .then(data => {
          document.getElementById('content').innerHTML = data;
      })
      .catch(error => console.error('Error cargando modificar_consorcio.php:', error));
  })
  .catch(error => {
      console.error('Error al enviar el formulario:', error);
      alert('Ocurrió un error al enviar el formulario. Por favor, inténtalo de nuevo.');
  });
}

// Función para validar las coordenadas
function validateCoordinates() {
  // Se obtiene el valor y se recortan espacios
  var coords = document.getElementById('coordenadas').value.trim();

  // Expresión regular para: número (entero o decimal) + coma + número (entero o decimal)
  var regex = /^-?\d+(\.\d+)?\s*,\s*-?\d+(\.\d+)?$/;

  if (!regex.test(coords)) {
      alert('Por favor, ingrese las coordenadas en el formato correcto: latitud, longitud (ejemplo: 19.4326, -99.1332).');
      return false; // Coordenadas no válidas
  }

  return true; // Coordenadas válidas
}