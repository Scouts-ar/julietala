<?php
// Configuración de la carpeta de imágenes
$directorio = 'fotos';
$imagenes = array_diff(scandir($directorio), array('..', '.'));

// HTML inicial
echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Fotos</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        #galeria {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            justify-items: center;
            padding: 20px;
        }
        #galeria img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
            cursor: pointer;
        }
        #galeria img:hover {
            transform: scale(1.1);
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            position: relative;
            max-width: 90%;
            max-height: 80%;
            margin: 0 auto;
        }
        .modal img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .modal .close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }
        .modal .prev, .modal .next {
            position: absolute;
            top: 50%;
            font-size: 30px;
            color: white;
            cursor: pointer;
            transform: translateY(-50%);
        }
        .modal .prev {
            left: 15px;
        }
        .modal .next {
            right: 15px;
        }

        /* Estilos para la cabecera */
        #bienvenida-titulo {
            padding-top: 50px;
            text-align: center;
            font-size: 3rem;
            color: #FFD700;
        }
    </style>
</head>
<body>
    <div id="menu-toggle">&#9776;</div>
    <div id="sidebar">
        <ul>
            <li><a href="index.html"><img src="logos/inicio.png" alt="Inicio"></a></li>
            <li><a href="perfiles.html"><img src="logos/perfiles.png" alt="Perfiles"></a></li>
            <li><a href="historia.html"><img src="logos/historia.png" alt="Historia"></a></li>
            <li><a href="galeria.php"><img src="logos/fotos.png" alt="Fotos"></a></li>
        </ul>
    </div>
    <div id="content">
        <h1 id="bienvenida-titulo">Galería de <span style="color: #FFD700;">Imágenes</span></h1>
        <div id="galeria">';

// Mostrar imágenes
if (!empty($imagenes)) {
    foreach ($imagenes as $index => $imagen) {
        $rutaCompleta = $directorio . '/' . $imagen;
        echo '<img src="' . $rutaCompleta . '" alt="Imagen" onclick="openModal(' . $index . ')">';
    }
} else {
    echo '<p style="color: white; text-align: center;">No hay imágenes en la carpeta.</p>';
}

echo '        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Imagen">
            <span class="prev" onclick="changeImage(-1)">&#10094;</span>
            <span class="next" onclick="changeImage(1)">&#10095;</span>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        var modalImage = document.getElementById("modalImage");
        var images = ' . json_encode($imagenes) . ';
        var currentImageIndex = 0;

        function openModal(index) {
            currentImageIndex = index;
            modal.style.display = "flex";
            modalImage.src = "' . $directorio . '/" + images[currentImageIndex];
        }

        function closeModal() {
            modal.style.display = "none";
        }

        function changeImage(direction) {
            currentImageIndex += direction;
            if (currentImageIndex < 0) currentImageIndex = images.length - 1;
            if (currentImageIndex >= images.length) currentImageIndex = 0;
            modalImage.src = "' . $directorio . '/" + images[currentImageIndex];
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
    <script src="script.js"></script>
</body>
</html>';
?>
