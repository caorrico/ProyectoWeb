<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/general.css" rel="stylesheet">
    <title>Lista de Personas</title>
    <style>
        .rojo {
            background-color: #f8d7da !important; /* Color de fondo rojo claro */
        }
    </style>
</head>
<body>
    <?php include 'usuario.html'; ?>
    <div class="menu-lateral">
        <?php include 'menu.html'; ?>
    </div>
    <div class="cont-principal">
        <h1>Lista de Personas</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Activo</th>
                    </tr>
                </thead>
                <tbody id="servicio-lista">
                    <!-- Aquí se insertarán los usuarios -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hacer la solicitud al servidor
            fetch('../php/mostrar_usuario.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('servicio-lista');
                    // Limpiar el tbody
                    tbody.innerHTML = '';
                    // Comprobar si hay errores
                    if (data.error) {
                        const errorRow = document.createElement('tr');
                        const errorCell = document.createElement('td');
                        errorCell.colSpan = 7; // Número de columnas en la tabla
                        errorCell.className = 'text-danger';
                        errorCell.textContent = data.error;
                        errorRow.appendChild(errorCell);
                        tbody.appendChild(errorRow);
                        return;
                    }
                    // Construir el HTML para las filas de la tabla
                    let rowsHtml = '';
                    data.forEach(persona => {
                        // Convertir persona.activo a número
                        const activo = Number(persona.activo);
                        // Determinar la clase de la fila
                        let rowClass = '';
                        if (activo == 0) {
                            rowClass = 'rojo';
                        }
                         
                        rowsHtml += `
                            <tr class="${rowClass}">
                                <td>${persona.nombre}</td>
                                <td>${persona.apellido}</td>
                                <td>${persona.cedula}</td>
                                <td>${persona.telefono}</td>
                                <td>${persona.correo}</td>
                                <td>${persona.nombre_rol}</td>
                                <td>${persona.activo}</td>
                            </tr>
                        `;
                    });
                    tbody.innerHTML = rowsHtml;
                })
                .catch(error => console.error('Error al obtener los datos:', error));
        });
    </script>
</body>
</html>
