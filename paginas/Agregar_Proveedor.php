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
    <h1 class="center">Registro de Proveedores</h1>
        <form id="form1" name="form1" method="post" action="../php/anadir.php">
          <p>
            <label for="admin">Adminstrador:</label>
            <input type="text" name="admin" id="admin" readonly>
            <label for="fechaHoraActual">Fecha:</label>
            <input type="datetime" name="fechaHoraActual" id="fechaHoraActual" readonly>
          </p>
          <p>
          <label for="nombreEmpresa">Nombre Empresa:</label>
          <input type="text" name="nombreEmpresa" id="nombreEmpresa" placeholder="Nombre de la empresa: Jonson's Baby">    
          <label for="direccion">Dirección:</label>
          <textarea name="direccion" id="direccion" rows="3" placeholder="Av. La avenida, calles 'las calles' "></textarea>    
          <label for="telefono">Teléfono:</label>
          <input type="text" name="telefono" id="telefono" placeholder="0999865432">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" placeholder="ejemplo@hotmail.com">
          <label for="servicios">Servicios</label>
          <textarea name="servicios" id="servicios" rows="5" placeholder="Que productos ofrece la empresa Ejemplo: Jabones"></textarea>
          <input type="submit" name="anadirProvedor" id="anadirProvedor" value="Enviar" >
          <button>Restablecer</button>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
