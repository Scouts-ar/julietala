<?php
// Configuración de la carpeta de imágenes
$directorio = 'fotos';
$imagenes = array_diff(scandir($directorio), array('..', '.'));

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Fotos</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos para la galería */
        #galeria {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            padding: 20px;
        }
        #galeria img {
            width: 200px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
            cursor: pointer;
        }
        #galeria img:hover {
            transform: scale(1.1);
        }

        /* Modal styles */
        #modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        #modal img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            cursor: zoom-in;
        }
        #modal .close-btn, #modal .prev-btn, #modal .next-btn {
            position: absolute;
            top: 20px;
            color: white;
            font-size: 30px;
            background-color: rgba(0, 0, 0, 0.6);
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }
        #modal .close-btn {
            right: 20px;
        }
        #modal .prev-btn {
            left: 20px;
        }
        #modal .next-btn {
            right: 60px;
        }

        /* Estilos para el menú lateral */
        #sidebar {
            position: fixed;
            left: -250px;
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #333;
            color: white;
            padding-top: 20px;
            transition: left 0.3s ease;
            z-index: 100;
        }
        #sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        #sidebar ul li {
            padding: 15px;
            text-align: center;
        }
        #sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }
        #sidebar ul li a:hover {
            background-color: #444;
        }
        /* Icono de las tres rayas */
        #menu-toggle {
            font-size: 30px;
            color: #333;
            cursor: pointer;
            margin-left: 20px;
            display: block;
        }

        /* Estilos para el contenido */
        #content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- Icono de las tres rayas para mostrar el menú -->
    <div id="menu-toggle">&#9776;</div>

    <!-- Sidebar -->
    <div id="sidebar">
        <ul>
            <li><a href="index.html"><img src="logos/inicio.png" alt="Inicio"></a></li>
            <li><a href="perfiles.html"><img src="logos/perfiles.png" alt="Perfiles"></a></li>
            <li><a href="historia.html"><img src="logos/historia.png" alt="Historia"></a></li>
            <li><a href="galeria.php"><img src="logos/fotos.png" alt="Fotos"></a></li>
        </ul>
        <div class="instagram-title">Instagram</div>
        <ul id="social-media">
            <li><a href="#"><img src="logos/instagram.jpg" alt="Instagram 1"></a></li>
            <li><a href="#"><img src="logos/instagram.jpg" alt="Instagram 2"></a></li>
        </ul>
    </div>

    <!-- Contenido principal -->
    <div id="content">
        <h1 id="bienvenida-titulo">Galería de <span style="color: #FFD700;">Imágenes</span></h1>
        <div id="galeria">';

        // Mostrar imágenes
        if (!empty($imagenes)) {
            foreach ($imagenes as $index => $imagen) {
                $rutaCompleta = $directorio . '/' . $imagen;
                echo '<img src="' . $rutaCompleta . '" alt="Imagen" data-index="' . $index . '" class="thumbnail">';
            }
        } else {
            echo '<p style="color: white; text-align: center;">No hay imágenes en la carpeta.</p>';
        }

        echo '    </div>
    </div>

    <!-- Modal -->
    <div id="modal">
        <button class="close-btn">&times;</button>
        <button class="prev-btn">&#60;</button>
        <button class="next-btn">&#62;</button>
        <img src="" alt="Imagen Modal" id="modal-img">
    </div>

    <script>
        const modal = document.getElementById("modal");
        const modalImg = document.getElementById("modal-img");
        const closeBtn = document.querySelector(".close-btn");
        const prevBtn = document.querySelector(".prev-btn");
        const nextBtn = document.querySelector(".next-btn");
        const thumbnails = document.querySelectorAll(".thumbnail");
        let currentIndex = -1;

        // Función para abrir el modal
        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener("click", () => {
                currentIndex = index;
                openModal();
            });
        });

        // Funciones para cambiar de imagen
        closeBtn.addEventListener("click", closeModal);
        prevBtn.addEventListener("click", showPrevImage);
        nextBtn.addEventListener("click", showNextImage);

        function openModal() {
            modal.style.display = "flex";
            modalImg.src = thumbnails[currentIndex].src;
        }

        function closeModal() {
            modal.style.display = "none";
        }

        function showPrevImage() {
            currentIndex = (currentIndex === 0) ? thumbnails.length - 1 : currentIndex - 1;
            modalImg.src = thumbnails[currentIndex].src;
        }

        function showNextImage() {
            currentIndex = (currentIndex === thumbnails.length - 1) ? 0 : currentIndex + 1;
            modalImg.src = thumbnails[currentIndex].src;
        }

        // Mostrar u ocultar el sidebar
        const menuToggle = document.getElementById("menu-toggle");
        menuToggle.addEventListener("click", () => {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            if (sidebar.style.left === "-250px") {
                sidebar.style.left = "0";
                content.style.marginLeft = "250px";
            } else {
                sidebar.style.left = "-250px";
                content.style.marginLeft = "0";
            }
        });
    </script>
</body>
</html>';
?>
