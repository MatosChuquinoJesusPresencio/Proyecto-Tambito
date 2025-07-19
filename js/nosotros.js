document.addEventListener('DOMContentLoaded', () => {
    fetch('routes/router.php?accion=listar_nosotros')
        .then(response => response.json())
        .then(data => {
            data.forEach(seccion => {
                const { seccion: nombre, titulo, contenido, imagen_url } = seccion;
 
                if (nombre === 'nosotros') {
                    document.getElementById('nosotros-titulo').textContent = titulo;
                    document.getElementById('nosotros-descripcion').textContent = contenido;
                    document.getElementById('nosotros-img').src = imagen_url || 'img/default-icon.png';
                }

                if (nombre === 'mision') {
                    document.getElementById('mision-titulo').textContent = titulo;
                    document.getElementById('mision-descripcion').textContent = contenido;
                    document.getElementById('mision-img').src = imagen_url || 'img/default-icon.png';
                }

                if (nombre === 'vision') {
                    document.getElementById('vision-titulo').textContent = titulo;
                    document.getElementById('vision-descripcion').textContent = contenido;
                    document.getElementById('vision-img').src = imagen_url || 'img/default-icon.png';
                }
            });
        })
        .catch(error => console.error('Error al cargar secciones:', error));
});
