document.addEventListener('DOMContentLoaded', function() {
    // Hacer la solicitud al servidor
    fetch('../php/mostrar_usuario.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('servicio-lista');
            // Limpiar el tbody
            tbody.innerHTML = '';
            // Comprobar si hay errores
            if (data.error) {
                const errorRow = document.createElement('tr');
                const errorCell = document.createElement('td');
                errorCell.colSpan = 7; // Número de columnas en la tabla
                errorCell.className = 'text-danger';
                errorCell.textContent = data.error;
                errorRow.appendChild(errorCell);
                tbody.appendChild(errorRow);
                return;
            }
            // Construir el HTML para las filas de la tabla
            let rowsHtml = '';
            data.forEach(persona => {
                // Convertir persona.activo a número
                const activo = Number(persona.activo);
                // Determinar la clase de la fila
                let rowClass = '';
                if (activo == 0) {
                    rowClass = 'rojo';
                }
                 
                rowsHtml += `
                    <tr class="${rowClass}">
                        <td>${persona.nombre}  ${persona.apellido}</td>
                        <td>${persona.apellido}</td>
                        <td>${persona.cedula}</td>
                        <td>${persona.telefono}</td>
                        <td>${persona.correo}</td>
                        <td>${persona.nombre_rol}</td>
                        <td>${persona.activo}</td>
                    </tr>
                `;
            });
            tbody.innerHTML = rowsHtml;
        })
        .catch(error => console.error('Error al obtener los datos:', error));
});