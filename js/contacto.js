document.addEventListener('DOMContentLoaded', function() {
    fetch('api/contacto.php')
        .then(res => res.json())
        .then(data => {
            if (data.contacto) {
                document.getElementById('contacto-telefono').textContent = data.contacto.telefono;
                document.getElementById('contacto-email').textContent = data.contacto.email;

                document.getElementById('contacto-instagram-link').href = data.contacto.instagram_url;
                document.getElementById('contacto-instagram-text').textContent = data.contacto.instagram_text;

                document.getElementById('contacto-facebook-link').href = data.contacto.facebook_url;
                document.getElementById('contacto-facebook-text').textContent = data.contacto.facebook_text;

                document.getElementById('contacto-tiktok-link').href = data.contacto.tiktok_url;
                document.getElementById('contacto-tiktok-text').textContent = data.contacto.tiktok_text;

                document.getElementById('contacto-horario').textContent = data.contacto.horario;
            }
        })
        .catch(err => {
            console.error('Error fetching contact data:', err);
        });
});