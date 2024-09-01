<?php
// Mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión
session_start();

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json'); // Asegurar que la respuesta sea JSON

// Incluir conexión a la base de datos
include 'conexion.php';

// Establecer el conjunto de caracteres a utf8 para evitar problemas de codificación
$conn->set_charset("utf8");

// Obtener y sanitizar entrada
$usuario = isset($_POST['username']) ? $_POST['username'] : null;
$contrasena = isset($_POST['password']) ? $_POST['password'] : null;

// Validar entrada
if (empty($usuario) || empty($contrasena)) {
    echo json_encode(["success" => false, "message" => "Usuario o contraseña no proporcionados."]);
    exit();
}

// Consulta segura usando prepared statements
$query = "SELECT * FROM persona WHERE cedula = ? AND contrasena = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conn->error]);
    exit();
}

// Vincular parámetros y ejecutar la consulta
$stmt->bind_param("ss", $usuario, $contrasena);
$stmt->execute();
$resultados = $stmt->get_result();

// Procesamiento de datos
if ($resultados->num_rows == 1) {
    // Credenciales correctas
    $data = $resultados->fetch_assoc();
    
    // Guardar el nombre del usuario en la sesión
    $_SESSION['nombre_usuario'] = $data['nombre'];
    
    echo json_encode(["success" => true, "data" => $data]);
} else {
    // Credenciales incorrectas
    echo json_encode(["success" => false, "message" => "Credenciales incorrectas."]);
}

// Cerrar statement y conexión
$stmt->close();
$conn->close();
?>
