<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header('Content-Type: application/json');

include 'conexion.php';
$conn->set_charset("utf8");

$data = json_decode(file_get_contents('php://input'), true);

$id = isset($data['idpersona']) ? $conn->real_escape_string($data['idpersona']) : '';
$nombres = isset($data['nombres']) ? $conn->real_escape_string($data['nombres']) : '';
$apellidos = isset($data['apellidos']) ? $conn->real_escape_string($data['apellidos']) : '';
$cedula = isset($data['cedula']) ? $conn->real_escape_string($data['cedula']) : '';
$telefono = isset($data['telefono']) ? $conn->real_escape_string($data['telefono']) : '';
$contrasena = isset($data['contrasena']) ? $conn->real_escape_string($data['contrasena']) : '';
$correo = isset($data['correo']) ? $conn->real_escape_string($data['correo']) : '';
$rol = isset($data['rol']) ? $conn->real_escape_string($data['rol']) : '';

if (!$id) {
    echo json_encode(["success" => false, "error" => "ID de usuario no proporcionado"]);
    exit();
}

$set = "nombre='$nombres', apellido='$apellidos', cedula='$cedula', telefono='$telefono', correo='$correo'";
if ($contrasena) {
    $set .= ", contrasena='$contrasena'";
}
if ($rol) {
    $set .= ", rol_idrol='$rol'";
}

$sql = "UPDATE persona SET $set WHERE idpersona='$id'";
$result = $conn->query($sql);

if ($result) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Error al actualizar el usuario: " . $conn->error]);
}

$conn->close();
?>
