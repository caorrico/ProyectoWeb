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
    <div class="cont-principal content">
    <h1 class="center">Registro Productos</h1>
  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="../php/anadir.php">
    <p>
			<label for="fechaHoraActual">Fecha:</label>
		  <input type="datetime" name="fechaHoraActual" id="fechaHoraActual" readonly>
		</p>
	  <p> 
    <p>
      <label for="codigo">Código:</label>
      <input type="text" name="codigo" id="codigo"  placeholder="ASDASD2313">
    </p>
    <p>
      <label for="nombreprod">Producto:</label>
      <input type="text" name="nombreprod" id="nombreprod" placeholder="Jabon Nivea">
    </p>
    <p>
      <label for="categoria">Categoría:</label>
     
      <input type="text" name="categoria" id="categoria" size="70" list="listCategoria">
      <datalist id="listCategoria">  

      </datalist>
      </p>
    <p>
      <label for="descripcion">Descripción:</label>
      <textarea name="descripcion" id="descripcion" placeholder="Describa el producto"></textarea>
    </p>
    <p>
      <label for="cantidad">Cantidad:</label>
      <input type="number" name="cantidad" id="cantidad">
    </p>
    <p>
      <label for="precio">Precio:</label>
      <input type="number" name="precio" id="precio" step="0.01">
    </p>
    <div class="center">
      <input type="submit" name="anadirProducto" id="anadirProducto" value="Enviar">
      <button>Restablecer</button>
</div>
  </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
