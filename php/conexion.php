<?php

session_start();

$conn = mysqli_connect(
    'localhost',
    'admin',
    'admin',
    'sistema'
);
if($conn==true){
    echo('Conexion exitosa');
}
?>