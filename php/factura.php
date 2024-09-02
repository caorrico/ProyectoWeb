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
if (!$data) {
    echo json_encode(["error" => "No se recibieron datos"]);
    exit();
}


if ($data['action'] === 'cargarProducto') {
    $query = "SELECT * FROM producto  WHERE activo = 1";
    $result = $conn->query($query);
    if ($result) {
        if ($result->num_rows > 0) {
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            echo json_encode($productos);
        } else {
            echo json_encode(["error" => "No se encontraron productos"]);
        }
    } else {
        echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
    }
    exit();
}
if ($data['action'] === 'cargarServicio') {
    $query = "SELECT * FROM servicio WHERE activo = 1" ;
    $result = $conn->query($query);
    if ($result) {
        if ($result->num_rows > 0) {
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            echo json_encode($productos);
        } else {
            echo json_encode(["error" => "No se encontraron productos"]);
        }
    } else {
        echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
    }
    exit();
}



// Cerrar la conexión a la base de datos
$conn->close();


?>