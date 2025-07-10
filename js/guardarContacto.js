document.addEventListener('DOMContentLoaded', function () {
    const saveContactButton = document.getElementById('guardar-contacto');
    const limpiarContactButton = document.getElementById('limpiar-contacto');

    function loadContactData() {
        fetch('api/contacto.php')
            .then(res => res.json())
            .then(data => {
                if (data.contacto) {
                    document.getElementById('admin-contacto-horario').value = data.contacto.horario || '';
                    document.getElementById('admin-contacto-telefono').value = data.contacto.telefono || '';
                    document.getElementById('admin-contacto-email').value = data.contacto.email || '';

                    document.getElementById('admin-contacto-instagram-url').value = data.contacto.instagram_url || '';
                    document.getElementById('admin-contacto-instagram-text').value = data.contacto.instagram_text || '';

                    document.getElementById('admin-contacto-facebook-url').value = data.contacto.facebook_url || '';
                    document.getElementById('admin-contacto-facebook-text').value = data.contacto.facebook_text || '';

                    document.getElementById('admin-contacto-tiktok-url').value = data.contacto.tiktok_url || '';
                    document.getElementById('admin-contacto-tiktok-text').value = data.contacto.tiktok_text || '';
                }
            })
            .catch(err => {
                console.error('Error al cargar datos de contacto:', err);
            });
    }

    loadContactData();

    if (saveContactButton) {
        saveContactButton.addEventListener('click', function (e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append('contacto_horario', document.getElementById('admin-contacto-horario').value);
            formData.append('contacto_telefono', document.getElementById('admin-contacto-telefono').value);
            formData.append('contacto_email', document.getElementById('admin-contacto-email').value);

            formData.append('contacto_instagram_url', document.getElementById('admin-contacto-instagram-url').value);
            formData.append('contacto_instagram_text', document.getElementById('admin-contacto-instagram-text').value);

            formData.append('contacto_facebook_url', document.getElementById('admin-contacto-facebook-url').value);
            formData.append('contacto_facebook_text', document.getElementById('admin-contacto-facebook-text').value);

            formData.append('contacto_tiktok_url', document.getElementById('admin-contacto-tiktok-url').value);
            formData.append('contacto_tiktok_text', document.getElementById('admin-contacto-tiktok-text').value);

            fetch('api/guardar_contacto.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    alert('Contacto guardado correctamente');
                    loadContactData();
                } else {
                    alert('Error al guardar contacto: ' + (res.message || 'Desconocido'));
                }
            })
            .catch(err => {
                console.error('Error en la petición para guardar contacto:', err);
                alert('Error en la petición');
            });
        });
    }

    if (limpiarContactButton) {
        limpiarContactButton.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('admin-contacto-horario').value = '';
            document.getElementById('admin-contacto-telefono').value = '';
            document.getElementById('admin-contacto-email').value = '';

            document.getElementById('admin-contacto-instagram-url').value = '';
            document.getElementById('admin-contacto-instagram-text').value = '';

            document.getElementById('admin-contacto-facebook-url').value = '';
            document.getElementById('admin-contacto-facebook-text').value = '';

            document.getElementById('admin-contacto-tiktok-url').value = '';
            document.getElementById('admin-contacto-tiktok-text').value = '';
        });
    }
});