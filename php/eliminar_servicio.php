<?php
header('Content-Type: application/json');

// Conectar a la base de datos
include 'conexion.php';

// Verificar si los parámetros 'rol_idrol' y 'permiso_acceso' fueron pasados
if (isset($_POST['rol_idrol']) && isset($_POST['permiso_acceso'])) {
    $rol_idrol = $_POST['rol_idrol'];
    $permiso_acceso = $_POST['permiso_acceso'];

    // Imprimir los datos recibidos para depuración
    error_log("Datos recibidos: ");
    error_log("rol_idrol: " . $rol_idrol);
    error_log("permiso_acceso: " . $permiso_acceso);

    // Preparar y ejecutar la consulta SQL
    $sql = "DELETE FROM permisos WHERE rol_idrol = :rol_idrol AND permiso_acceso = :permiso_acceso";
    try {
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Error al preparar la consulta.');
        }

        $stmt->bindParam(':rol_idrol', $rol_idrol, PDO::PARAM_INT);
        $stmt->bindParam(':permiso_acceso', $permiso_acceso, PDO::PARAM_STR);

        // Imprimir el estado de la consulta para depuración
        error_log("Estado de la consulta: ");
        error_log("SQL: " . $sql);
        
        if ($stmt->execute()) {
            $response = array('success' => 'Permiso eliminado exitosamente.');
        } else {
            $response = array('error' => 'Error al eliminar el permiso.');
        }
    } catch (Exception $e) {
        $response = array('error' => 'Error en la base de datos: ' . $e->getMessage());
    }

    // Enviar respuesta en formato JSON
    echo json_encode($response);

    // Imprimir la respuesta para depuración
    error_log("Respuesta enviada: " . json_encode($response));
} else {
    $response = array('error' => 'Faltan parámetros.');
    echo json_encode($response);
    
    // Imprimir la respuesta para depuración
    error_log("Respuesta enviada: " . json_encode($response));
}
?>
