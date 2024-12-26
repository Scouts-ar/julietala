<?php
// Escanea la carpeta perfiles
$dir = 'perfiles';
$imgDir = 'perfiles/img';
$files = array_diff(scandir($dir), array('..', '.'));

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Fondo Degradado</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: radial-gradient(circle, #b71c1c, #d32f2f, #8b0000);
            height: 100vh;
            color: white;
        }
        h1 {
            text-align: center;
            font-size: 2rem;
            margin: 40px 0 20px;
            color: #FFD700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .profile-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .profile-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            width: 200px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.7);
        }
        .profile-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }
        .profile-card h2 {
            margin: 15px 0;
            font-size: 1.2rem;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 3000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8); /* Fondo oscuro con opacidad */
        }

        .modal-content {
            background-color: #333333; /* Gris oscuro */
            margin: 10% auto;
            padding: 20px;
            border-radius: 15px; /* Bordes redondeados */
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            color: white; /* Texto en blanco */
            position: relative;
        }
         
        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Icono de menú -->
    <div id="menu-toggle">&#9776;</div>

    <!-- Barra lateral -->
    <div id="sidebar">
        <ul>
            <li><a href="index.html"><img src="logos/inicio.png" alt="Inicio"></a></li>
            <li><a href="perfiles.html"><img src="logos/perfiles.png" alt="Perfiles"></a></li>
            <li><a href="historia.html"><img src="logos/historia.png" alt="Historia"></a></li>
            <li><a href="galeria.php"><img src="logos/fotos.png" alt="Fotos"></a></li>
        </ul>
    </div>

    <div class="content">
        <h1>MIEMBROS DE LA COMUNIDAD PREMPEH</h1>
        <p>Explora los perfiles de nuestros miembros.</p>
        <div class="profile-grid">';

// Listar los archivos HTML
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == 'html') {
        $name = pathinfo($file, PATHINFO_FILENAME);
        $imgPath = "$imgDir/$name.jpg";
        if (!file_exists($imgPath)) {
            $imgPath = "logos/default.png";
        }
        echo "
        <div class='profile-card' onclick='openModal(\"$dir/$file\")'>
            <img src='$imgPath' alt='$name'>
            <h2>$name</h2>
        </div>";
    }
}

echo '</div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <iframe id="modal-iframe" width="100%" height="500px"></iframe>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        function openModal(url) {
            var modal = document.getElementById("myModal");
            var iframe = document.getElementById("modal-iframe");
            iframe.src = url;
            modal.style.display = "block";
        }
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
            var iframe = document.getElementById("modal-iframe");
            iframe.src = "";
        }
    </script>
</body>
</html>';
?>
