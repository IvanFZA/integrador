const hamburger = document.getElementById('hamburger');
const menu = document.getElementById('menu');
const overlay = document.getElementById('overlay');
const closeMenuButton = menu.querySelector('.close-menu');
const adminLogin = document.getElementById('admin-login');

function closeMenu() {
    menu.classList.remove('open');
    overlay.classList.remove('active');
}

hamburger.addEventListener('click', () => {
    menu.classList.toggle('open');
    overlay.classList.toggle('active');
});

overlay.addEventListener('click', closeMenu);
closeMenuButton.addEventListener('click', closeMenu);

adminLogin.addEventListener('click', (event) => {
    event.preventDefault();
    closeMenu();
    window.location.href = 'php/login.php';
});

document.addEventListener("DOMContentLoaded", () => {
    const dynamicContent = document.getElementById("dynamic-content");
    const menuLinks = document.querySelectorAll("#menu a");

    menuLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const url = link.getAttribute("href");

            closeMenu();

            if (url === "php/login.php" || url === "mapa.html") {
                window.location.href = url;
            } else if (url === "#") {
                window.location.reload();
            } else {
                loadContent(url);
            }
        });
    });

    function loadContent(url) {
        fetch(url)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error al cargar el contenido");
                }
                return response.text();
            })
            .then((html) => {
                dynamicContent.innerHTML = html;
            })
            .catch((error) => {
                dynamicContent.innerHTML = `<div class="text-red-600">Error: ${error.message}</div>`;
            });
    }
});