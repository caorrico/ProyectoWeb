document.addEventListener('DOMContentLoaded', function () {
    // Llenar el select con roles desde el servidor
    fetch('../php/rol.php') // Cambia esta URL si es necesario
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('rol');
            data.forEach(role => {
                const option = document.createElement('option');
                option.value = role.idrol;
                option.textContent = role.nombre_rol;
                select.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar los roles:', error));

    // Manejar el envío del formulario
    document.getElementById('usuarioForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario

        // Obtener los datos del formulario
        const formData = new FormData(this);
        const data = {
            nombre: formData.get('nombres'),
            apellido: formData.get('apellidos'),
            cedula: formData.get('cedula'),
            telefono: formData.get('telefono'),
            correo: formData.get('correo'),
            contrasena: formData.get('contrasena'),
            rol_idrol: formData.get('rol')
        };

        // Verificar las contraseñas
        if (data.contrasena !== formData.get('repetircontrasena')) {
            alert('Las contraseñas no coinciden.');
            return;
        }

        // Enviar los datos en formato JSON al servidor
        fetch('../php/insertar_usuario.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
               
                window.location.href = '../paginas/Usuario.php'; // Redirigir a Usuario.php
            } else {
                alert(result.error);
            }
        })
        .catch(error => console.error('Error:', error));
        
    });
});
