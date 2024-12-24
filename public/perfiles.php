<?php
// Función para obtener todos los archivos en el directorio 'perfiles/'
function obtenerPerfiles($directorio) {
    $archivos = scandir($directorio);
    $perfiles = [];

    // Recorre todos los archivos y filtra solo los HTML
    foreach ($archivos as $archivo) {
        if ($archivo !== '.' && $archivo !== '..' && pathinfo($archivo, PATHINFO_EXTENSION) === 'html') {
            // Cargar el contenido de cada archivo
            $contenido = file_get_contents($directorio . '/' . $archivo);

            // Extraer la información del perfil (esto puede mejorarse dependiendo del formato del HTML)
            preg_match('/<h3>(.*?)<\/h3>/', $contenido, $nombre);
            preg_match('/Instagram: (.*?)<\/p>/', $contenido, $instagram);
            preg_match('/Descripción corta sobre el usuario.<\/p>(.*?)<\/div>/', $contenido, $descripcion);

            // Nombre del perfil sin la extensión del archivo
            $nombrePerfil = pathinfo($archivo, PATHINFO_FILENAME);
            
            // Agregar los datos del perfil a la lista
            $perfiles[] = [
                'nombre' => $nombre[1],
                'imagen' => $nombrePerfil . '.jpg',  // Usar el nombre del archivo HTML para la imagen
                'instagram' => $instagram[1],
                'descripcion' => trim(strip_tags($descripcion[1])),
                'id' => $nombrePerfil
            ];
        }
    }

    return $perfiles;
}

// Obtener los perfiles desde el directorio 'perfiles/'
$perfiles = obtenerPerfiles('perfiles');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Perfiles</title>
  <style>
    /* Estilos generales */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-top: 20px;
      font-size: 2.5rem;
    }

    .perfil-container {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 20px;
      padding: 20px;
      justify-items: center;
    }

    .perfil {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      cursor: pointer;
      padding: 15px;
      transition: transform 0.3s, box-shadow 0.3s;
      width: 180px;
      overflow: hidden;
    }

    .perfil:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .perfil img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #ddd;
      margin-bottom: 10px;
    }

    .perfil h3 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 8px;
    }

    .perfil p {
      font-size: 0.9rem;
      color: #777;
    }

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .modal-content {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      width: 320px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-close {
      background: #ff4d4d;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
      font-size: 1rem;
      border-radius: 5px;
      margin-top: 10px;
    }

    .modal-close:hover {
      background: #ff3333;
    }

    @media (max-width: 1200px) {
      .perfil-container {
        grid-template-columns: repeat(4, 1fr);
      }
    }

    @media (max-width: 900px) {
      .perfil-container {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 600px) {
      .perfil-container {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 400px) {
      .perfil-container {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <h1>Lista de Perfiles</h1>
  <div class="perfil-container" id="perfil-container">
    <!-- Los perfiles se cargarán aquí automáticamente -->
    <?php foreach ($perfiles as $perfil): ?>
      <div class="perfil" data-id="<?php echo $perfil['id']; ?>" onclick="abrirModal(<?php echo htmlspecialchars(json_encode($perfil)); ?>)">
        <img src="perfiles/<?php echo $perfil['imagen']; ?>" alt="Foto de Perfil">
        <h3><?php echo $perfil['nombre']; ?></h3>
        <p>@<?php echo $perfil['instagram']; ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Modal -->
  <div class="modal" id="modal">
    <div class="modal-content">
      <button class="modal-close" id="modal-close">Cerrar</button>
      <div id="modal-body"></div>
    </div>
  </div>

  <script>
    // Abrir el modal con más información del perfil
    const abrirModal = (perfil) => {
      const modal = document.getElementById('modal');
      const modalBody = document.getElementById('modal-body');
      modalBody.innerHTML = `
        <h2>${perfil.nombre}</h2>
        <p><strong>Descripción:</strong> ${perfil.descripcion}</p>
        <p><strong>Instagram:</strong> <a href="https://www.instagram.com/${perfil.instagram}" target="_blank">${perfil.instagram}</a></p>
      `;
      modal.style.display = 'flex';
    };

    // Cerrar el modal
    document.getElementById('modal-close').addEventListener('click', () => {
      document.getElementById('modal').style.display = 'none';
    });
  </script>
</body>
</html>
