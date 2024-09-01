// obtenerNombre.js
document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/obtenerNombre.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('nombreusuario').textContent = data.nombre;
            } else {
                console.error('Error al obtener el nombre del usuario:', data.message);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
});
