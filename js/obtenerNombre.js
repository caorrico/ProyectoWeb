document.addEventListener('DOMContentLoaded', function() {
    // Función para obtener el nombre del usuario desde el servidor
    function obtenerNombreUsuario() {
        fetch('../php/obtenerNombre.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar el contenido del elemento <p> con el nombre del usuario
                    document.getElementById('nombreusuario').textContent = data.nombre;
                } else {
                    console.error('Error al obtener el nombre del usuario:', data.message);
                }
            })
            .catch(error => console.error('Error en la solicitud:', error));
    }

    // Llamar a la función al cargar la página
    obtenerNombreUsuario();
});
//Aun no funciona