document.addEventListener('DOMContentLoaded', function() {
    // Hacer la solicitud al servidor
    fetch('../php/mostrar_productos.php')
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
            data.forEach(producto => {
                // Convertir producto.activo a número
                const activo = Number(producto.activo);
                // Determinar la clase de la fila
                let rowClass = '';
                if (activo === 0) {
                    rowClass = 'rojo';
                }
                 
                rowsHtml += `
                    <tr class="${rowClass}">
                        <td>${producto.idproducto}</td>
                        <td>${producto.nombre_producto}</td>
                        <td>${producto.detaller_producto}</td>
                        <td>${producto.nombre_categoria}</td> <!-- Se corrige esta línea -->
                        <td>${producto.precio}</td>
                        <td>${producto.activo}</td>
                    </tr>
                `;
            });
            tbody.innerHTML = rowsHtml;
        })
        .catch(error => console.error('Error al obtener los datos:', error));
});
