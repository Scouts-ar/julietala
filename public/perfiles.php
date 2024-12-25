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
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            flex-direction: column;
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

        #imagen-bienvenida {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #imagen-bienvenida img {
            max-width: 600px;
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        #bienvenida-titulo {
            font-size: 3rem;
            margin-bottom: 30px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
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

    <div id="imagen-bienvenida">
        <h1 id="bienvenida-titulo">MIEMBROS DE LA COMUNIDAD <span style="color: #FFD700;">PREMPEH</span></h1>
    </div>

    <script src="script.js"></script>
</body>
</html>';
?>
