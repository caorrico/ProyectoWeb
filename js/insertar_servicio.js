var listaProductos = Array();

document.addEventListener('DOMContentLoaded', function () {
    
    cargarProductos();

    document.getElementById('Agregar_Servicio').addEventListener('submit', function (event) {
        event.preventDefault();
        console.log('listaProductos:', listaProductos);
        const formData = new FormData(this);
        const data = {
            nombre: formData.get('nombreserv'),
            descripcion: formData.get('descripcion'),
            precio: formData.get('precio'),
            productos: listaProductos 
        };
        fetch('../php/insertar_servicio.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json()) 
        .then(result => {
            console.log(result);
        })
        .catch(error => console.error('Error:', error)); // Maneja errores en la petición
        limpiar();
        
    });

    document.getElementById('producto').addEventListener('change', function (event) {
        event.preventDefault();
    
        const opcionSeleccionada = this.options[this.selectedIndex];
        const idproducto = opcionSeleccionada.getAttribute('data-id'); 
        const nombreproducto = opcionSeleccionada.text; 
        const precio = opcionSeleccionada.getAttribute('data-precio'); 
    
        console.log('id:', idproducto);
        console.log('nombre:', nombreproducto);
        console.log('precio:', precio);
    
        const producto = {
            idproducto: idproducto,
            nombreproducto: nombreproducto,
            precio: precio
        };
    
        listaProductos.push(producto);
    
        const tabla = document.getElementById('tablaProductos');
        const nuevaFila = tabla.insertRow(); // Crea una nueva fila
    
        // Crea y agrega las celdas a la nueva fila
        const celdaCodigo = nuevaFila.insertCell(0);
        const celdaNombre = nuevaFila.insertCell(1);
        const celdaPrecio = nuevaFila.insertCell(2);
    
        celdaCodigo.textContent = producto.idproducto;
        celdaNombre.textContent = producto.nombreproducto;
        celdaPrecio.textContent = producto.precio;
    });
    
   
});




function limpiar(){
    document.getElementById('nombreserv').value = '';  
    document.getElementById('descripcion').value = '';
    document.getElementById('precio').value = '';
}

function cargarProductos() {
    const accion = { action: 'cargar' };
    fetch('../php/insertar_servicio.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(accion)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            throw new Error(data.error);
        }
        const productos = data; // Acceder directamente a data
        const select = document.getElementById('producto');
        productos.forEach(producto => {
            const option = document.createElement('option');
            option.value = producto.precio;
            option.innerHTML = producto.nombre_producto;
            option.setAttribute('data-id', producto.idproducto);
            option.setAttribute('data-name',producto.nombre_producto);
            option.setAttribute('data-precio',producto.precio);
            
            select.appendChild(option);
        });
    })
    .catch(error => console.error('Error:', error));
}