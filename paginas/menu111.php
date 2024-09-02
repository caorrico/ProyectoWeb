<?php
include '../php/tipouser.php'; // Asegúrate de que la ruta sea correcta
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="sidebar">
            <nav>
                <ul class="navbar-nav">
                    <!-- Mostrar el rol del usuario -->
                    <li class="nav-item">
                        <span class="nav-link">Rol: <?php echo isset($_SESSION['nombre_rol']) ? $_SESSION['nombre_rol'] : 'No disponible'; ?></span>
                    </li>
                    <?php if (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] === 'Superadmin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="inicio.php">Inicio</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['nombre_rol']) && ($_SESSION['nombre_rol'] === 'Superadmin' || $_SESSION['nombre_rol'] === 'Proveedor' )): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Agregar_Proveedor.php">Proveedor</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] === 'Superadmin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Mostrar_Servicios.php">Servicios</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] === 'Superadmin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Usuario.php">Usuario</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] === 'Superadmin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Mostrar_compras.php">Compras</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] === 'Superadmin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Mostrar_producto.php">Productos</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] === 'Superadmin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Permisos.php">Permisos</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] === 'Superadmin' || $_SESSION['nombre_rol'] === 'Bodeguero'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="..">Inventario</a>
                        </li>
                    <?php endif; ?>



                    

                </ul>
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9pi5L5e+QX8w6I0T9lXfJ8g9CBqS4KTi1RtG8F5x2yoXKZBGB7c" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-cttMFG68o+FYt5G8s+oFHCC2DEr/04S6wT0y8ERzKz0ePz6xKmlNhA67Mk4y5P9" crossorigin="anonymous"></script>
</body>
</html>
