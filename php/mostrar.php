<?php

// Mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

// Incluir conexión a la base de datos
include 'conexion.php';

// Establecer el conjunto de caracteres a utf8 para evitar problemas de codificación
$conn->set_charset("utf8");

// Consulta
$query = "SELECT * FROM persona";
$resultados = $conn->query($query);

// Verificar si hubo un error en la consulta
if (!$resultados) {
    echo "Error: " . $conn->error;
    exit();
}

// Depuración: mostrar número de filas obtenidas
echo "Número de filas: " . $resultados->num_rows . "<br>";

// Procesamiento de datos
$data = [];
if ($resultados->num_rows > 0) {
    // Depuración: mostrar los datos obtenidos antes de procesarlos
    $data = $resultados->fetch_all(MYSQLI_ASSOC);
    echo "Datos obtenidos: <br>";
    print_r($data);
} else {
    echo "No se encontraron resultados.";
}

// Codificar datos a JSON y enviar como respuesta
echo json_encode($data);

// Cerrar conexión
$conn->close();

?>
