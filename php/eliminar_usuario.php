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

// Verificar si se recibió el ID del usuario
if (!isset($data['idpersona'])) {
    echo json_encode(["success" => false, "error" => "ID de usuario no proporcionado"]);
    exit();
}

$idpersona = $conn->real_escape_string($data['idpersona']); // Escapar el valor para evitar inyecciones SQL

// Obtener el estado actual del usuario
$sql = "SELECT activo FROM persona WHERE idpersona = '$idpersona'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo json_encode(["success" => false, "error" => "Usuario no encontrado"]);
    exit();
}

// Cambiar el estado activo
$row = mysqli_fetch_assoc($result);
$activo = $row['activo'] == 1 ? 0 : 1;

$sql = "UPDATE persona SET activo = $activo WHERE idpersona = '$idpersona'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(["success" => false, "error" => "Error al cambiar el estado del usuario: " . $conn->error]);
} else {
    echo json_encode(["success" => true, "nuevo_estado" => $activo]);
}

$conn->close();
?>
