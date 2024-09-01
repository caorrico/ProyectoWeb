document.addEventListener('DOMContentLoaded', function() {
    const userIcon = document.querySelector('.user-icon');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    userIcon.addEventListener('click', function() {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    // Cierra el menú si se hace clic en cualquier lugar fuera del menú
    document.addEventListener('click', function(event) {
        if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});

// Opcional: si quieres añadir más protección del lado del cliente
function preventBack() {
    window.history.forward();
}

// Añadir el listener para prevenir el regreso después de cargar
window.onload = preventBack;
window.onpageshow = function(event) {
    if (event.persisted) preventBack();
};