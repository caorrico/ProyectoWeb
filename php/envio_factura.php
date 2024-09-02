<?php

// Para desarrollo, puedes dejar estas líneas; para producción, desactiva la visualización de errores HTML.
error_reporting(E_ALL);
ini_set('display_errors', 0); // Cambiar a 0 para producción

// Configuración de cabeceras
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header('Content-Type: application/json'); // Asegurar que el contenido sea JSON

// Incluir archivo de conexión a la base de datos
include 'conexion.php';

try {
    // Configuración del conjunto de caracteres para evitar problemas de codificación
    $conn->set_charset("utf8");

    // Leer los datos JSON recibidos
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si los datos se recibieron correctamente
    if (!$data) {
        throw new Exception("No se recibieron datos");
    }

    // Verificar si los datos necesarios están presentes
    if (isset($data['cedulaCliente'], $data['nombreCliente'])) {
        $nombreVendedor = $data['nombreVendedor'];
        $fecha = $data['fecha'];
        $cedulaCliente = $data['cedulaCliente'];
        $nombreCliente = $data['nombreCliente'];
        $apellidoCliente = $data['apellidoCliente'] ?? ''; 
        $correo = $data['correo'] ?? ''; 
        $totalSinImpuesto = $data['totalSinImpuesto'];
        $totalConImpuesto = $data['totalConImpuesto'];
        $totalImpuesto = $data['totalImpuesto'];
        $productos = $data['productos'];
        $sucursal_id = 1;
        $codigo_factura = 'COD' . time(); 
        $detalle_venta = '';

        // Crear el detalle de la venta
        foreach ($productos as $producto) {
            $detalle_venta .= $producto['nombreproducto'] . ' ' . $producto['cantidad'] . ' ' . $producto['precioUnitario'] . ' ' . $producto['precio'] . ' | ';
        }
        $detalle_venta = rtrim($detalle_venta, ' | ');

        // Buscar el id del cliente
        $personaId = 0;
        $query = "SELECT idpersona FROM persona WHERE cedula = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param('s', $cedulaCliente);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $persona = $result->fetch_assoc();
                $personaId = $persona['idpersona'];
            } else {
                throw new Exception("No se encontró el cliente");
            }
            $stmt->close();
        } else {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }

        // Preparar la consulta de inserción de venta
        $query = "INSERT INTO venta (fecha, codigo_factura, precio, persona_idpersona, sucursal_idsucursal, detalle_venta) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            // Verificar y formatear la fecha si es necesario
            $fecha = date('Y-m-d', strtotime($fecha)); // Asegurar el formato correcto de la fecha

            // Asegurarse de que los tipos coincidan correctamente con las columnas
            $stmt->bind_param('ssdiis', $fecha, $codigo_factura, $totalConImpuesto, $personaId, $sucursal_id, $detalle_venta);

            if ($stmt->execute()) {
                echo json_encode(["mensaje" => "Venta insertada correctamente"]);
            } else {
                throw new Exception("Error al insertar la venta: " . $stmt->error); // Cambié $conn->error a $stmt->error para obtener el error específico del statement
            }
            $stmt->close();
        } else {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }

    } else {
        // Manejar caso donde faltan datos necesarios
        echo json_encode(["error" => "No se recibieron los datos necesarios"]);
    }
} catch (Exception $e) {
    // Manejar todas las excepciones y asegurar que se devuelvan como JSON
    echo json_encode(["error" => $e->getMessage()]);
    exit();
}

$conn->close();



?>
