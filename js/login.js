

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de la forma tradicional

    // Obtener los valores de los campos del formulario
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Enviar los datos a través de fetch
    fetch('php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'paginas/inicio.php';
            // Redirigir o realizar otra acción
        } else {
            console.error('Error al iniciar sesión', data.message);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });
});
