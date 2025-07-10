//aqui es el código que se ejecuta cuando el DOM está completamente cargado
document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('guardar-todo').addEventListener('click', function (e) {
        //evita que se recargue la página al enviar el formulario
        e.preventDefault();
  
        //
        const formData = new FormData();
        // Nosotros
        formData.append('nosotros_titulo', document.getElementById('nosotros-titulo').value);
        formData.append('nosotros_descripcion', document.getElementById('nosotros-descripcion').value);
        formData.append('nosotros_imagen', document.getElementById('nosotros-imagen').files[0] || '');
        // Misión
        formData.append('mision_titulo', document.getElementById('mision-titulo').value);
        formData.append('mision_descripcion', document.getElementById('mision-descripcion').value);
        formData.append('mision_imagen', document.getElementById('mision-imagen').files[0] || '');
        // Visión
        formData.append('vision_titulo', document.getElementById('vision-titulo').value);
        formData.append('vision_descripcion', document.getElementById('vision-descripcion').value);
        formData.append('vision_imagen', document.getElementById('vision-imagen').files[0] || '');

        // Enviar los datos al servidor
        fetch('api/guardar_nosotros.php', {
            method: 'POST',
            body: formData
        }) 
        // Enviar los datos al servidor en formato JSON
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    alert('Contenido guardado correctamente');
                } else {
                    alert('Error al guardar');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Error en la petición');
            });
    });
});