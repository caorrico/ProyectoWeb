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
    <div class="cont-principal">
    <h1 class="center">Registrar Rol</h1>
			  <form id="form1" name="form1" method="post" action="../php/anadir.php">
				<p>
					<label for="admin">Adminstardor:</label>
					<input type="text" name="admin" id="admin" readonly>
					<label for="fechaHoraActual">Fecha:</label>
					<input type="datetime" name="fechaHoraActual" id="fechaHoraActual" readonly>
				  </p>
			    <p>
			      <label for="nombreRol">Nombre:</label>
			      <input type="text" name="nombreRol" id="nombreRol" placeholder="Administrador">
			    </p>
			    <p>
			      <label for="permiso">Permiso:</label>
                  <input type="text" name="permiso" id="permiso">
			    </p>
				  <input type="button" value="Ingresar Permiso">
			    <table width="200" border="1">
			      <tbody>
			        <tr>
			          <td width="33%">Nombre del Rol</td>
			          <td width="33%">Permisos</td>
			          <td width="33%">Acciones</td>
		            </tr>
		          </tbody>
		        </table>
			    <div class="center">
      <input type="submit" name="anadirProducto" id="anadirProducto" value="Enviar">
      <button>Restablecer</button>
</div>				
			  </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
