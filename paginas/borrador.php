<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Basado en Permisos</title>
    <style>
        /* Estilos básicos para el menú */
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Menú</h1>
    <ul id="menu"></ul>

    <script>
        // Función para obtener el menú basado en permisos
        async function obtenerMenu() {
            try {
                // Hacer una solicitud al script PHP que obtiene el menú
                const response = await fetch('../php/menu_permisos.php');
                
                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }

                const data = await response.json();
                
                // Seleccionar el contenedor del menú
                const menuElement = document.getElementById('menu');

                // Limpiar el menú antes de agregar nuevos elementos
                menuElement.innerHTML = '';

                if (data.menu && data.menu.length > 0) {
                    data.menu.forEach(opcion => {
                        const li = document.createElement('li');
                        li.textContent = opcion;
                        menuElement.appendChild(li);
                    });
                } else {
                    const li = document.createElement('li');
                    li.textContent = 'No tienes permisos para mostrar menú.';
                    menuElement.appendChild(li);
                }
            } catch (error) {
                console.error('Error al obtener el menú:', error);
            }
        }

        // Llamar a la función para obtener el menú cuando la página cargue
        window.onload = () => obtenerMenu();
    </script>
</body>
</html>
