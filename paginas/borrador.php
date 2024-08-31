<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Rol</title>
</head>
<body>
    <label for="rol">Selecciona un rol:</label>
    <select id="rol" name="rol">
        <option value="">Seleccione un rol</option>
    </select>

    <script>
        // Hacer una solicitud al archivo PHP para obtener los roles
        fetch('../php/rol.php')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('rol');
                
                // Verificar si hay un error
                if (data.error) {
                    console.error(data.error);
                    return;
                }

                // Recorrer los datos y añadirlos como opciones en el select
                data.forEach(rol => {
                    const option = document.createElement('option');
                    option.value = rol.idrol;
                    option.textContent = rol.nombre_rol;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
</body>
</html>
