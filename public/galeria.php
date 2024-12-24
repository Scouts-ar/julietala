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
</head>
<body>

    <!-- Icono de las tres rayitas -->
    <div id="menu-toggle">&#9776;</div>

    <!-- Barra lateral -->
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
    foreach ($imagenes as $imagen) {
        $rutaCompleta = $directorio . '/' . $imagen;
        echo '<img src="' . $rutaCompleta . '" alt="Imagen">';
    }
} else {
    echo '<p style="color: white; text-align: center;">No hay imágenes en la carpeta.</p>';
}

// Cierre del HTML
echo '        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>';
?>
