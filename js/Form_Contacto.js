document.addEventListener('DOMContentLoaded', function() {
    const feedbackForm = document.querySelector('.feedback-section .contact-form');
    const applicationForm = document.querySelector('.join-team-section .application-form');

    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(event) {
            event.preventDefault(); 

            const formData = new FormData(feedbackForm);
            const params = new URLSearchParams(formData).toString();

            fetch('routes/router.php?accion=guardar_comentario', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: params
            })
            .then(response => response.json())
            .then(data => {
                alert(data.mensaje); 
                if (data.estado === 'exito') {
                    feedbackForm.reset(); 
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al enviar tu comentario.');
            });
        });
    }

    if (applicationForm) {
        applicationForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(applicationForm);
            const params = new URLSearchParams(formData).toString();

            fetch('routes/router.php?accion=guardar_postulacion', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: params
            })
            .then(response => response.json())
            .then(data => {
                alert(data.mensaje);
                if (data.estado === 'exito') {
                    applicationForm.reset();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al enviar tu postulación.');
            });
        });
    }
});