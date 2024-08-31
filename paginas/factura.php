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
        <?php include 'menu.html'; ?>
    </div>
    <div class="cont-principal">
    <h1 class="center">Factura</h1>
  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="../php/anadir.php">
    <p>
      <label for="vendedor">Vendedor:</label>
      <input name="vendedor" type="text" id="vendedor" readonly="readonly">
      <label for="fecha">Fecha:</label>
      <input name="fecha" type="date" id="fecha" readonly="readonly">
    </p>
    <p>
      <h3>Datos del Cliente</h3>
      <p>&nbsp;</p>
      <label for="cedula">Cédula cliente:</label>
      <input type="text" name="cedula" id="cedula">
      <label for="nombreCliente">Nombre:</label>
      <input type="text" name="nombreCliente" id="nombreCliente">
      <label for="apellidoCliente">Apellido:</label>
      <input type="text" name="apellidoCliente" id="apellidoCliente">
      <label for="correo">Correo:</label>
      <input type="email" id="correo" name="correo" >
    </p>
      <h3><strong>Productos</strong></h3>
      <p>&nbsp;</p>
      <p>
        <label for="nombreProducto">Nombre Producto:</label>
        <input type="text" name="nombreProducto" id="nombreProducto">
      </p>
      <p>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad">
      </p>
      <p>
        <input type="submit" name="enviarProducto" id="enviarProducto" value="Enviar">
      </p>
      <table width="200" border="1">
        <tbody>
          <tr>
            <td>Código</td>
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Precio</td>
          </tr>
        </tbody>
      </table>
      <p>Total a pagar:</p>
	  <input type="submit" value="Generar factura">
  </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
