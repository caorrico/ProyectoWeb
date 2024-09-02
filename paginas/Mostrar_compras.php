<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/general.css" rel="stylesheet">
    <title>Lista de Compras</title>
</head>
<body>
    
    <?php include 'usuario.html'; ?>
    <div class="menu-lateral">
        <?php include 'menu.php'; ?>
    </div>
    <div class="cont-principal content">
        <h1>Lista de Compras</h1>
        <div class="button-agregar">
            <button type="button" class="btn btn-primary mb-3" id="btnAgregarUsuario" onclick="location.href='Agregar_Compras.php'">
                Agregar Compra
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Bodeguero</th>
                        <th>Proveedor</th>
                        <th>Producto</th> 
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Activo</th>
                    </tr>
                </thead>
                <tbody id="servicio-lista">
                    <!-- Aquí se insertarán los usuarios -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/compras.js"></script>
</body>
</html>
