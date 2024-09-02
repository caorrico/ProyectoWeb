<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/general.css" rel="stylesheet">
    <title>Lista de Servicios</title>
</head>
<body>
    <?php include 'usuario.html'; ?>
    <div class="menu-lateral">
    <?php include __DIR__ . '/Menu_Permisos.php'; ?>

    </div>
    <div class="cont-principal content">
        <h1>Lista de Servicios</h1>
        <ul id="servicio-lista" class="list-group">
            <!-- Aquí se insertarán los servicios -->
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        // Realizar la solicitud AJAX para obtener los datos de servicios
        fetch('../php/mostrar_servicio.php')
            .then(response => response.json())
            .then(data => {
                const lista = document.getElementById('servicio-lista');
                if (data.length > 0) {
                    data.forEach(servicio => {
                        const listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.innerHTML = `<strong>${servicio.nombre_servicio}:</strong> ${servicio.descripcion_servicio}`;
                        lista.appendChild(listItem);
                    });
                } else {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = 'No se encontraron servicios.';
                    lista.appendChild(listItem);
                }
            })
            .catch(error => console.error('Error:', error));
    </script>
</body>
</html>
