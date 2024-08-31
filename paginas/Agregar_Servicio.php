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
    <h1 class="center">Registro Servicios</h1>
  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="../php/anadir.php">
    <p>
			<label for="admin">Adminstrador:</label>
		  <input type="text" name="admin" id="admin" readonly>
		  <label for="fechaHoraActual">Fecha:</label>
		  <input type="datetime" name="fechaHoraActual" id="fechaHoraActual" readonly>
		</p>
	  <p> 
    <p>
      <label for="codigo">Código:</label>
      <input type="text" name="codigo" id="codigo">
    </p>
    <p>
      <label for="nombreserv">Servicio:</label>
      <input type="text" name="nombreserv" id="nombreserv">
    </p>
    <p>
      <label for="descripcion">Descripción:</label>
      <textarea name="descripcion" id="descripcion"></textarea>
    </p>
    <p>
      <label for="precio">Precio:</label>
      <input type="number" name="precio" id="precio" step="0.01">
    </p>
    <p>
      <input type="submit" name="anadirProducto" id="anadirProducto" value="Enviar">
      <input type="reset" name="reset" id="reset" value="Restablecer">
    </p>
  </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
