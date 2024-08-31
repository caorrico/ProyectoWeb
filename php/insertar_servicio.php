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

if ($data['action'] === 'cargar') {
    $query = "SELECT * FROM producto";
    $result = $conn->query($query);
    if ($result) {
        if ($result->num_rows > 0) {
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            echo json_encode($productos);
        } else {
            echo json_encode(["error" => "No se encontraron productos"]);
        }
    } else {
        echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
    }
    exit();
}

if (isset($data['nombre'], $data['descripcion'], $data['precio'])) {
    // Obtener los datos
    $nombre = $data['nombre'];
    $descripcion = $data['descripcion'];
    $precio = $data['precio'];
    $activo = 1; 
    $productos = $data['productos'];
    // Extraer los IDs de los productos
    $productosIds = [];
    foreach ($productos as $producto) {
        $productosIds[] = $producto['idproducto'];
    }

    // Preparar la consulta de inserción
    $query = "INSERT INTO servicio (nombre_servicio, descripcion_servicio, activo) VALUES (?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($query);
    if ($stmt !== false) {
        $stmt->bind_param('ssi', $nombre, $descripcion, $activo);

        if ($stmt->execute()) {
            $servicioId = $stmt->insert_id;
            $stmt->close();

            // Preparar la consulta de inserción de los productos
            $query = "INSERT INTO servicio_producto (servicio_idservicio, producto_idproducto) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            if ($stmt !== false) {
                foreach ($productosIds as $productoId) {
                    $stmt->bind_param('ii', $servicioId, $productoId);
                    $stmt->execute();
                }
                
                echo json_encode(["message" => "Servicio insertado correctamente"]);
            } else {
                echo json_encode(["error" => "Error al insertar los productos: " . $conn->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(["error" => "Error al insertar: " . $stmt->error]);
        }
        $stmt->close();

    }else{
        echo json_encode(["error" => "Error en la preparación de la consulta: " . $conn->error]);
        exit();
    }

    
} else {
    echo json_encode(["error" => "Datos incompletos"]);
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();

?>