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
        /* Estilo para la galería */
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
        
        /* Estilo para el Modal */
        #modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }
        #modal-content {
            position: relative;
            background-color: white;
            padding: 20px;
            max-width: 80%;
            max-height: 80%;
            overflow: auto;
        }
        #modal img {
            width: 100%;
            height: auto;
        }
        #modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 30px;
            color: white;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
        #modal-prev, #modal-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 30px;
            color: white;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
        #modal-prev {
            left: 10px;
        }
        #modal-next {
            right: 10px;
        }

        /* Estilo para el formulario de agregar imágenes */
        #upload-form {
            text-align: center;
            margin-top: 20px;
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
        
        <!-- Formulario para subir imágenes -->
        <div id="upload-form">
            <h2>Agregar una nueva imagen</h2>
            <form action="subir_imagen.php" method="post" enctype="multipart/form-data">
                <input type="file" name="imagen" required>
                <button type="submit">Subir Imagen</button>
            </form>
        </div>

        <!-- Galería de imágenes -->
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

        echo '    </div>
    </div>
    
    <!-- Modal para mostrar la imagen grande -->
    <div id="modal">
        <div id="modal-content">
            <button id="modal-close" onclick="closeModal()">x</button>
            <button id="modal-prev" onclick="prevImage()">&#60;</button>
            <img id="modal-image" src="" alt="Imagen grande">
            <button id="modal-next" onclick="nextImage()">&#62;</button>
        </div>
    </div>
    
    <script>
        var imagenes = ' . json_encode($imagenes) . ';
        var modalIndex = -1;

        function openModal(index) {
            modalIndex = index;
            document.getElementById("modal-image").src = "fotos/" + imagenes[modalIndex];
            document.getElementById("modal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }

        function prevImage() {
            modalIndex = (modalIndex > 0) ? modalIndex - 1 : imagenes.length - 1;
            document.getElementById("modal-image").src = "fotos/" + imagenes[modalIndex];
        }

        function nextImage() {
            modalIndex = (modalIndex < imagenes.length - 1) ? modalIndex + 1 : 0;
            document.getElementById("modal-image").src = "fotos/" + imagenes[modalIndex];
        }
    </script>
</body>
</html>';
?>
