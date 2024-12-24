document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar");
    const menuToggle = document.getElementById("menu-toggle");

    // Cuando se hace clic en las rayitas, se alterna la clase 'open' en el sidebar
    menuToggle.addEventListener("click", function() {
        sidebar.classList.toggle("open");
        menuToggle.classList.toggle("open"); // Hacer desaparecer las rayitas cuando la barra se despliega
    });

    // Ocultar la barra lateral cuando el mouse se aleje
    sidebar.addEventListener("mouseleave", function() {
        sidebar.classList.remove("open");
        menuToggle.classList.remove("open"); // Volver a mostrar las rayitas cuando la barra se oculta
    });
});
