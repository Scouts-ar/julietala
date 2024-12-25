<?php
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
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: rgba(139, 0, 0, 0.8);
            padding-top: 60px;
            transition: left 0.3s;
            z-index: 1500;
        }
        #sidebar.open {
            left: 0;
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
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(50, 50, 50, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            display: flex;
            background-color: #fff;
            border-radius: 10px;
            width: 80%;
            max-height: 80%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .modal-left {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .modal-left img {
            width: 200px;
            height: 200px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .social-buttons a {
            margin: 10px;
            font-size: 30px;
            color: #333;
            text-decoration: none;
        }
        .modal-right {
            flex: 2;
            padding: 30px;
        }
        .modal-right h2 {
            margin: 0 0 20px;
        }
        .modal-right p {
            line-height: 1.6;
        }
        .close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 30px;
            color: #fff;
            cursor: pointer;
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

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-left">
                <img id="modalImagen" src="" alt="Imagen del perfil">
                <div class="social-buttons">
                    <a href="#" id="modalInstagram" target="_blank">📸</a>
                    <a href="#" id="modalTwitter" target="_blank">🐦</a>
                    <a href="#" id="modalFacebook" target="_blank">📘</a>
                    <a href="#" id="modalLinkedin" target="_blank">🔗</a>
                    <a href="#" id="modalYoutube" target="_blank">▶️</a>
                </div>
            </div>
            <div class="modal-right">
                <h2 id="modalNombre"></h2>
                <p id="modalDescripcion"></p>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        var modalNombre = document.getElementById("modalNombre");
        var modalImagen = document.getElementById("modalImagen");
        var modalDescripcion = document.getElementById("modalDescripcion");

        var modalInstagram = document.getElementById("modalInstagram");
        var modalTwitter = document.getElementById("modalTwitter");
        var modalFacebook = document.getElementById("modalFacebook");
        var modalLinkedin = document.getElementById("modalLinkedin");
        var modalYoutube = document.getElementById("modalYoutube");

        var perfiles = ' . json_encode($perfiles) . ';

        function openModal(index) {
            var perfil = perfiles[index];
            modal.style.display = "flex";
            modalNombre.textContent = perfil.nombre;
            modalImagen.src = "' . $directorio . '/" + perfil.imagen;
            modalDescripcion.textContent = perfil.descripcion || "Sin descripción";

            // Actualizar enlaces de redes sociales
            modalInstagram.href = perfil.instagram ? "https://instagram.com/" + perfil.instagram : "#";
            modalTwitter.href = perfil.twitter ? "https://twitter.com/" + perfil.twitter : "#";
            modalFacebook.href = perfil.facebook ? "https://facebook.com/" + perfil.facebook : "#";
            modalLinkedin.href = perfil.linkedin ? "https://linkedin.com/in/" + perfil.linkedin : "#";
            modalYoutube.href = perfil.youtube ? "https://youtube.com/" + perfil.youtube : "#";
        }

        function closeModal() {
            modal.style.display = "none";
        }
    </script>
</body>
</html>';
?>
