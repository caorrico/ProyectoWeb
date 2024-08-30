<?php

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

// Include database connection
include 'conexion.php';

// Consulta
$query = "SELECT * FROM rol";
$resultados = $conn->query($query);

// Procesamiento de datos
$data = [];
if ($resultados->num_rows > 0) {
    $data = $resultados->fetch_all(MYSQLI_ASSOC);
} 

echo json_encode($data);

// Cerrar conexión
$conn->close();
?>
