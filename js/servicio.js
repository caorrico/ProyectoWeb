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
                    <td>${servicio.activo == 1 ? 'Sí' : 'No'}</td>
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
    console.log(id);
    //window.location.href = `editar_servicio.html?id=${id}`;
}

function eliminarServicio(id) {
    console.log(id);
    if (confirm('¿Estás seguro de que quieres eliminar este servicio?')) {

        fetch('../php/eliminar_servicio.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: id })  // Enviar el id en el cuerpo de la solicitud
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
                alert('Error al eliminar el servicio: ' + (data.error || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error al eliminar el servicio:', error);
            alert('Error al eliminar el servicio: ' + error.message);
        });
    }
}

