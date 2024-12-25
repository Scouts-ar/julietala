<?php
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

        #sidebar li a img {
            width: 30px;
            height: 30px;
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
            padding: 80px 20px 20px; /* Espacio para el encabezado */
            text-align: center;
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

    <!-- Título en la parte superior -->
    <div id="header">
        <h1>MIEMBROS DE LA COMUNIDAD PREMPEH</h1>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <p>Bienvenido a la comunidad. Aquí puedes explorar información y fotos de nuestros miembros.</p>
        <img src="logos/bienvenida.png" alt="Bienvenida a la comunidad" width="300px">
    </div>

    <!-- Script para la barra lateral -->
    <script src="script.js"></script>
</body>
</html>';
?>
