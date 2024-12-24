<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen'])) {
    $directorio = 'fotos/';
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenNombre = $_FILES['imagen']['name'];

    // Verificar si la imagen es válida (solo imágenes permitidas)
    $ext = strtolower(pathinfo($imagenNombre, PATHINFO_EXTENSION));
    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    if (in_array($ext, $extensionesPermitidas)) {
        // Subir la imagen
        if (move_uploaded_file($imagenTmp, $directorio . $imagenNombre)) {
            echo "Imagen subida con éxito.";
            header("Location: galeria.php"); // Redirigir a la galería
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Solo se permiten imágenes en formatos JPG, JPEG, PNG, GIF o WEBP.";
    }
}
?>
