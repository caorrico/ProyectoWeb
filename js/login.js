document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe de forma tradicional

    // Obtener valores del formulario
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Crear objeto FormData para enviar los datos
    var formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    // Enviar datos al servidor utilizando fetch
    fetch('../php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redireccionar si las credenciales son correctas
            window.location.href = '../paginas/inicio.php';
        } else {
            // Mostrar mensaje de error si las credenciales son incorrectas
            alert(data.message);
        }
    })
    .catch(error => console.error('Error al procesar la solicitud:', error));
});