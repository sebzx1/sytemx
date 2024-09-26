document.addEventListener('DOMContentLoaded', function() {
    // Cargar datos de la base de datos en el resumen
    fetch('overview.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('overview-content').innerHTML = data;
        });

    // Cargar estado del sistema
    fetch('status.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('status-content').innerHTML = data;
        });

    // Manejar envío del formulario de configuración
    document.getElementById('settings-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('settings.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert('Configuración guardada.');
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
