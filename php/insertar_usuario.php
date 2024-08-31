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
if (!isset($data['nombre'], $data['apellido'], $data['cedula'], $data['telefono'], $data['correo'], $data['contrasena'], $data['rol_idrol'])) {
    echo json_encode(["error" => "Datos incompletos"]);
    exit();
}

// Obtener los datos
$nombre = $data['nombre'];
$apellido = $data['apellido'];
$cedula = $data['cedula'];
$telefono = $data['telefono'];
$correo = $data['correo'];
$contrasena = $data['contrasena'];
$rol_idrol = $data['rol_idrol'];
$activo = 1; // Por defecto, el usuario está activo

// Preparar la consulta de inserción
$query = "INSERT INTO persona (nombre, apellido, cedula, telefono, correo, contrasena, activo, rol_idrol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($query);
if ($stmt === false) {
    echo json_encode(["error" => "Error en la preparación de la consulta: " . $conn->error]);
    exit();
}

// Vincular los parámetros
$stmt->bind_param('ssssssii', $nombre, $apellido, $cedula, $telefono, $correo, $contrasena, $activo, $rol_idrol);

if ($stmt->execute()) {
    echo json_encode(["success" => "Usuario registrado exitosamente"]);
} else {
    echo json_encode(["error" => "Error al insertar: " . $stmt->error]);
}

// Cerrar la declaración
$stmt->close();

// Cerrar la conexión a la base de datos
$conn->close();

?>
