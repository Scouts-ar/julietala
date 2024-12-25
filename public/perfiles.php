<?php
echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfiles</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilo base de la página */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #d32f2f, #b71c1c); /* Fondo rojo degradado */
            height: 100vh;
            color: white;
        }

        /* Barra lateral (menú) */
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

// Mostrar perfiles (puedes cargar los perfiles desde tu base de datos o una variable PHP)
foreach ($perfiles as $index => $perfil) {
    echo '<div class="perfil" onclick="openModal(' . $index . ')">
            <img src="' . htmlspecialchars($directorio) . '/' . htmlspecialchars($perfil['imagen']) . '" alt="' . htmlspecialchars($perfil['nombre']) . '">
            <h3>' . htmlspecialchars($perfil['nombre']) . '</h3>
        </div>';
}

</html>';
?>
