// Obtener elementos del DOM
const modal = document.getElementById("errorModal");
const modalMessage = document.getElementById("modalMessage");
const retryButton = document.getElementById("retryButton");
const goToMenuButton = document.getElementById("goToMenuButton");
const closeModalIcon = document.querySelector(".close");

// Función para mostrar el modal con un mensaje
function showModal(message) {
    modalMessage.textContent = message;
    modal.style.display = "flex";
}

// Función para cerrar el modal
function closeModal() {
    modal.style.display = "none";
}

// Evento para volver a intentar
retryButton.addEventListener("click", () => {
    closeModal();
    // Aquí puedes agregar lógica adicional si es necesario
});

// Evento para regresar al menú principal
goToMenuButton.addEventListener("click", () => {
    window.location.href = "../index.html"; // Redirigir al menú principal
});

// Evento para cerrar el modal al hacer clic en la "X"
closeModalIcon.addEventListener("click", closeModal);

// Mostrar el modal si hay un error en la URL
const urlParams = new URLSearchParams(window.location.search);
const errorType = urlParams.get("error");

if (errorType) {
    let errorMessage = "";

    switch (errorType) {
        case "invalid_email":
            errorMessage = "El correo electrónico no es válido. Por favor, inténtalo de nuevo.";
            break;
        case "wrong_password":
            errorMessage = "Contraseña incorrecta. Solo los administradores pueden iniciar sesión.";
            break;
        case "admin_only":
            errorMessage = "Correo electrónico no encontrado. Solo los administradores pueden iniciar sesión.";
            break;
        case "missing_fields":
            errorMessage = "Por favor, completa todos los campos.";
            break;
        case "server_error":
            errorMessage = "Error en el servidor. Inténtalo de nuevo más tarde.";
            break;
        default:
            errorMessage = "Ocurrió un error inesperado. Por favor, inténtalo de nuevo.";
            break;
    }

    showModal(errorMessage);
}

// Obtener el botón de regresar
const btnRegresar = document.getElementById("btn-regresar");

// Redirigir al hacer clic en el botón de regresar
btnRegresar.addEventListener("click", () => {
    window.location.href = "../index.html";
});