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

            // Inicializar las variables para los datos del perfil
            $nombre = $instagram = $descripcion = '';

            // Extraer el nombre, Instagram y descripción usando expresiones regulares
            if (preg_match('/<h3>(.*?)<\/h3>/', $contenido, $matchesNombre)) {
                $nombre = $matchesNombre[1];
            }

            if (preg_match('/Instagram: (.*?)<\/p>/', $contenido, $matchesInstagram)) {
                $instagram = $matchesInstagram[1];
            }

            if (preg_match('/Descripción corta sobre el usuario.<\/p>(.*?)<\/div>/', $contenido, $matchesDescripcion)) {
                $descripcion = strip_tags($matchesDescripcion[1]);  // Limpiar la descripción para evitar HTML adicional
            }

            // Nombre del perfil sin la extensión del archivo
            $nombrePerfil = pathinfo($archivo, PATHINFO_FILENAME);
            
            // Si no se encontró nombre o Instagram, se pueden poner valores predeterminados
            $nombre = $nombre ?: "Nombre no disponible";
            $instagram = $instagram ?: "No disponible";
            $descripcion = $descripcion ?: "Descripción no disponible";
            
            // Agregar los datos del perfil a la lista
            $perfiles[] = [
                'nombre' => $nombre,
                'imagen' => $nombrePerfil . '.jpg',  // Usar el nombre del archivo HTML para la imagen
                'instagram' => $instagram,
                'descripcion' => $descripcion,
                'id' => $nombrePerfil
            ];
        }
    }

    return $perfiles;
}

// Obtener los perfiles desde el directorio 'perfiles/'
$perfiles = obtenerPerfiles('perfiles');
?>
