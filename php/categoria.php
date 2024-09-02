<?php

// Mostrar todos los errores (útil para depuración)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers - Permiten que otros dominios accedan a este servicio
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Establecer el tipo de contenido a JSON
header('Content-Type: application/json');

// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Establecer el conjunto de caracteres a UTF-8 para evitar problemas de codificación
$conn->set_charset("utf8");

// Consulta para obtener los datos de la tabla 'servicio'
$query = "SELECT * FROM categoria";
$resultados = $conn->query($query);

// Verificar si hubo un error en la consulta
if (!$resultados) {
    // Enviar respuesta de error en formato JSON
    echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
    exit();
}

// Inicializar un arreglo para almacenar los resultados
$data = [];
if ($resultados->num_rows > 0) {
    // Obtener los datos en formato asociativo
    $data = $resultados->fetch_all(MYSQLI_ASSOC);
}

// Codificar los datos en formato JSON y enviarlos como respuesta
echo json_encode($data);

// Cerrar la conexión a la base de datos
$conn->close();

?>
