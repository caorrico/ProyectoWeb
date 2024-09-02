document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/mostrar_usuario.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('servicio-lista');
            tbody.innerHTML = '';

            if (data.error) {
                const errorRow = document.createElement('tr');
                const errorCell = document.createElement('td');
                errorCell.colSpan = 8;
                errorCell.className = 'text-danger';
                errorCell.textContent = data.error;
                errorRow.appendChild(errorCell);
                tbody.appendChild(errorRow);
                return;
            }

            let rowsHtml = '';
            data.forEach(persona => {
                const activo = Number(persona.activo);
                let rowClass = '';
                
                rowsHtml += `
                    <tr class="${rowClass}">
                        <td>${persona.nombre} ${persona.apellido}</td>
                        <td>${persona.apellido}</td>
                        <td>${persona.cedula}</td>
                        <td>${persona.telefono}</td>
                        <td>${persona.correo}</td>
                        <td>${persona.nombre_rol}</td>
                        <td>${persona.activo }</td>
                        <td>
                            <a href="#" onclick="editarUsuario(${persona.idpersona})" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="#" onclick="eliminarUsuario(${persona.idpersona})" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                `;
            });
            tbody.innerHTML = rowsHtml;
        })
        .catch(error => console.error('Error al obtener los datos:', error));
});

function eliminarUsuario(idpersona) {
    console.log('ID enviado:', idpersona); // Verifica que el ID es el correcto
    if (idpersona === undefined || idpersona === null) {
        alert('ID de usuario no proporcionado.');
        return;
    }

    if (confirm('¿Estás seguro de que quieres cambiar el estado de este usuario?')) {
        fetch('../php/eliminar_usuario.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ idpersona: idpersona })  // Asegúrate de que se está enviando el ID
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al cambiar el estado del usuario: ' + (data.error || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error al cambiar el estado del usuario:', error);
            alert('Error al cambiar el estado del usuario: ' + error.message);
        });
    }
}


// Función para editar un usuario
function editarUsuario(id) {
    // Redirigir a la página de edición, pasando el ID del usuario en la URL
    location.href = `../paginas/Agregar_Usuario.php`;
}