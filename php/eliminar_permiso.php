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

// Verificar si los parámetros 'rol_idrol' y 'permiso_acceso' fueron pasados
if (isset($data['rol_idrol']) && isset($data['permiso_acceso'])) {
    $rol_idrol = $data['rol_idrol'];
    $permiso_acceso = $data['permiso_acceso'];

    // Preparar la consulta de eliminación
    $query = "DELETE FROM permisos WHERE rol_idrol = ? AND permiso_acceso = ?";

    // Preparar la declaración
    $stmt = $conn->prepare($query);
    if ($stmt !== false) {
        $stmt->bind_param('is', $rol_idrol, $permiso_acceso);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => true, "message" => "Permiso eliminado exitosamente"]);
            } else {
                echo json_encode(["success" => false, "message" => "No se encontró el permiso para eliminar"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Error al eliminar el permiso: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error en la preparación de la consulta: " . $conn->error]);
    }

} else {
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
