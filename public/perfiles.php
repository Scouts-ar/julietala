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

        // Extraer información del HTML con expresiones regulares
        if (preg_match('/<h3>(.*?)<\/h3>/', $contenido, $matchNombre)) {
            $nombre = $matchNombre[1];
        }
        if (preg_match('/Instagram: (.*?)<\/p>/', $contenido, $matchInstagram)) {
            $instagram = $matchInstagram[1];
        }
        if (preg_match('/<p>(.*?)<\/p>/', $contenido, $matchDescripcion)) {
            $descripcion = $matchDescripcion[1];
        }

        // Verificar si existe la imagen correspondiente
        $imagen = file_exists("$directorio/$nombrePerfil.jpg") ? "$nombrePerfil.jpg" : "default.jpg";

        // Agregar el perfil al array
        $perfiles[] = [
            'nombre' => $nombre,
            'instagram' => $instagram,
            'descripcion' => $descripcion,
            'imagen' => $imagen,
        ];
    }
}

// HTML inicial
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
        #sidebar {
            position: fixed;
            top: 0;
            left: -250px; /* Oculto inicialmente */
            width: 250px;
            height: 100%;
            background-color: #333;
            padding-top: 60px;
            transition: left 0.3s;
            z-index: 1500;
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
            grid-template-columns: repeat(5, 1fr); /* 5 perfiles por fila */
            gap: 15px;
            padding: 20px;
            margin-left: 0; /* Espacio para el menú */
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
        .modal {
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
        .modal-content {
            max-width: 90%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            text-align: center;
            position: relative;
        }
        .modal .close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 30px;
            color: #333;
            cursor: pointer;
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
    <div id="perfiles">';

// Mostrar perfiles
foreach ($perfiles as $index => $perfil) {
    echo '<div class="perfil" onclick="openModal(' . $index . ')">
            <img src="' . $directorio . '/' . $perfil['imagen'] . '" alt="' . htmlspecialchars($perfil['nombre']) . '">
            <h3>' . htmlspecialchars($perfil['nombre']) . '</h3>
        </div>';
}

echo '</div>

    <!-- Modal -->
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
        // Menú desplegable
        var sidebar = document.getElementById("sidebar");
        var menuToggle = document.getElementById("menu-toggle");
        
        menuToggle.onclick = function() {
            if (sidebar.style.left === "-250px") {
                sidebar.style.left = "0";
            } else {
                sidebar.style.left = "-250px";
            }
        };

        // Modal
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
