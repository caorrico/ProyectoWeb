<?php

// Mostrar todos los errores (útil para depuración)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers - Permiten que otros dominios accedan a este servicio
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");

// Establecer el tipo de contenido a JSON
header('Content-Type: application/json');

// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Obtener los datos enviados por la solicitud POST
$data = json_decode(file_get_contents("php://input"), true);
$idpersona = $data['idpersona'] ?? null;
$nombre = $data['nombre'] ?? '';
$apellido = $data['apellido'] ?? '';
$cedula = $data['cedula'] ?? '';
$telefono = $data['telefono'] ?? '';
$correo = $data['correo'] ?? '';
$nombre_rol = $data['nombre_rol'] ?? '';

if ($idpersona === null) {
    echo json_encode(["error" => "ID de usuario no proporcionado"]);
    exit();
}

// Consulta para actualizar los datos del usuario
$query = "UPDATE persona SET nombre = ?, apellido = ?, cedula = ?, telefono = ?, correo = ?, nombre_rol = ? WHERE idpersona = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    echo json_encode(["error" => "Error en la preparación de la consulta: " . $conn->error]);
    exit();
}

$stmt->bind_param("ssssssi", $nombre, $apellido, $cedula, $telefono, $correo, $nombre_rol, $idpersona);

if ($stmt->execute()) {
    echo json_encode(["success" => "Usuario actualizado con éxito"]);
} else {
    echo json_encode(["error" => "Error al actualizar el usuario: " . $stmt->error]);
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();

?>
