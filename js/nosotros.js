document.addEventListener('DOMContentLoaded', function() {//
//  Espera a que el DOM esté completamente cargado
//  Luego, realiza una petición a la API servidor para obtener los datos de "Nosotros", "Misión" y "Visión"
    fetch('api/nosotros.php')//define la URL de la API que se va a consultar
        .then(res => res.json())//  recibe los datos en formato JSON
        .then(data => {//  procesa los datos recibidos
            // Nosotros
            document.getElementById('nosotros-titulo').textContent = data.nosotros.titulo;
            document.getElementById('nosotros-descripcion').textContent = data.nosotros.descripcion;
            document.getElementById('nosotros-img').src = data.nosotros.imagen_url;
            // Misión
            document.getElementById('mision-titulo').textContent = data.mision.titulo;
            document.getElementById('mision-descripcion').textContent = data.mision.descripcion;
            document.getElementById('mision-img').src = data.mision.imagen_url;
            // Visión
            document.getElementById('vision-titulo').textContent = data.vision.titulo;
            document.getElementById('vision-descripcion').textContent = data.vision.descripcion;
            document.getElementById('vision-img').src = data.vision.imagen_url;
        });
});        