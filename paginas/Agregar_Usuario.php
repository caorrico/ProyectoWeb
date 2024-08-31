<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/general.css" rel="stylesheet">
    <title>Agregar Usuario</title>
</head>
<body>
<?php include 'usuario.html'; ?>
    <div class="menu-lateral">
        <?php include 'menu.html'; ?>
    </div>
    <div class="cont-principal">
        <h1 class="center">Registrar Usuario</h1>
        <form id="usuarioForm">
            <p>
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" placeholder="Carlos Michael" required><br><br>

                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" placeholder="Armijos Morales" required><br><br>

                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" placeholder="1712012912" required><br><br>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" placeholder="0987654321" required><br><br>

                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required><br><br>

                <label for="repetircontrasena">Ingrese nuevamente la contraseña:</label>
                <input type="password" id="repetircontrasena" name="repetircontrasena" required><br><br>

                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" placeholder="ejemplo@hotmail.com" required><br><br>
            </p>
            <p>
                <label for="rol">Roles:</label><br><br>
                <select id="rol" name="rol" required>
                    <option value="">Seleccione un rol</option>
                </select>
                <br><br>
                <input type="submit" name="anadir" id="anadir" value="Enviar">
                <button type="reset">Restablecer</button>  
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/persona.js"></script>
</body>
</html>
