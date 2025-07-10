document.addEventListener('DOMContentLoaded', function() {
    fetch('api/inicio.php')
        .then(res => res.json())
        .then(data => {
            if (data) {
                // Actualizar eslogan
                document.getElementById('hero-slogan').textContent = data.eslogan;

                // Actualizar categorías
                const categoriasDestacadas = data.categorias_destacadas;
                const categoriaElements = [
                    { spanId: 'categoria-comidas-span', imgId: 'categoria-comidas-img' },
                    { spanId: 'categoria-bebidas-span', imgId: 'categoria-bebidas-img' },
                    { spanId: 'categoria-antojos-span', imgId: 'categoria-antojos-img' },
                    { spanId: 'categoria-despensa-span', imgId: 'categoria-despensa-img' },
                    { spanId: 'categoria-helado-span', imgId: 'categoria-helado-img' }
                ];

                categoriasDestacadas.forEach((cat, index) => {
                    if (categoriaElements[index]) {
                        document.getElementById(categoriaElements[index].spanId).textContent = cat.nombre;
                        document.getElementById(categoriaElements[index].imgId).src = cat.imagen_url;
                    }
                });
            }
        })
        .catch(err => {
            console.error('Error al cargar los datos de inicio:', err);
        });
});