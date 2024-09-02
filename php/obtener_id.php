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

if (isset($_SESSION['idpersona'])) {
    echo json_encode(["success" => true, "idpersona" => $_SESSION['idpersona']]);
} else {
    echo json_encode(["success" => false, "message" => "Usuario no autenticado."]);
}
?>
