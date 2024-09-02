<?php

// Mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json'); // Asegúrate de enviar el tipo de contenido como JSON

// Incluir conexión a la base de datos
include 'conexion.php';

// Establecer el conjunto de caracteres a utf8 para evitar problemas de codificación
$conn->set_charset("utf8");

// Consulta
$query = "SELECT * FROM rol";
$resultados = $conn->query($query);

// Verificar si hubo un error en la consulta
if (!$resultados) {
    echo json_encode(['error' => $conn->error]);
    exit();
}

// Procesamiento de datos
$data = [];
if ($resultados->num_rows > 0) {
    $data = $resultados->fetch_all(MYSQLI_ASSOC);
} else {
    $data = ['message' => 'No se encontraron resultados.'];
}

// Codificar datos a JSON y enviar como respuesta
echo json_encode($data);

// Cerrar conexión
$conn->close();

?>
