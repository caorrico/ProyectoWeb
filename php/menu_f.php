<?php
// Mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Iniciar sesión
session_start();

// Configuración de CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');

// Establecer el conjunto de caracteres a utf8
$conn->set_charset("utf8");

// Verificar si el usuario está autenticado
if (isset($_SESSION['idpersona'])) {
    // Consultar el rol del usuario
    $query = "SELECT rol_idrol, nombre_rol FROM persona, rol WHERE rol_idrol = idrol AND idpersona = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $_SESSION['idpersona']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['idrol'] = $row['rol_idrol'];  // Guardar el idrol en la sesión
            $_SESSION['nombre_rol'] = $row['nombre_rol'];

            // Obtener el idrol desde la sesión
            $idrol = intval($_SESSION['idrol']);

            // Consulta para obtener permisos asociados con el rol
            $query = $conn->prepare("SELECT DISTINCT permiso_acceso FROM permisos WHERE rol_idrol = ?");
            $query->bind_param('i', $idrol);
            $query->execute();
            $resultados = $query->get_result();

            // Procesar permisos
            $permisos = [];
            if ($resultados->num_rows > 0) {
                while ($row = $resultados->fetch_assoc()) {
                    $permisos[] = $row['permiso_acceso'];
                }
            }

            // Definir el menú basado en permisos
            $menu = [];
            $todas_las_opciones = [
                'Proveedor' => 'Agregar_Proveedor.php',
                'Servicios' => 'Mostrar_Servicios.php',
                'Usuarios' => 'Usuario.php',
                'Compras' => 'Mostrar_compras.php',
                'Productos' => 'Mostrar_producto.php',
                'Permisos' => 'Permisos.php',
                'Inventario' => 'inventario.php',
                'Facturacion' => 'factura.php',
                'Mostrar Factura' => 'Mostrar_Factura.php'
            ];

            foreach ($todas_las_opciones as $permiso => $url) {
                if (in_array($permiso, $permisos)) {
                    $menu[] = ['nombre' => $permiso, 'url' => $url];
                }
            }

            // Codificar datos a JSON y enviar como respuesta
            echo json_encode(['menu' => $menu]);

        } else {
            echo json_encode(['message' => 'No se encontró el rol.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['message' => 'Error en la consulta de rol.']);
    }

} else {
    echo json_encode(['message' => 'No estás autenticado.']);
}

// Cerrar conexión
$conn->close();
?>
