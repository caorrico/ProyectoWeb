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

$usuario = $_POST['username'];
$contrasena = $_POST['password'];

// Consulta (Asegúrate de usar consultas preparadas para evitar inyecciones SQL)
$query = "SELECT * FROM persona WHERE cedula = $usuario AND contrasena = $contrasena";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $usuario, $contrasena);
$stmt->execute();
$resultados = $stmt->get_result();

// Verificar si hubo un error en la consulta
if (!$resultados) {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    exit();
}

// Procesamiento de datos
$data = [];
if ($resultados->num_rows > 0) {
    // Credenciales correctas
    $data = $resultados->fetch_all(MYSQLI_ASSOC);
    echo json_encode(["success" => true, "data" => $data]);
} else {
    // Credenciales incorrectas
    echo json_encode(["success" => false, "message" => "No se encontraron resultados."]);
}

// Cerrar conexión
$stmt->close();
$conn->close();

?>
