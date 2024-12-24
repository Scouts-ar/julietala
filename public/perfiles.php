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
        #perfiles {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 perfiles por fila */
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
        }
        #perfiles img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            cursor: pointer;
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
