<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['idpersona'])) {
    // Consulta para obtener el rol del usuario
    $query = "SELECT nombre_rol FROM persona, rol WHERE rol_idrol = idrol AND idpersona = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $_SESSION['idpersona']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['nombre_rol'] = $row['nombre_rol'];
        } else {
            $_SESSION['nombre_rol'] = 'No disponible';
        }

        $stmt->close();
    } else {
        $_SESSION['nombre_rol'] = 'Error de consulta';
    }

    $conn->close();
} else {
    $_SESSION['nombre_rol'] = 'No autenticado';
}
?>
