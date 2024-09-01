document.addEventListener('DOMContentLoaded', function () {
        // Llenar el select con roles desde el servidor
        fetch('../php/categoria.php') // Cambia esta URL si es necesario
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('categoria');
                data.forEach(categoria => {
                    const option = document.createElement('option');
                    option.value = categoria.idcategoria;
                    option.textContent = categoria.nombre_categoria;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar los roles:', error));

    // Código para manejar el formulario de producto
    document.getElementById('form1').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario

        // Obtener los datos del formulario de producto
        const formData = new FormData(this);
        const data = {
            nombre_producto: formData.get('nombreprod'),
            detalle_producto: formData.get('detalle_producto'),
            precio: parseFloat(formData.get('precio')), // Convertir a número
            categoria_idcategoria: parseInt(formData.get('categoria_idcategoria')) // Convertir a entero
        };

        // Enviar los datos en formato JSON al servidor
        fetch('../php/insertar_producto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Producto registrado exitosamente');
                window.location.href = '../paginas/Agregar_Producto.php'; // Redirigir a la página de productos
            } else {
                alert(result.error);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
