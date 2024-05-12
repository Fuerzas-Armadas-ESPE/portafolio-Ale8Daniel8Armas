<?php
// Ruta al archivo de registro
$rutaArchivo = __DIR__ . '/registro.txt';

// Verificar si el archivo existe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $numero = $_POST['numero'];
    $telas = $_POST['telas'];
    $colores = $_POST['colores'];
    $productos = $_POST['productos'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $venta = $_POST['venta'];
    $codigo = $_POST['codigo'];
    $fecha = $_POST['datetime'];
    $pago = $_POST['pago'];

    // Crear una cadena con los datos
    $nuevaEntrada = "$nombre, $cedula, $correo, $direccion, $numero, $telas, $colores, $productos, $cantidad, $precio, $venta, $codigo, $fecha, $pago\n";

    // Ruta al archivo de registro
    file_put_contents($rutaArchivo, $nuevaEntrada, FILE_APPEND | LOCK_EX);

    // Mostrar mensaje de éxito
    echo "Datos registrados correctamente.";
}

// Leer el contenido del archivo
$contenido = file_get_contents($rutaArchivo);

// Dividir el contenido en líneas
$lineas = explode("\n", trim($contenido));

// Inicializar el total fuera del bucle de lectura
$totalPrecio = 0;

// Mostrar los datos en una tabla
echo "<h2>Registro de Ventas</h2>";
echo "<table border='1'>";
echo "<tr><th>Nombre</th><th>Cedula</th><th>Correo</th><th>Dirección</th><th>Número de Contacto</th><th>Tipo de Tela</th><th>Color</th><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Número de Venta</th><th>Código</th><th>Fecha</th><th>Tipo de Pago</th></tr>";

foreach ($lineas as $linea) {
    // Dividir cada línea en columnas (suponiendo que los datos están separados por comas)
    $columnas = explode(",", $linea);

    // Mostrar cada columna en una celda de la tabla
    echo "<tr>";
    foreach ($columnas as $columna) {
        echo "<td>$columna</td>";
    }
    echo "</tr>";

    // Incrementar el total con el precio actual
    if (!empty($columnas[9])) {
        // Asegurarse de que la columna del precio no esté vacía
        $totalPrecio += (float) $columnas[9];
    }
}

// Mostrar la fila del total fuera del bucle
echo "<tr><td colspan='9'></td><td>Total</td><td>$totalPrecio</td><td colspan='2'></td></tr>";
echo "</table>";

// Agregar línea de texto al final del archivo con el total
$lineaTotal = "Total de precios: $totalPrecio\n";
file_put_contents($rutaArchivo, $lineaTotal, FILE_APPEND | LOCK_EX);
?>
