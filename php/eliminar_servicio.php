<?php

// Mostrar todos los errores (útil para depuración)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers - Permiten que otros dominios accedan a este servicio
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Establecer el tipo de contenido a JSON
header('Content-Type: application/json');

// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Establecer el conjunto de caracteres a UTF-8 para evitar problemas de codificación
$conn->set_charset("utf8");

// Obtener los datos en formato JSON
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si se recibieron los datos correctamente
if (!isset($data['id'])) {
    echo json_encode(["success" => false, "error" => "Datos incompletos"]);
    exit();
}

$id = $conn->real_escape_string($data['id']); // Escapar el valor para evitar inyecciones SQL

$sql = "UPDATE `servicio` SET `activo` = '0' WHERE `idservicio` = '$id'";

// Ejecutar la consulta
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(["success" => false, "error" => "Error al eliminar el servicio: " . $conn->error]);
} else {
    echo json_encode(["success" => true]);
}

$conn->close();
?>
