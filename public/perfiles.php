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

        .content {
            padding: 20px;
            margin-left: 260px;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
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

    <div class="content">
        <h1>Bienvenidos a la Página</h1>
        <p>Este es un ejemplo de página con un fondo degradado que va de un rojo oscuro en los bordes a un rojo más claro en el centro. Puedes personalizar el contenido a tu gusto.</p>
    </div>

    <!-- Reutilizando el mismo script -->
    <script src="script.js"></script>
</body>
</html>';
?>
