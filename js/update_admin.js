document.getElementById('updateForm').addEventListener('submit', function (e) {
    e.preventDefault();
    var adminId = document.getElementById('admin_id').value;

    // Aquí puedes hacer una solicitud AJAX para buscar los detalles del usuario administrador con el ID proporcionado.
    // Luego, muestra los detalles en el formulario de "userDetails".
    // Asegúrate de incluir el ID en un campo oculto.

    // Ejemplo de código AJAX (requiere una librería como jQuery o fetch):
    fetch('get_admin_details.php?id=' + adminId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('admin_id_hidden').value = data.admin.id;
                document.getElementById('admin_email').value = data.admin.email;
                document.getElementById('userDetails').style.display = 'block';
            } else {
                alert('Usuario no encontrado');
            }
        })
        .catch(error => console.error('Error:', error));
});

document.getElementById('updateUserForm').addEventListener('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    // Aquí puedes hacer una solicitud AJAX para actualizar los detalles del usuario administrador.
    // Asegúrate de validar y asegurar adecuadamente los datos antes de procesar la actualización.

    // Ejemplo de código AJAX (requiere una librería como jQuery o fetch):
    fetch('update_admin.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Usuario actualizado con éxito');
            document.getElementById('userDetails').style.display = 'none';
        } else {
            alert('Error al actualizar el usuario');
        }
    })
    .catch(error => console.error('Error:', error));
});
