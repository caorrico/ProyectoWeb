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
    <h1 class="center">Registrar Usuario</h1>
        <form method="post" id="usuarioForm">
            <p>
                <label for="admin">Adminstrador:</label>
              <input type="text" name="admin" id="admin" readonly>
              <label for="fechaHoraActual">Fecha:</label>
              <input type="datetime" name="fechaHoraActual" id="fechaHoraActual" readonly>
            </p>
          <p>
            <p>
              <label for="nombres">Nombres:</label>
              <input type="text" id="nombres" name="nombres" placeholder="Carlos Michael"><br><br>
              
              <label for="apellidos">Apellidos:</label>
              <input type="text" id="apellidos" name="apellidos" placeholder="Armijos Morales"><br><br>
              
              <label for="cedula">Cédula:</label>
              <input type="text" id="cedula" name="cedula" placeholder="1712012912"><br><br>
              
              <label for="contrasena">Contraseña:</label>
              <input type="password" id="contrasena" name="contrasena" ><br><br>
              
              <label for="repetircontrasena">Ingrese nuevamente la contraseña:</label>
              <input type="password" id="repetircontrasena" name="repetircontrasena" ><br><br>
              
              <label for="correo">Correo:</label>
              <input type="email" id="correo" name="correo" placeholder="ejemplo@hotmail.com">
            </p>
            <p>
              <label for="rol">Roles:</label>
              <input type="text" id="rol" name="rol" list="listRol">
              <datalist id="listRol">

              </datalist>
              <br>
              <br>
              <input type="submit" name="anadir" id="anadir" value="Enviar">
              <button>Restablecer</button>  
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
