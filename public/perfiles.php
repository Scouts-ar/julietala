<?php
// Escanea la carpeta perfiles
$dir = 'perfiles';
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
        #menu-toggle {
            font-size: 30px;
            cursor: pointer;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 2000;
            color: white;
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
        #sidebar ul {
            list-style: none;
            padding: 0;
        }
        #sidebar li {
            padding: 15px;
            text-align: center;
        }
        #sidebar li a {
            color: white;
            text-decoration: none;
        }
        #header {
            text-align: center;
            padding: 20px 10px;
            background: rgba(0, 0, 0, 0.3);
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        #header h1 {
            font-size: 2rem;
            margin: 0;
            color: #FFD700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .content {
            padding: 100px 20px 20px;
            text-align: center;
        }
        #profile-list {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        #profile-list li {
            list-style: none;
            margin: 10px 0;
        }
        #profile-list a {
            color: #FFD700;
            font-size: 1.2rem;
            text-decoration: none;
            cursor: pointer;
        }
        /* Estilo modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 3000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            color: black;
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
    <div id="menu-toggle">&#9776;</div>
    <div id="sidebar">
        <ul>
            <li><a href="index.html"><img src="logos/inicio.png" alt="Inicio"></a></li>
            <li><a href="perfiles.html"><img src="logos/perfiles.png" alt="Perfiles"></a></li>
            <li><a href="historia.html"><img src="logos/historia.png" alt="Historia"></a></li>
            <li><a href="galeria.php"><img src="logos/fotos.png" alt="Fotos"></a></li>
        </ul>
    </div>

    <div id="header">
        <h1>MIEMBROS DE LA COMUNIDAD PREMPEH</h1>
    </div>

    <div class="content">
        <p>Bienvenido a la comunidad. Haz clic en un perfil para verlo.</p>
        <ul id="profile-list">';

// Listar los archivos HTML
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == 'html') {
        $name = pathinfo($file, PATHINFO_FILENAME);
        echo "<li><a href='#' onclick='openModal(\"$dir/$file\")'>$name</a></li>";
    }
}

echo '</ul>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <iframe id="modal-iframe" width="100%" height="500px"></iframe>
        </div>
    </div>

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
        }
    </script>
</body>
</html>';
?>
