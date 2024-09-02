<?php

// Mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json'); // Asegúrate de enviar el tipo de contenido como JSON

// Incluir conexión a la base de datos
include 'conexion.php';

// Establecer el conjunto de caracteres a utf8 para evitar problemas de codificación
$conn->set_charset("utf8");

// Obtener el idrol desde la solicitud GET
$idrol = isset($_GET['idrol']) ? intval($_GET['idrol']) : 0;

if ($idrol > 0) {
    // Consulta para obtener permisos que no están asociados con el rol seleccionado
    $query = $conn->prepare("SELECT DISTINCT permiso_acceso 
                             FROM permisos 
                             WHERE permiso_acceso NOT IN (
                                 SELECT permiso_acceso 
                                 FROM permisos 
                                 WHERE rol_idrol = ?
                             )");
    $query->bind_param('i', $idrol); // Usar parámetros para evitar inyecciones SQL
    $query->execute();
    $resultados = $query->get_result();

    // Verificar si hubo un error en la consulta
    if (!$resultados) {
        echo json_encode(['error' => $conn->error]);
        exit();
    }

    // Procesamiento de datos
    $data = [];
    if ($resultados->num_rows > 0) {
        $data = $resultados->fetch_all(MYSQLI_ASSOC);
    } else {
        $data = ['message' => 'No se encontraron resultados.'];
    }

    // Codificar datos a JSON y enviar como respuesta
    echo json_encode($data);
} else {
    echo json_encode(['message' => 'ID de rol no válido.']);
}

// Cerrar conexión
$conn->close();

?>
