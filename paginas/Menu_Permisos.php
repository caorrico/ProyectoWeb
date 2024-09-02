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
                    <!-- Opción de inicio fija -->
                    <li class="nav-item">
                        <a class="nav-link" href="inicio.php">Inicio</a>
                    </li>
                    <!-- Se llenará con las opciones del menú dinámico -->
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                         
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script>
        // Función para obtener el menú basado en permisos
        async function obtenerMenu() {
    try {
        const response = await fetch('../php/menu_f.php');
        if (!response.ok) {
            throw new Error('Error en la solicitud');
        }

        const data = await response.json();
        console.log('Datos del menú:', data); // Verifica la respuesta del servidor

        const menuElement = document.getElementById('menu');
        while (menuElement.children.length > 1) {
            menuElement.removeChild(menuElement.lastChild);
        }

        if (data.menu && data.menu.length > 0) {
            data.menu.forEach(opcion => {
                const li = document.createElement('li');
                li.className = "nav-item";
                const a = document.createElement('a');
                a.className = "nav-link";
                a.href = opcion.url;
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
