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
if (!isset($data['nombre_producto'], $data['detalle_producto'], $data['precio'], $data['categoria_idcategoria'])) {
    echo json_encode(["error" => "Datos incompletos"]);
    exit();
}

// Obtener los datos
$nombre_producto = $data['nombre_producto'];
$detalle_producto = $data['detalle_producto'];
$precio = $data['precio'];
$categoria_idcategoria = $data['categoria_idcategoria'];

// Preparar la consulta de inserción
$query = "INSERT INTO producto (nombre_producto, detalle_producto, precio, categoria_idcategoria) VALUES (?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($query);
if ($stmt === false) {
    echo json_encode(["error" => "Error en la preparación de la consulta: " . $conn->error]);
    exit();
}

// Vincular los parámetros
$stmt->bind_param('ssdi', $nombre_producto, $detalle_producto, $precio, $categoria_idcategoria);

if ($stmt->execute()) {
    echo json_encode(["success" => "Producto registrado exitosamente"]);
} else {
    echo json_encode(["error" => "Error al insertar: " . $stmt->error]);
}

// Cerrar la declaración
$stmt->close();

// Cerrar la conexión a la base de datos
$conn->close();

?>
