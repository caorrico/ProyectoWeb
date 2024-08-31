document.addEventListener('DOMContentLoaded', function() {
    // Hacer la solicitud al servidor
    fetch('../php/mostrar_servicio.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            const tableBody = document.getElementById('servicios-table-body');
            // Limpiar el cuerpo de la tabla
            tableBody.innerHTML = '';

            // Verificar si hubo un error en la consulta
            if (data.error) {
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="4">${data.error}</td>`;
                tableBody.appendChild(row);
                return;
            }

            // Llenar la tabla con los datos recibidos
            data.forEach(servicio => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${servicio.idservicio}</td>
                    <td>${servicio.nombre_servicio}</td>
                    <td>${servicio.descripcion_servicio}</td>
                    <td>
                        <button onclick="editarServicio(${servicio.idservicio})" class="btn btn-edit btn-square">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="eliminarServicio(${servicio.idservicio})" class="btn btn-delete btn-square">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
            const tableBody = document.getElementById('servicios-table-body');
            tableBody.innerHTML = `<tr><td colspan="4">Error al cargar los datos</td></tr>`;
        });
});

function editarServicio(id) {
    // Redirigir a una página de edición o mostrar un formulario para editar el servicio
    window.location.href = `editar_servicio.html?id=${id}`;
}

function eliminarServicio(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este servicio?')) {
        // Enviar una solicitud al servidor para eliminar el servicio
        fetch(`http://localhost/ProyectoWeb/php/eliminar_servicio.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Actualizar la tabla después de eliminar
                location.reload();
            } else {
                alert('Error al eliminar el servicio');
            }
        })
        .catch(error => {
            console.error('Error al eliminar el servicio:', error);
            alert('Error al eliminar el servicio');
        });
    }
}
