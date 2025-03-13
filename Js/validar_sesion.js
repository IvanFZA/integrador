document.addEventListener("DOMContentLoaded", function () {
    fetch("php/validar_sesion.php", { cache: "no-store" })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "redirigir") {
                window.location.href = "./index.html"; // Redirige si no hay sesión
            } else {
                document.getElementById("admin-content").style.display = "block"; // Muestra contenido
                document.getElementById("loading").style.display = "none"; // Oculta mensaje de carga
            }
        })
        .catch(error => {
            console.error("Error al verificar la sesión:", error);
            alert("Hubo un problema al verificar la sesión.");
            window.location.href = "./index.html";
        });
});
