<?php
// Configuración de la carpeta de perfiles
$directorio = 'perfiles';
$archivos = array_diff(scandir($directorio), array('..', '.'));
$perfiles = [];

// Extraer información de cada archivo HTML en la carpeta
foreach ($archivos as $archivo) {
    if (pathinfo($archivo, PATHINFO_EXTENSION) === 'html') {
        $contenido = file_get_contents($directorio . '/' . $archivo);
        $nombre = $instagram = $descripcion = '';
        $nombrePerfil = pathinfo($archivo, PATHINFO_FILENAME);

        // Extraer información del HTML
        if (preg_match('/<h3>(.*?)<\/h3>/', $contenido, $matchNombre)) {
            $nombre = $matchNombre[1];
        }
        if (preg_match('/Instagram:\s*(.*?)<\/p>/', $contenido, $matchInstagram)) {
            $instagram = $matchInstagram[1];
        }
        if (preg_match('/<p>(?!Instagram)(.*?)<\/p>/', $contenido, $matchDescripcion)) {
            $descripcion = $matchDescripcion[1];
        }

        // Verificar si existe la imagen correspondiente
        $imagen = file_exists("$directorio/$nombrePerfil.jpg") ? "$nombrePerfil.jpg" : "default.jpg";

        // Agregar perfil al array
        $perfiles[] = [
            'nombre' => $nombre,
            'instagram' => $instagram,
            'descripcion' => $descripcion,
            'imagen' => $imagen,
        ];
    }
}

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfiles</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #menu-toggle {
            font-size: 30px;
            cursor: pointer;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 2000;
        }
        #menu-toggle.open {
            display: none;
        }
        #sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: rgba(139, 0, 0, 0.8); /* Rojo oscuro con 80% transparencia */
            padding-top: 60px;
            transition: left 0.3s;
            z-index: 1500;
        }
        #sidebar.open {
            left: 0;
        }
        #sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        #sidebar ul li {
            padding: 15px;
            text-align: center;
        }
        #sidebar ul li a img {
            width: 40px;
            height: auto;
        }
        #perfiles {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            padding: 20px;
        }
        #perfiles .perfil {
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
        #perfiles img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
    <script src="script.js"></script>
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
    <div id="perfiles">';

// Mostrar perfiles
foreach ($perfiles as $index => $perfil) {
    echo '<div class="perfil" onclick="openModal(' . $index . ')">
            <img src="' . $directorio . '/' . $perfil['imagen'] . '" alt="' . htmlspecialchars($perfil['nombre']) . '">
            <h3>' . htmlspecialchars($perfil['nombre']) . '</h3>
        </div>';
}

echo '</div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalNombre"></h2>
            <img id="modalImagen" src="" alt="Imagen">
            <p id="modalDescripcion"></p>
            <p id="modalInstagram"></p>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        var modalNombre = document.getElementById("modalNombre");
        var modalImagen = document.getElementById("modalImagen");
        var modalDescripcion = document.getElementById("modalDescripcion");
        var modalInstagram = document.getElementById("modalInstagram");

        var perfiles = ' . json_encode($perfiles) . ';

        function openModal(index) {
            var perfil = perfiles[index];
            modal.style.display = "flex";
            modalNombre.textContent = perfil.nombre;
            modalImagen.src = "' . $directorio . '/" + perfil.imagen;
            modalDescripcion.textContent = perfil.descripcion || "Sin descripción";
            modalInstagram.innerHTML = perfil.instagram ? "<a href=\'https://instagram.com/" + perfil.instagram + "\'>@" + perfil.instagram + "</a>" : "Sin Instagram";
        }

        function closeModal() {
            modal.style.display = "none";
        }
    </script>
</body>
</html>';
?>
