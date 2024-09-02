<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/general.css" rel="stylesheet">
    <title>Agregar Cliente</title>
</head>
<body>
<?php include 'usuario.html'; ?>
    <div class="menu-lateral">
        <?php include 'menu.php'; ?>
    </div>
    <div class="cont-principal content">
    <h1 class="center">Detalle de Entrega Pedido</h1>
  <p>&nbsp;</p>  
  <form method="#" onsubmit="guardar();return false">
      <p>
        <label for="fechaHoraActual">Fecha:</label>
        <input type="datetime" name="fechaHoraActual" id="fechaHoraActual" readonly>
      </p>
      <p>
  <label for="proveedor">Proveedor:</label>
        <input type="text" name="proveedor" id="proveedor" list="listProveedor">
      </p>
      <datalist id="listProveedor">  

      </datalist>
      <p>
          <label for="repartidor">Repartidor:</label>
        <input type="text" name="repartidor" id="repartidor">
        
        <label for="cedula">Cédula:</label>
        <input type="text" name="cedula" id="cedula">
      </p>
      <p>
        
        <label for="producto">Producto:</label>
        <input type="text" name="producto" id="producto" list="listProducto">
      </p>
      <datalist id="listProducto">
      </datalist>
      <p>
         <label for="producto">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad">
      </p>
      <p>
          <label for="observacion">Observaciones:</label>
        <input type="text" name="observacion" id="observacion">
      </p>
      <p>
        <input type="button" name="button" id="ingresar" value="Ingresar Producto">
      </p>
      <table width="200" border="1" id="tablaProductos">
        <tbody>
          <tr>
            <td>Código</td>
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Observación</td>
            <td>Acciones</td>
          </tr>
        </tbody>
      </table>
      <p>&nbsp;</p>
      <p>
        <input type="submit" name="anadirCompras" id="anadirCompras" value="Enviar">
        <input type="reset" name="reset" id="reset" value="Restablecer">
      </p>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
