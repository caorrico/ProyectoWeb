<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Menú Basado en Permisos</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        .container-fluid {
            display: flex;
            height: 100vh; 
            overflow: hidden;
            margin-top: 101px;
        }

        .menu-lateral {
            width: 20%; 
            background-color: hsla(1,37%,60%,1.00); 
            color: white;
            height: 100%; 
            position: fixed; 
            left: 0; 
            padding: 15px;
            box-shadow: 10px 0 10px 0 rgb(218, 216, 216);
        }

        .cont-principal {
            margin-left: 20%; 
            height: 100vh;
            width: 80%;
        }

        .img_fon{
            height: 600px;
        }

        .img_fon img{
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="menu-lateral">
            <nav>
                <ul class="navbar-nav" id="menu">
                    <li class="nav-item">
                        <span class="nav-link">Rol: <?php echo isset($_SESSION['nombre_rol']) ? $_SESSION['nombre_rol'] : 'No disponible'; ?></span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script>
        // Función para obtener el menú basado en permisos
        async function obtenerMenu() {
            try {
                const response = await fetch('../php/menu_permisos.php');
                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }

                const data = await response.json();
                const menuElement = document.getElementById('menu');

                menuElement.innerHTML = ''; // Limpiar el menú

                if (data.menu && data.menu.length > 0) {
                    data.menu.forEach(opcion => {
                        const li = document.createElement('li');
                        li.className = "nav-item";
                        const a = document.createElement('a');
                        a.className = "nav-link";
                        a.href = opcion.url; // Asignar la URL correspondiente
                        a.textContent = opcion.nombre;
                        li.appendChild(a);
                        menuElement.appendChild(li);
                    });
                } else {
                    const li = document.createElement('li');
                    li.className = "nav-item";
                    li.textContent = 'No tienes permisos para mostrar el menú.';
                    menuElement.appendChild(li);
                }
            } catch (error) {
                console.error('Error al obtener el menú:', error);
            }
        }

        window.onload = () => obtenerMenu();
    </script>
</body>
</html>
