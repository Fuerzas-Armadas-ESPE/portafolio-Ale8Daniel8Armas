<?php
// Ruta al archivo de registro
$rutaArchivo = __DIR__ . '/registro.txt';

// Verificar si el archivo existe
if (file_exists($rutaArchivo)) {
    // Vaciar el contenido del archivo
    file_put_contents($rutaArchivo, '');

    echo "Todos los registros han sido eliminados correctamente.";
} else {
    echo "El archivo de registro no existe.";
}
?>