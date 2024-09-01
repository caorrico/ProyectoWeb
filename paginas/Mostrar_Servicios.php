<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Servicios</title>
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/general.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .btn {
            border: none;
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-edit {
            background-color: #ffc107; /* Color de fondo para el botón de editar */
            color: #fff;
        }
        .btn-delete {
            background-color: #dc3545; /* Color de fondo para el botón de eliminar */
            color: #fff;
        }
        .btn i {
            margin: 0;
        }
        .btn-square {
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 20px; /* Ajusta el tamaño del icono dentro del botón */
        }
    </style>
</head>
<body>
    <?php include 'usuario.html'; ?>
    <div class="menu-lateral">
        <?php include 'menu.html'; ?>
    </div>
    <div class="cont-principal content">
        <h1>Lista de Servicios</h1>
        <div class="button-agregar">
            <!-- Redirige a Agregar_Usuario.php cuando se hace clic -->
            <button type="button" class="btn btn-primary mb-3" id="btnAgregarServicio" onclick="location.href='Agregar_Servicio.php'">
                Agregar Servicio
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Servicio</th>
                        <th>Descripción</th>
                        <th>Acciones</th> <!-- Nueva columna para las acciones -->
                    </tr>
                </thead>
                <tbody id="servicios-table-body">
                    <!-- Aquí se insertarán las filas de la tabla con los datos -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="../js/servicio.js"></script>
</body>
</html>
