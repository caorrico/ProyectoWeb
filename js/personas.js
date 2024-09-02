document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id'); // Obtén el ID del parámetro de la URL

    if (id) {
        // Llenar el formulario con los datos del usuario para editar
        fetch(`../php/obtener_usuario.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('usuarioId').value = data.idpersona;
                    document.getElementById('nombres').value = data.nombre;
                    document.getElementById('apellidos').value = data.apellido;
                    document.getElementById('cedula').value = data.cedula;
                    document.getElementById('telefono').value = data.telefono;
                    document.getElementById('correo').value = data.correo;
                    // Si se manejan roles, puedes llenar el select aquí
                    // document.getElementById('rol').value = data.rol;
                }
            })
            .catch(error => {
                console.error('Error al obtener los datos del usuario:', error);
            });
    }
});

document.getElementById('usuarioForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const id = document.getElementById('usuarioId').value;
    const nombres = document.getElementById('nombres').value;
    const apellidos = document.getElementById('apellidos').value;
    const cedula = document.getElementById('cedula').value;
    const telefono = document.getElementById('telefono').value;
    const contrasena = document.getElementById('contrasena').value;
    const repetircontrasena = document.getElementById('repetircontrasena').value;
    const correo = document.getElementById('correo').value;
    const rol = document.getElementById('rol').value;

    if (contrasena !== repetircontrasena) {
        alert('Las contraseñas no coinciden.');
        return;
    }

    const url = id ? '../php/editar_usuario.php' : '../php/agregar_usuario.php'; // Cambia la URL según el caso
    const method = id ? 'PUT' : 'POST'; // Usa PUT para editar, POST para agregar

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            idpersona: id,
            nombres: nombres,
            apellidos: apellidos,
            cedula: cedula,
            telefono: telefono,
            contrasena: contrasena,
            correo: correo,
            rol: rol
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'lista_usuarios.php'; // Redirige a la lista de usuarios después de guardar
        } else {
            alert('Error al guardar el usuario: ' + (data.error || 'Error desconocido'));
        }
    })
    .catch(error => {
        console.error('Error al enviar los datos:', error);
        alert('Error al enviar los datos: ' + error.message);
    });
});
