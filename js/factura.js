var listaProductos = Array();

document.addEventListener('DOMContentLoaded', function () {
    fecha();
    cargarProductos();
    cargarServicios();

    document.getElementById('formFactura').addEventListener('submit', function (event) {
        event.preventDefault();
        console.log('listaProductos:', listaProductos);
        var totalSinImpuesto = 0;
        var totalConImpuesto = 0;
        var totalImpuesto = 0;
        
        listaProductos.forEach(producto => {
            totalImpuesto += (producto.precioUnitario * 0.15) * producto.cantidad; 
            totalSinImpuesto += producto.precioUnitario * producto.cantidad;
        });
        totalConImpuesto = totalSinImpuesto + totalImpuesto;

        const formData = new FormData(this);
        const data = {
            nombreVendedor: formData.get('vendedor'),
            fecha: formData.get('fecha'),
            cedulaCliente: formData.get('cedula'), 
            nombreCliente: formData.get('nombreCliente'),
            apellidoCliente: formData.get('apellidoCliente'),
            correo : formData.get('correo'),
            totalSinImpuesto: totalSinImpuesto,
            totalConImpuesto: totalConImpuesto,
            totalImpuesto: totalImpuesto,
            productos: listaProductos 
        };
            
        fetch('../php/envio_factura.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log(result);
            if (result.error) {
                throw new Error(result.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    
});



function fecha(){
    let now = new Date();

    // Obtener los componentes de la fecha
    let day = String(now.getDate()).padStart(2, '0');
    let month = String(now.getMonth() + 1).padStart(2, '0'); // Los meses en JavaScript van de 0 a 11
    let year = now.getFullYear(); // Año completo en lugar de los últimos dos dígitos

    // Formatear la fecha como YYYY-MM-DD
    let formattedDate = `${year}-${month}-${day}`;

    document.getElementById('fecha').value = formattedDate;
}

function agregarProducto(event){
    event.preventDefault();
    const cantidad = document.getElementById('cantidad').value;
    const opcionSeleccionada = document.getElementById('nombreProducto').options[document.getElementById('nombreProducto').selectedIndex];
    const idproducto = opcionSeleccionada.getAttribute('data-id'); 
    const nombreproducto = opcionSeleccionada.text; 
    const precio =cantidad * opcionSeleccionada.getAttribute('data-precio'); 

    console.log('id:', idproducto);
    console.log('nombre:', nombreproducto);
    console.log('precio:', precio);

    const producto = {
        idproducto: idproducto,
        nombreproducto: nombreproducto,
        detalle: opcionSeleccionada.getAttribute('data-descripcion'),
        cantidad: cantidad,
        precioUnitario: opcionSeleccionada.getAttribute('data-precio'),
        precio: precio
    };
    var total = 0;
    listaProductos.push(producto);
    listaProductos.forEach(producto => {
        total += producto.precio;
    });
    const tabla = document.getElementById('tablaProductos');
    const nuevaFila = tabla.insertRow(); // Crea una nueva fila

    // Crea y agrega las celdas a la nueva fila
    const celdaCodigo = nuevaFila.insertCell(0);
    const celdaNombre = nuevaFila.insertCell(1);
    const celdaCantidad = nuevaFila.insertCell(2);
    const celdaPrecio = nuevaFila.insertCell(3);

    celdaCodigo.textContent = producto.idproducto;
    celdaNombre.textContent = producto.nombreproducto;
    celdaCantidad.textContent = producto.cantidad;
    celdaPrecio.textContent = producto.precio;
    document.getElementById('totalPagar').innerHTML = 'Total a pagar: '+total;
}



function limpiar(){

}

function cargarProductos() {
    const accion = { action: 'cargarProducto' };
    fetch('../php/factura.php', {
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
        const select = document.getElementById('nombreProducto');
        productos.forEach(producto => {
            const option = document.createElement('option');
            option.value = producto.precio;
            option.innerHTML = producto.nombre_producto;
            option.setAttribute('data-id', producto.idproducto);
            option.setAttribute('data-name',producto.nombre_producto);
            option.setAttribute('data-precio',producto.precio);
            option.setAttribute('data-descripcion',producto.detaller_producto);
            
            select.appendChild(option);
        });
    })
    .catch(error => console.error('Error:', error));
}
function cargarServicios() {
    const accion = { action: 'cargarServicio' };
    fetch('../php/factura.php', {
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
        const select = document.getElementById('nombreProducto');
        productos.forEach(producto => {
            const option = document.createElement('option');
            option.value = producto.precio;
            option.innerHTML = producto.nombre_servicio;
            option.setAttribute('data-id', producto.idservicio);
            option.setAttribute('data-name',producto.nombre_servicio);      
            option.setAttribute('data-precio',producto.precio_ser);
            option.setAttribute('data-descripcion',producto.descripcion_servicio);
            
            select.appendChild(option);
        });
    })
    .catch(error => console.error('Error:', error));
}