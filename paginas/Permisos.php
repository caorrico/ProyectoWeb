<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../css/general.css" rel="stylesheet">
    <title>Lista de Roles</title>
</head>
<body>
    <?php include 'usuario.html'; ?>
    <div class="menu-lateral">
        <?php include 'menu.php'; ?>
    </div>
    
    <div class="cont-principal content">
        <h1 class="center">Lista de Roles</h1>
        <div class="doble">
            <div>
                <table id="roles-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Rol</th>
                            <th>Nombre Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se insertarán los roles -->
                    </tbody>
                </table>
                <button id="ver-permisos" class="btn btn-info mt-3">Añadir Permisos</button>
                <button id="ver-permisos_e" class="btn btn-info mt-3">Quitar Permisos</button>
            </div>
            <div>
                <h2>Permisos del Rol</h2>
                <ul id="permisos-lista" class="list-group">
                    <!-- Aquí se mostrarán los permisos -->
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        let selectedRolId = null;

        // Cargar roles en la tabla
        fetch('../php/mostrar_rol.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener roles.');
                }
                return response.json();
            })
            .then(data => {
                const tableBody = document.querySelector('#roles-table tbody');
                tableBody.innerHTML = ''; // Limpiar tabla antes de agregar nuevas filas

                if (data.length > 0) {
                    data.forEach(rol => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${rol.idrol}</td>
                            <td>${rol.nombre_rol}</td>
                        `;
                        row.addEventListener('click', () => {
                            selectedRolId = rol.idrol;
                            // Resaltar fila seleccionada (opcional)
                            document.querySelectorAll('#roles-table tbody tr').forEach(r => r.classList.remove('table-active'));
                            row.classList.add('table-active');
                        });
                        tableBody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = '<td colspan="2">No se encontraron roles.</td>';
                    tableBody.appendChild(row);
                }
            })
            .catch(error => console.error('Error:', error));

        // Mostrar permisos del rol seleccionado para añadir
        document.getElementById('ver-permisos').addEventListener('click', function() {
            if (!selectedRolId) {
                alert('Por favor, selecciona un rol.');
                return;
            }

            fetch(`../php/mostrar_permisos.php?idrol=${selectedRolId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener permisos: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    const permisosLista = document.getElementById('permisos-lista');
                    permisosLista.innerHTML = ''; // Limpiar lista de permisos

                    if (data.length > 0) {
                        data.forEach(permiso => {
                            const listItem = document.createElement('li');
                            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                            listItem.innerHTML = `
                                ${permiso.permiso_acceso}
                                <button class="btn btn-outline-primary btn-sm" onclick="agregarPermiso('${permiso.permiso_acceso}')">
                                    <i class="bi bi-plus"></i>
                                </button>
                            `;
                            permisosLista.appendChild(listItem);
                        });
                    } else {
                        const listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.textContent = 'Tiene todos los permisos.';
                        permisosLista.appendChild(listItem);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // Mostrar permisos del rol seleccionado para eliminar
        document.getElementById('ver-permisos_e').addEventListener('click', function() {
            if (!selectedRolId) {
                alert('Por favor, selecciona un rol.');
                return;
            }

            fetch(`../php/mostrar_permisos_e.php?idrol=${selectedRolId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener permisos: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    const permisosLista = document.getElementById('permisos-lista');
                    permisosLista.innerHTML = ''; // Limpiar lista de permisos

                    if (data.length > 0) {
                        data.forEach(permiso => {
                            const listItem = document.createElement('li');
                            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                            listItem.innerHTML = `
                                ${permiso.permiso_acceso}
                                <button class="btn btn-outline-danger btn-sm" onclick="eliminarPermiso('${permiso.permiso_acceso}')">
                                    <i class="bi bi-x"></i>
                                </button>
                            `;
                            permisosLista.appendChild(listItem);
                        });
                    } else {
                        const listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.textContent = 'No hay permisos para eliminar.';
                        permisosLista.appendChild(listItem);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // Función para manejar el agregar permiso
        function agregarPermiso(permiso_acceso) {
            if (!selectedRolId) {
                alert('Por favor, selecciona un rol.');
                return;
            }

            fetch('../php/insertar_permiso.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    permiso_acceso: permiso_acceso,
                    rol_idrol: selectedRolId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Actualizar la lista de permisos
                    document.getElementById('ver-permisos').click();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Función para manejar la eliminación de permisos
        function eliminarPermiso(permiso_acceso) {
            if (!selectedRolId) {
                alert('Por favor, selecciona un rol.');
                return;
            }

            console.log(`Eliminando permiso: ${permiso_acceso} ${selectedRolId}`); // Mostrar en consola el permiso que se quiere eliminar

            fetch('../php/eliminar_permiso.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    rol_idrol: selectedRolId,
                    permiso_acceso: permiso_acceso
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Actualizar la lista de permisos
                    document.getElementById('ver-permisos_e').click();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
