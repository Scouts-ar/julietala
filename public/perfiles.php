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
    .perfil-container {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 20px;
      margin-top: 20px;
    }
    .perfil {
      text-align: center;
      cursor: pointer;
    }
    .perfil img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
    }
    .perfil h3 {
      font-size: 1rem;
      margin-top: 10px;
    }
    /* Estilos del modal */
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
    }
    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      text-align: center;
    }
    .modal-close {
      background: red;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
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
